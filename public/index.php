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
                    $_SESSION['tipo_id'] = $user['tipo_id']; 
                    header("Location: ?rota=profile");
                    exit();
                } else {
                    // LOGIN INCORRETO COM TOAST
                    echo "<html><body>";
                    include $baseDir . '/src/Views/login.php';
                    echo "<script>window.onload = () => window.toast('E-mail ou senha incorretos!', 'error');</script>";
                    echo "</body></html>";
                    exit();
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
        // Caso venha de um redirecionamento de sucesso
        if(isset($_GET['msg']) && $_GET['msg'] === 'empresa_vinculada'){
            echo "<script>window.onload = () => window.toast('Unidade vinculada com sucesso!', 'success');</script>";
        }
        break;

    case 'config':
        include $baseDir . '/src/Views/config.php';
        break;

    case 'search':
        include $baseDir . '/src/Views/search.php';
        break;

    case 'rastreio':
        include $baseDir . '/src/Views/rastreio.php';
        break;

    case 'tool-manager':
        include $baseDir . '/src/Views/tool-manager.php';
        break;

    case 'manutencao':
        try {
            $stmt_m = $pdo->query("SELECT * FROM historico_manutencao ORDER BY data_manutencao DESC");
            $manutencoes = $stmt_m->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $manutencoes = [];
        }
        include $baseDir . '/src/Views/manutencao.php';
        break;

    case 'processar-ferramenta':
        include $baseDir . '/src/Views/processar_ferramenta.php';
        break;
        
    case 'empresas':
        include $baseDir . '/src/Views/empresas.php';
        break;

    case 'processar-empresa':
        $acao = $_GET['acao'] ?? '';
        
        if ($acao === 'cadastrar_completo' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // TRAVA DE SEGURANÇA COM TOAST
            $stmtCheck = $pdo->prepare("SELECT empresa_id FROM usuarios WHERE id = ?");
            $stmtCheck->execute([$_SESSION['usuario_id']]);
            $userCheck = $stmtCheck->fetch();

            if (!empty($userCheck['empresa_id'])) {
                include $baseDir . '/src/Views/profile.php';
                echo "<script>window.onload = () => window.toast('Você já possui uma unidade cadastrada!', 'warn');</script>";
                exit();
            }

            try {
                $pdo->beginTransaction();

                // 1. Inserir o Endereço
                $sqlEnd = "INSERT INTO endereco (cep, estado, cidade, bairro, logradouro, numero) VALUES (?, ?, ?, ?, ?, ?)";
                $stmtEnd = $pdo->prepare($sqlEnd);
                $stmtEnd->execute([
                    $_POST['cep'], $_POST['estado'], $_POST['cidade'], 
                    $_POST['bairro'], $_POST['logradouro'], $_POST['numero']
                ]);
                $endereco_id = $pdo->lastInsertId();

                // 2. Inserir a Empresa
                $sqlEmp = "INSERT INTO empresas (razao_social, endereco_id) VALUES (?, ?)";
                $stmtEmp = $pdo->prepare($sqlEmp);
                $stmtEmp->execute([$_POST['razao_social'], $endereco_id]);
                $empresa_id = $pdo->lastInsertId();

                // 3. Vincular usuário
                if (isset($_SESSION['usuario_id'])) {
                    $sqlUser = "UPDATE usuarios SET empresa_id = ? WHERE id = ?";
                    $pdo->prepare($sqlUser)->execute([$empresa_id, $_SESSION['usuario_id']]);
                }

                $pdo->commit();
                // Redireciona com parâmetro para o profile disparar o Toast de sucesso
                header("Location: index.php?rota=profile&msg=empresa_vinculada");
                exit();

            } catch (Exception $e) {
                $pdo->rollBack();
                include $baseDir . '/src/Views/empresas.php';
                echo "<script>window.onload = () => window.toast('Erro ao cadastrar unidade.', 'error');</script>";
            }
        }
        break;

    default:
        include $baseDir . '/src/Views/login.php';
        break;
}
