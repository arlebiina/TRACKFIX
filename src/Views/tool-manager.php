<?php
include 'header.php';

// 1. BUSCAR CATEGORIAS (Coluna real: 'categoria')
$stmtCat = $pdo->query("SELECT id, categoria FROM categorias_item");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// 2. BUSCAR ITENS (Colunas reais: 'descricao' e 'categoria')
try {
    // Corrigido: usando c.categoria e i.descricao para evitar erro 1054
    $sql = "SELECT i.id, i.descricao, c.categoria AS nome_categoria
            FROM itens i
            LEFT JOIN categorias_item c ON i.categoria_id = c.id
            ORDER BY i.id DESC";
    $itens = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div style='color:red; background:white; padding:10px;'>Erro SQL: " . $e->getMessage() . "</div>";
    $itens = [];
}
?>

<section class="content" style="background-color: #0f111a; color: #fff; padding: 20px; min-height: 100vh;">
    <h2 style="margin-bottom: 20px;">🛠️ Gerenciar Ferramentas</h2>
   
    <div class="card" style="background: #1a1d29; border-radius: 12px; padding: 25px; margin-bottom: 30px; border: 1px solid #2d3142;">
        <form action="index.php?rota=processar-ferramenta&acao=salvar" method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="display:block; margin-bottom: 8px; color: #8a8f9d;">Descrição da Ferramenta</label>
                    <input type="text" name="descricao" placeholder="Ex: Furadeira" required
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #2d3142; background: #0f111a; color: #fff;">
                </div>
                <div>
                    <label style="display:block; margin-bottom: 8px; color: #8a8f9d;">Categoria</label>
                    <select name="categoria_id" required
                            style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #2d3142; background: #0f111a; color: #fff;">
                        <option value="">Selecione uma categoria...</option>
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['categoria']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" style="margin-top: 20px; background: #5c7cff; color: #fff; border: none; padding: 12px 25px; border-radius: 25px; cursor: pointer; font-weight: bold;">Salvar</button>
        </form>
    </div>

    <div style="background: #1a1d29; border-radius: 12px; border: 1px solid #2d3142; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #25293a; color: #8a8f9d;">
                    <th style="padding: 15px;">ID</th>
                    <th style="padding: 15px;">Descrição</th>
                    <th style="padding: 15px;">Categoria</th>
                    <th style="padding: 15px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($itens)): ?>
                    <?php foreach($itens as $item): ?>
                    <tr style="border-bottom: 1px solid #2d3142;">
                        <td style="padding: 15px; color: #8a8f9d;"><?= $item['id'] ?></td>
                        <td style="padding: 15px;"><?= htmlspecialchars($item['descricao']) ?></td>
                        <td style="padding: 15px;">
                            <span style="background: #2d3142; padding: 4px 12px; border-radius: 15px;">
                                <?= htmlspecialchars($item['nome_categoria'] ?? 'Sem Categoria') ?>
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <a href="index.php?rota=processar-ferramenta&acao=excluir&id=<?= $item['id'] ?>"
                               style="color: #ff5c7c; text-decoration: none;"
                               onclick="return confirm('Deseja excluir?')">Remover</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="padding: 30px; text-align: center; color: #8a8f9d;">Nenhum item encontrado no banco de dados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'footer.php'; ?>
