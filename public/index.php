<?php
/**
 * ARQUIVO: public/index.php
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$baseDir = dirname(__DIR__);
$configPath = $baseDir . '/config/database.php';

if (file_exists($configPath)) {
    require_once $configPath;
} else {
    die("Erro Crítico: Ficheiro database.php não encontrado.");
}

$rota = $_GET['rota'] ?? 'home';

// Função auxiliar para verificar se o usuário está logado
function verificarAcesso() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: ?rota=login");
        exit();
    }
}

switch ($rota) {
    case 'home':
        include $baseDir . '/src/Views/principal.php';
        break;

    case 'login':
        include $baseDir . '/src/Views/login.php';
        if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'sucesso') {
            echo "<script>window.onload = () => window.toast('Conta criada! Faça seu login.', 'success');</script>";
        }
        break;

    case 'cadastrar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');
            $tipo  = $_POST['tipo_id'] ?? 2;

            if (!empty($nome) && !empty($email) && !empty($senha)) {
                try {
                    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO usuarios (primeiro_nome, email, senha, tipo_id) VALUES (?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$nome, $email, $senhaHash, $tipo]);
                    header("Location: ?rota=login&cadastro=sucesso");
                    exit();
                } catch (PDOException $e) {
                    $msg = ($e->getCode() == 23000) ? 'E-mail já cadastrado!' : 'Erro ao cadastrar.';
                    include $baseDir . '/src/Views/login.php';
                    echo "<script>window.onload = () => window.toast('$msg', 'error');</script>";
                    exit();
                }
            }
        }
        break;

    case 'logar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');
            try {
                $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user && password_verify($senha, $user['senha'])) {
                    $_SESSION['usuario_id'] = $user['id'];
                    $_SESSION['usuario_nome'] = $user['primeiro_nome'];
                    $_SESSION['tipo_id'] = $user['tipo_id']; 
                    header("Location: ?rota=profile");
                    exit();
                } else {
                    include $baseDir . '/src/Views/login.php';
                    echo "<script>window.onload = () => window.toast('E-mail ou senha incorretos!', 'error');</script>";
                    exit();
                }
            } catch (PDOException $e) { die("Erro: " . $e->getMessage()); }
        }
        break;

    // ==========================================
    // ROTAS PROTEGIDAS (SÓ ACESSA LOGADO)
    // ==========================================

    case 'profile':
        verificarAcesso();
        include $baseDir . '/src/Views/profile.php';
        break;

    case 'search':
        verificarAcesso();
        include $baseDir . '/src/Views/search.php';
        break;

    case 'rastreio':
        verificarAcesso();
        include $baseDir . '/src/Views/rastreio.php';
        break;

    case 'tool-manager':
        verificarAcesso();
        include $baseDir . '/src/Views/tool-manager.php';
        break;
        
        case 'ajuda':
        include $baseDir . '/src/Views/help.php'; // Verifique se o nome do arquivo é help.php ou ajuda.php
        break;

    case 'sobre':
        include $baseDir . '/src/Views/sobre.php';
        break;

    case 'politica':
        include $baseDir . '/src/Views/politica.php';
        break;

    case 'desenvolvedores':
        include $baseDir . '/src/Views/desenvolvedores.php';
        break;

    case 'config':
        verificarAcesso();
        include $baseDir . '/src/Views/config.php';
        break;

    case 'manutencao':
        verificarAcesso();
        try {
            $stmt_m = $pdo->query("SELECT * FROM historico_manutencao ORDER BY data_manutencao DESC");
            $manutencoes = $stmt_m->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) { $manutencoes = []; }
        include $baseDir . '/src/Views/manutencao.php';
        break;

    case 'empresas':
        verificarAcesso();
        include $baseDir . '/src/Views/empresas.php';
        break;

    case 'processar-empresa':
        verificarAcesso();
        $acao = $_GET['acao'] ?? '';
        if ($acao === 'cadastrar_completo' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se já possui empresa vinculada
            $stmtCheck = $pdo->prepare("SELECT empresa_id FROM usuarios WHERE id = ?");
            $stmtCheck->execute([$_SESSION['usuario_id']]);
            $u = $stmtCheck->fetch();
            if (!empty($u['empresa_id'])) {
                include $baseDir . '/src/Views/profile.php';
                echo "<script>window.onload = () => window.toast('Você já está vinculado a uma unidade!', 'warn');</script>";
                exit();
            }
            try {
                $pdo->beginTransaction();
                $stmtEnd = $pdo->prepare("INSERT INTO endereco (cep, estado, cidade, bairro, logradouro, numero) VALUES (?, ?, ?, ?, ?, ?)");
                $stmtEnd->execute([$_POST['cep'], $_POST['estado'], $_POST['cidade'], $_POST['bairro'], $_POST['logradouro'], $_POST['numero']]);
                $endereco_id = $pdo->lastInsertId();

                $stmtEmp = $pdo->prepare("INSERT INTO empresas (razao_social, endereco_id) VALUES (?, ?)");
                $stmtEmp->execute([$_POST['razao_social'], $endereco_id]);
                $empresa_id = $pdo->lastInsertId();

                $pdo->prepare("UPDATE usuarios SET empresa_id = ? WHERE id = ?")->execute([$empresa_id, $_SESSION['usuario_id']]);
                $pdo->commit();
                header("Location: ?rota=profile&msg=empresa_vinculada");
                exit();
            } catch (Exception $e) {
                $pdo->rollBack();
                include $baseDir . '/src/Views/empresas.php';
                echo "<script>window.onload = () => window.toast('Erro ao cadastrar.', 'error');</script>";
                exit();
            }
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: ?rota=login");
        exit();

    default:
        include $baseDir . '/src/Views/login.php';
        break;
}
