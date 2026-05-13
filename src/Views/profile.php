<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ?rota=login");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$mensagem = "";

// Lógica de Salvamento
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

// BUSCA DADOS ATUALIZADOS + EMPRESA + ENDEREÇO (JOIN)
$sql = "SELECT u.*, e.razao_social, end.logradouro, end.numero, end.cidade, end.estado 
        FROM usuarios u
        LEFT JOIN empresas e ON u.empresa_id = e.id
        LEFT JOIN endereco end ON e.endereco_id = end.id
        WHERE u.id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

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
        <p class="muted">Gerencie suas informações e sua unidade vinculada.</p>
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
            <div class="sobre-icon">🏢</div>
            <h3>Minha Unidade</h3>
            <div class="historico-container" style="text-align: left;">
                <?php if (!empty($user['razao_social'])): ?>
                    <div class="item-hist" style="border-left: 3px solid #7da5fb; padding-left: 15px;">
                        <p style="color: #fff; font-weight: bold; font-size: 1.1rem; margin-bottom: 5px;">
                            <?= htmlspecialchars($user['razao_social']) ?>
                        </p>
                        <p class="muted" style="font-size: 0.9rem;">
                            📍 <?= htmlspecialchars($user['logradouro']) ?>, <?= htmlspecialchars($user['numero']) ?><br>
                            <?= htmlspecialchars($user['cidade']) ?> - <?= htmlspecialchars($user['estado']) ?>
                        </p>
                    </div>
                <?php else: ?>
                    <p class="muted">Você ainda não possui uma empresa vinculada.</p>
                    <a href="index.php?rota=empresas" class="btn-glow" style="display:inline-block; margin-top: 10px; padding: 10px 20px; text-decoration: none; font-size: 0.8rem;">Vincular Agora</a>
                <?php endif; ?>
            </div>
        </section>

        <section class="card-perfil-v3 centro">
            <div class="sobre-icon">🛡️</div>
            <h3>Nível de Acesso</h3>
            <div class="badge-cargo" style="background: var(--primary); margin: 20px 0;"><?= $cargo_txt ?></div>
            <p class="muted" style="font-size: 12px;">ID do Usuário: #<?= $user['id'] ?? '0' ?></p>
            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.05); margin: 20px 0; width: 100%;">
            <p class="muted">Conta sincronizada com TrackFix Cloud.</p>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
