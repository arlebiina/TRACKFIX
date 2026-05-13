<?php
include 'header.php';

// 1. BUSCAR CATEGORIAS
$stmtCat = $pdo->query("SELECT id, categoria FROM categorias_item");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// 2. BUSCAR ITENS
try {
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

<style>
    /* Animação de entrada */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .tool-manager-section {
        animation: slideUp 0.6s ease-out forwards;
    }

    /* Estilo para as linhas da tabela */
    .table-row {
        transition: background 0.3s ease;
    }

    .table-row:hover {
        background: rgba(92, 124, 255, 0.05) !important;
    }

    /* Customização dos inputs para manter o foco azul */
    .input-field:focus {
        border-color: #5c7cff !important;
        box-shadow: 0 0 8px rgba(92, 124, 255, 0.2);
        outline: none;
    }

    .btn-delete {
        transition: all 0.3s ease;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .btn-delete:hover {
        background: rgba(255, 92, 124, 0.1);
        text-decoration: underline !important;
    }
</style>

<section class="content tool-manager-section" style="background-color: #0f111a; color: #fff; padding: 20px; min-height: 100vh;">
    <h2 style="margin-bottom: 20px; font-family: Verdana, sans-serif; color: #7da5fb;">🛠️ Gerenciar Ferramentas</h2>
    
    <div class="card" style="background: #1a1d29; border-radius: 12px; padding: 25px; margin-bottom: 30px; border: 1px solid #2d3142;">
        <form action="index.php?rota=processar-ferramenta&acao=salvar" method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="display:block; margin-bottom: 8px; color: #8a8f9d;">Descrição da Ferramenta</label>
                    <input type="text" name="descricao" placeholder="Ex: Furadeira Impacto" required class="input-field"
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #2d3142; background: #0f111a; color: #fff;">
                </div>
                <div>
                    <label style="display:block; margin-bottom: 8px; color: #8a8f9d;">Categoria</label>
                    <select name="categoria_id" required class="input-field"
                            style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #2d3142; background: #0f111a; color: #fff;">
                        <option value="">Selecione uma categoria...</option>
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['categoria']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" style="margin-top: 20px; background: #5c7cff; color: #fff; border: none; padding: 12px 30px; border-radius: 25px; cursor: pointer; font-weight: bold; transition: 0.3s;">
                Salvar Ferramenta
            </button>
        </form>
    </div>

    <div style="background: #1a1d29; border-radius: 12px; border: 1px solid #2d3142; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #25293a; color: #8a8f9d;">
                    <th style="padding: 15px;">ID</th>
                    <th style="padding: 15px;">Descrição</th>
                    <th style="padding: 15px;">Categoria</th>
                    <th style="padding: 15px; text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($itens)): ?>
                    <?php foreach($itens as $item): ?>
                    <tr class="table-row" style="border-bottom: 1px solid #2d3142;">
                        <td style="padding: 15px; color: #8a8f9d;">#<?= $item['id'] ?></td>
                        <td style="padding: 15px; font-weight: 500;"><?= htmlspecialchars($item['descricao']) ?></td>
                        <td style="padding: 15px;">
                            <span style="background: rgba(92, 124, 255, 0.1); color: #7da5fb; padding: 4px 12px; border-radius: 15px; font-size: 0.85rem;">
                                <?= htmlspecialchars($item['nome_categoria'] ?? 'Sem Categoria') ?>
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="index.php?rota=processar-ferramenta&acao=excluir&id=<?= $item['id'] ?>"
                               class="btn-delete"
                               style="color: #ff5c7c; text-decoration: none; font-weight: 500;"
                               onclick="return confirm('Tem certeza que deseja remover esta ferramenta?')">
                               <i class="fas fa-trash-alt"></i> Remover
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="padding: 40px; text-align: center; color: #8a8f9d;">Nenhum item encontrado no banco de dados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'footer.php'; ?>
