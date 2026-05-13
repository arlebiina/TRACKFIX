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
            
            // --- TRAVA DE SEGURANÇA: VERIFICA SE O USUÁRIO JÁ TEM EMPRESA ---
            $stmtCheck = $pdo->prepare("SELECT empresa_id FROM usuarios WHERE id = ?");
            $stmtCheck->execute([$_SESSION['usuario_id']]);
            $userCheck = $stmtCheck->fetch();

            if (!empty($userCheck['empresa_id'])) {
                echo "<script>alert('Atenção: Você já possui uma unidade cadastrada em sua conta!'); window.location.href='index.php?rota=profile';</script>";
                exit();
            }
            // --- FIM DA TRAVA ---

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

                // 2. Inserir a Empresa usando o ID do endereço
                $sqlEmp = "INSERT INTO empresas (razao_social, endereco_id) VALUES (?, ?)";
                $stmtEmp = $pdo->prepare($sqlEmp);
                $stmtEmp->execute([$_POST['razao_social'], $endereco_id]);
                $empresa_id = $pdo->lastInsertId();

                // 3. Vincular o usuário logado à empresa
                if (isset($_SESSION['usuario_id'])) {
                    $sqlUser = "UPDATE usuarios SET empresa_id = ? WHERE id = ?";
                    $pdo->prepare($sqlUser)->execute([$empresa_id, $_SESSION['usuario_id']]);
                    $_SESSION['usuario_empresa_id'] = $empresa_id; 
                }

                $pdo->commit();
                header("Location: index.php?rota=profile&msg=empresa_vinculada");
                exit();

            } catch (Exception $e) {
                $pdo->rollBack();
                die("Erro ao cadastrar: " . $e->getMessage());
            }
        }
        break;

    default:
        include $baseDir . '/src/Views/login.php';
        break;
}
