<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ?rota=login");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$mensagem = "";

// Lógica de Salvamento (Blindada)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_salvar'])) {
    try {
        $stmt_up = $pdo->prepare("UPDATE usuarios SET primeiro_nome = ?, sobrenome = ?, email = ? WHERE id = ?");
        $stmt_up->execute([trim($_POST['primeiro_nome']), trim($_POST['sobrenome']), trim($_POST['email']), $usuario_id]);
        $_SESSION['usuario_nome'] = $_POST['primeiro_nome'];
        $mensagem = "<div class='badge ok'>✓ Dados atualizados com sucesso!</div>";
    } catch (Exception $e) {
        $mensagem = "<div class='badge danger'>⚠ Erro ao salvar alterações.</div>";
    }
}

// Busca dados atuais
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

// Busca histórico geral (para não dar erro de coluna inexistente)
$historico = [];
try {
    $stmt_h = $pdo->query("SELECT item_do_inventario, data_manutencao FROM historico_manutencao ORDER BY id DESC LIMIT 4");
    $historico = $stmt_h->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $historico = []; }

$cargo_txt = (($user['tipo_id'] ?? 0) == 1) ? "Administrador" : "Usuário Padrao";

include 'header.php';
?>

<main class="layout">
    <div class="perfil-header">
        <h2 class="sobre-titulo" style="text-align: left; margin-bottom: 10px;">Meu Perfil</h2>
        <p class="muted">Gerencie suas informações e visualize suas atividades recentes.</p>
        <div style="margin-top: 15px;"><?= $mensagem ?></div>
    </div>

    <div class="perfil-grid-final">
        <section class="card-perfil-v3">
            <div class="sobre-icon">👤</div>
            <h3>Dados Pessoais</h3>
            <form method="POST" class="ajuda-v2-form">
                <div class="ajuda-v2-group">
                    <label>Primeiro Nome</label>
                    <input type="text" name="primeiro_nome" class="ajuda-v2-input" value="<?= htmlspecialchars($user['primeiro_nome'] ?? '') ?>">
                </div>
                <div class="ajuda-v2-group">
                    <label>Sobrenome</label>
                    <input type="text" name="sobrenome" class="ajuda-v2-input" value="<?= htmlspecialchars($user['sobrenome'] ?? '') ?>">
                </div>
                <div class="ajuda-v2-group">
                    <label>E-mail Corporativo</label>
                    <input type="email" name="email" class="ajuda-v2-input" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                </div>
                <button type="submit" name="btn_salvar" class="btn-principal" style="width: 100%; margin-top: 10px;">Atualizar Perfil</button>
            </form>
        </section>

        <section class="card-perfil-v3">
            <div class="sobre-icon">📜</div>
            <h3>Atividades Recentes em Manutenção </h3>
            <div class="historico-container">
                <?php if (empty($historico)): ?>
                    <p class="muted">Nenhuma atividade encontrada.</p>
                <?php else: ?>
                    <?php foreach ($historico as $h): ?>
                        <div class="item-hist">
                            <span class="badge" style="font-size: 10px;"><?= !empty($h['data_manutencao']) ? date('d/m/Y', strtotime($h['data_manutencao'])) : '--/--/--' ?></span>
                            <div style="margin-top: 5px; font-weight: 600;"><?= htmlspecialchars($h['item_do_inventario']) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <section class="card-perfil-v3 centro">
            <div class="sobre-icon">🛡️</div>
            <h3>Nível de Acesso</h3>
            <div class="badge-cargo" style="background: var(--primary); margin: 20px 0;"><?= $cargo_txt ?></div>
            <p class="muted" style="font-size: 12px;">ID do Usuário: #<?= $user['id'] ?? '0' ?></p>
            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.05); margin: 20px 0; width: 100%;">
            <p class="muted">Sua conta está ativa e sincronizada com o banco de dados.</p>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>