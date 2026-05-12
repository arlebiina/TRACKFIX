<?php
$acao = $_GET['acao'] ?? '';

if ($acao == 'salvar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'] ?? '';
    $cat_id = $_POST['categoria_id'] ?? null;

    try {
        // Alinhado com as colunas reais: descricao, categoria_id
        $sql = "INSERT INTO itens (descricao, categoria_id) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$descricao, $cat_id]);

        header("Location: index.php?rota=tool-manager&sucesso=1");
        exit();
    } catch (PDOException $e) {
        die("Erro ao salvar no banco de dados: " . $e->getMessage());
    }
}

if ($acao == 'excluir' && isset($_GET['id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM itens WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        header("Location: index.php?rota=tool-manager&deletado=1");
        exit();
    } catch (PDOException $e) {
        die("Erro ao excluir: " . $e->getMessage());
    }
}