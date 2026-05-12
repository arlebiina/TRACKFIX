<?php include 'header.php'; ?>

<main class="layout">
    <div class="content">
        <h2>Agenda Compartilhada de Manutenção</h2>

        <div class="card" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 5px; text-align: center;">
            <div class="muted">Dom</div><div class="muted">Seg</div><div class="muted">Ter</div>
            <div class="muted">Qua</div><div class="muted">Qui</div><div class="muted">Sex</div><div class="muted">Sáb</div>
           
            <?php for($i = 1; $i <= 31; $i++):
                $temEvento = false;
                foreach($manutencoes as $m) {
                    if(date('d', strtotime($m['data_manutencao'])) == $i) $temEvento = true;
                }
            ?>
                <div style="padding: 15px; background: var(--card-bg); border-radius: 8px; border: 1px solid <?php echo $temEvento ? '#a2c2ff' : 'rgba(255,255,255,0.05)'; ?>">
                    <?php echo $i; ?>
                    <?php if($temEvento): ?><div style="width: 6px; height: 6px; background: #a2c2ff; border-radius: 50%; margin: 5px auto 0;"></div><?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>

        <div class="card" style="margin-top: 20px;">
            <h3>Registrar Manutenção</h3>
            <form action="?rota=salvar-manutencao" method="POST" class="grid cols-4" style="margin-top: 15px; gap: 10px;">
                <div class="field">
                    <label>ID Item</label>
                    <input type="number" name="item_do_inventario" required>
                </div>
                <div class="field">
                    <label>Data</label>
                    <input type="date" name="data_manutencao" required>
                </div>
                <div class="field">
                    <label>Próxima</label>
                    <input type="date" name="proxima_manutencao">
                </div>
                <div class="field">
                    <label>Serviço</label>
                    <input type="text" name="descricao_servico" placeholder="Ex: Troca de óleo" required>
                </div>
                <button type="submit" class="btn-principal" style="grid-column: span 4; background: #a2c2ff; color: #000;">Salvar no Histórico</button>
            </form>
        </div>

        <div class="card" style="margin-top: 20px;">
            <h3>Histórico Recente</h3>
            <ul style="list-style: none; padding: 0; margin-top: 15px;">
                <?php foreach($manutencoes as $m): ?>
                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <div>
                            <span class="badge" style="background: rgba(162, 194, 255, 0.2); color: #a2c2ff;">
                                <?php echo $m['data_manutencao']; ?>
                            </span>
                            <span style="margin-left: 15px;">
                                <strong>Item #<?php echo $m['item_do_inventario']; ?></strong> — <?php echo $m['descricao_servico']; ?>
                            </span>
                        </div>
                        <button class="btn-ghost" style="color: #a2c2ff; border: 1px solid #a2c2ff; padding: 4px 12px; border-radius: 15px; font-size: 0.8em;">Feito</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>