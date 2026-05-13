<?php include 'header.php'; ?>

<style>
    /* Estilo para as células do calendário */
    .cal-day {
        padding: 15px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        position: relative;
    }

    .cal-day:hover {
        background: rgba(125, 165, 251, 0.1);
        transform: scale(1.05);
        border-color: #7da5fb;
    }

    .cal-day.has-event {
        border-color: #7da5fb;
        box-shadow: 0 0 10px rgba(125, 165, 251, 0.2);
    }

    .event-dot {
        width: 8px;
        height: 8px;
        background: #7da5fb;
        border-radius: 50%;
        margin: 8px auto 0;
        box-shadow: 0 0 8px #7da5fb;
    }

    /* Estilo para os cards de formulário */
    .maint-card {
        background: #1a1d29;
        border: 1px solid #2d3142;
        border-radius: 15px;
        padding: 25px;
        margin-top: 25px;
    }

    .maint-input {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #2d3142;
        background: #0f111a;
        color: #fff;
        margin-top: 5px;
    }

    .maint-input:focus {
        border-color: #7da5fb;
        outline: none;
    }
</style>

<main class="layout">
    <div class="content" style="padding: 20px; animation: fadeIn 0.8s ease-out;">
        <h2 style="color: #7da5fb; font-family: Verdana; margin-bottom: 25px;">📅 Agenda de Manutenção</h2>

        <div class="card" style="background: #1a1d29; border: 1px solid #2d3142; border-radius: 15px; padding: 20px;">
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; text-align: center;">
                <div class="muted" style="font-weight: bold; color: #7da5fb;">DOM</div>
                <div class="muted" style="font-weight: bold; color: #7da5fb;">SEG</div>
                <div class="muted" style="font-weight: bold; color: #7da5fb;">TER</div>
                <div class="muted" style="font-weight: bold; color: #7da5fb;">QUA</div>
                <div class="muted" style="font-weight: bold; color: #7da5fb;">QUI</div>
                <div class="muted" style="font-weight: bold; color: #7da5fb;">SEX</div>
                <div class="muted" style="font-weight: bold; color: #7da5fb;">SÁB</div>
                
                <?php 
                // Exibindo os 31 dias (exemplo simplificado)
                for($i = 1; $i <= 31; $i++):
                    $temEvento = false;
                    foreach($manutencoes as $m) {
                        // Verifica se o dia bate com o dia da manutenção
                        if(date('d', strtotime($m['data_manutencao'])) == $i) $temEvento = true;
                    }
                ?>
                    <div class="cal-day <?= $temEvento ? 'has-event' : '' ?>">
                        <span style="font-weight: <?= $temEvento ? 'bold' : 'normal' ?>;"><?= $i ?></span>
                        <?php if($temEvento): ?>
                            <div class="event-dot"></div>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            
            <div class="maint-card">
                <h3 style="margin-bottom: 15px; color: #fff;">Registrar Novo Serviço</h3>
                <form action="?rota=salvar-manutencao" method="POST">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div class="field">
                            <label class="muted">ID do Item</label>
                            <input type="number" name="item_do_inventario" class="maint-input" required placeholder="Ex: 101">
                        </div>
                        <div class="field">
                            <label class="muted">Data Realizada</label>
                            <input type="date" name="data_manutencao" class="maint-input" required>
                        </div>
                        <div class="field">
                            <label class="muted">Próxima Manutenção</label>
                            <input type="date" name="proxima_manutencao" class="maint-input">
                        </div>
                        <div class="field">
                            <label class="muted">Tipo de Serviço</label>
                            <input type="text" name="descricao_servico" class="maint-input" placeholder="Ex: Calibração" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-glow" style="width: 100%; margin-top: 20px; border: none; justify-content: center;">
                        <i class="fas fa-save"></i> Salvar no Histórico
                    </button>
                </form>
            </div>

            <div class="maint-card">
                <h3 style="margin-bottom: 15px; color: #fff;">Histórico Recente</h3>
                <div style="max-height: 280px; overflow-y: auto; padding-right: 5px;">
                    <ul style="list-style: none; padding: 0;">
                        <?php if(empty($manutencoes)): ?>
                            <li class="muted">Nenhuma manutenção registrada.</li>
                        <?php else: ?>
                            <?php foreach($manutencoes as $m): ?>
                                <li style="display: flex; justify-content: space-between; align-items: center; padding: 12px; border-bottom: 1px solid rgba(255,255,255,0.05); background: rgba(0,0,0,0.1); border-radius: 8px; margin-bottom: 8px;">
                                    <div>
                                        <span style="color: #7da5fb; font-size: 0.8rem; font-weight: bold;">
                                            <?= date('d/m/Y', strtotime($m['data_manutencao'])) ?>
                                        </span>
                                        <div style="margin-top: 4px;">
                                            <strong>Item #<?= $m['item_do_inventario'] ?></strong> 
                                            <span class="muted" style="margin-left: 5px;">— <?= htmlspecialchars($m['descricao_servico']) ?></span>
                                        </div>
                                    </div>
                                    <span style="font-size: 1.2rem;">🛠️</span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
