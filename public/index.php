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

    case 'recuperar-senha':
        include $baseDir . '/src/Views/recuperar-senha.php';
        break;

    case 'sobre':
        include $baseDir . '/src/Views/sobre.php';
        break;

    case 'ajuda':
        include $baseDir . '/src/Views/help.php';
        break;

    case 'politica':
        include $baseDir . '/src/Views/politica.php';
        break;

    // --- ROTA DE DESENVOLVEDORES (ADICIONADA AQUI) ---
    case 'desenvolvedores':
        include $baseDir . '/src/Views/desenvolvedores.php';
        break;

    // --- LÓGICA DE LOGIN ---
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
                die("Erro técnico no login: " . $e->getMessage());
            }
        }
        break;

    // --- LÓGICA DE CADASTRO ---
    case 'cadastrar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $tipo  = $_POST['tipo_id'] ?? 2;

            try {
                $sql = "INSERT INTO usuarios (primeiro_nome, email, senha, tipo_id) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nome, $email, $senha, $tipo]);
                echo "<script>alert('Conta criada com sucesso!'); window.location='?rota=login';</script>";
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo "<script>alert('E-mail já cadastrado!'); window.history.back();</script>";
                } else {
                    die("Erro ao cadastrar: " . $e->getMessage());
                }
            }
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: ?rota=login");
        exit();
        break;

    case 'manutencao':
        try {
            $stmt = $pdo->query("SELECT * FROM historico_manutencao ORDER BY data_manutencao DESC");
            $manutencoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            include $baseDir . '/src/Views/manutencao.php';
        } catch (PDOException $e) {
            die("Erro ao carregar histórico: " . $e->getMessage());
        }
        break;

    case 'salvar-manutencao':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $sql = "INSERT INTO historico_manutencao (data_manutencao, proxima_manutencao, descricao_servico, item_do_inventario) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $_POST['data_manutencao'],
                    $_POST['proxima_manutencao'] ?: null,
                    $_POST['descricao_servico'],
                    $_POST['item_do_inventario']
                ]);
                header("Location: ?rota=manutencao");
                exit();
            } catch (PDOException $e) {
                die("Erro ao salvar: " . $e->getMessage());
            }
        }
        break;

    case 'tool-manager':
        include $baseDir . '/src/Views/tool-manager.php';
        break;

    case 'processar-ferramenta':
        include $baseDir . '/src/Views/processar_ferramenta.php';
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

    default:
        include $baseDir . '/src/Views/login.php';
        break;
}
