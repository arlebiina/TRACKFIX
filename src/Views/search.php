<?php
include 'header.php';

// 1. CAPTURA DOS FILTROS
$termo     = $_GET['q'] ?? '';
$categoria = $_GET['cat'] ?? 'Todos';

try {
    // 2. QUERY CORRIGIDA
    // No seu banco, a tabela é 'itens' e a coluna de nome é 'descricao'
    // A categoria vem da tabela 'categorias_item'
    $sql = "SELECT i.id, i.descricao, c.categoria
            FROM itens i
            LEFT JOIN categorias_item c ON i.categoria_id = c.id
            WHERE 1=1";
   
    $params = [];

    // Filtro de busca por texto (na coluna 'descricao')
    if (!empty($termo)) {
        $sql .= " AND i.descricao LIKE :termo";
        $params['termo'] = "%$termo%";
    }

    // Filtro de Categoria (pelo nome da categoria)
    if ($categoria !== 'Todos') {
        $sql .= " AND c.categoria = :categoria";
        $params['categoria'] = $categoria;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $ferramentas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Busca categorias para o SELECT
    $stmtCat = $pdo->query("SELECT categoria FROM categorias_item");
    $listaCategorias = $stmtCat->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
    $ferramentas = [];
    $listaCategorias = [];
}
?>

<main class="layout" style="background-color: #0f111a; color: #fff; padding: 20px;">
    <div id="view-search" class="card content">
        <h2 style="margin-bottom: 20px;">Pesquisa de Ferramentas</h2>
       
        <form id="filterForm" method="GET" action="index.php">
            <input type="hidden" name="rota" value="search">
           
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; background: #1a1d29; padding: 20px; border-radius: 12px; border: 1px solid #2d3142; margin-bottom: 20px;">
                <div class="field">
                    <label style="display:block; color: #8a8f9d; margin-bottom: 5px;">Categoria</label>
                    <select name="cat" onchange="this.form.submit()" style="width:100%; padding: 10px; border-radius: 8px; background: #0f111a; color: #fff; border: 1px solid #2d3142;">
                        <option value="Todos">Todas as Categorias</option>
                        <?php foreach ($listaCategorias as $catNome): ?>
                            <option value="<?= $catNome ?>" <?= $categoria == $catNome ? 'selected' : '' ?>><?= $catNome ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field">
                    <label style="display:block; color: #8a8f9d; margin-bottom: 5px;">Buscar pelo Nome</label>
                    <input name="q" type="text" placeholder="Ex: Furadeira..." value="<?= htmlspecialchars($termo) ?>" style="width:100%; padding: 10px; border-radius: 8px; background: #0f111a; color: #fff; border: 1px solid #2d3142;">
                </div>
            </div>
        </form>

        <div class="card" style="background: #1a1d29; border-radius: 12px; padding: 20px; border: 1px solid #2d3142;">
            <div style="margin-bottom: 15px;">
                <strong>Resultados Encontrados:</strong>
                <span style="background: #5c7cff; padding: 2px 10px; border-radius: 10px; font-size: 14px;"><?= count($ferramentas) ?></span>
            </div>
           
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="text-align: left; color: #8a8f9d; border-bottom: 1px solid #2d3142;">
                            <th style="padding: 12px;">ID</th>
                            <th style="padding: 12px;">FERRAMENTA (DESCRIÇÃO)</th>
                            <th style="padding: 12px;">CATEGORIA</th>
                            <th style="padding: 12px;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($ferramentas)): ?>
                            <tr>
                                <td colspan="4" style="text-align:center; padding:40px; color: #8a8f9d;">
                                    Nenhuma ferramenta encontrada com esses filtros.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($ferramentas as $f): ?>
                                <tr style="border-bottom: 1px solid #2d3142;">
                                    <td style="padding: 12px; color: #8a8f9d;"><?= $f['id'] ?></td>
                                    <td style="padding: 12px;"><strong><?= htmlspecialchars($f['descricao']) ?></strong></td>
                                    <td style="padding: 12px;"><?= htmlspecialchars($f['categoria'] ?? 'Sem Categoria') ?></td>
                                    <td style="padding: 12px;"><span style="color: #4ade80;">✔ Disponível</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>