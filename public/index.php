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

switch ($rota) {
    case 'home':
        include $baseDir . '/src/Views/principal.php';
        break;

    case 'login':
        include $baseDir . '/src/Views/login.php';
        break;

    case 'sobre':
        include $baseDir . '/src/Views/sobre.php';
        break;

    case 'desenvolvedores':
        include $baseDir . '/src/Views/desenvolvedores.php';
        break;

    case 'ajuda':
        include $baseDir . '/src/Views/help.php';
        break;

    case 'politica':
        include $baseDir . '/src/Views/politica.php';
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
                    header("Location: ?rota=profile");
                    exit();
                } else {
                    echo "<script>alert('E-mail ou senha incorretos!'); window.history.back();</script>";
                }
            } catch (PDOException $e) {
                die("Erro técnico: " . $e->getMessage());
            }
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: ?rota=login");
        exit();
        break;

    case 'profile':
        include $baseDir . '/src/Views/profile.php';
        break;

    case 'config':
        include $baseDir . '/src/Views/config.php';
        break;

    case 'search':
        include $baseDir . '/src/Views/search.php';
        break;
        
        case 'rastreio':
    include __DIR__ . '/../src/Views/rastreio.php';
    break;

    default:
        include $baseDir . '/src/Views/login.php';
        break;
}
