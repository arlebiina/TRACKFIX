<?php
// PARTE 1: Lógica de Processamento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['rota'])) {
    $rota = $_GET['rota'];

    // LÓGICA DE LOGIN
    if ($rota === 'logar') {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (!empty($email) && !empty($senha)) {
            // Aqui você faria a consulta no Banco de Dados
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.toast('Login realizado com sucesso!', 'success');
                    setTimeout(function(){ window.location.href = '?rota=search'; }, 1500);
                });
            </script>";
        }
    }

    // LÓGICA DE CADASTRO (O que estava faltando!)
    if ($rota === 'cadastrar') {
        $nome  = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $cargo = $_POST['tipo_id'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (!empty($nome) && !empty($email) && !empty($senha)) {
            // Aqui você inseriria os dados no Banco de Dados (INSERT INTO...)
            
            // Simulação de sucesso com Toast
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.toast('Conta criada com sucesso! Redirecionando...', 'success');
                    setTimeout(function(){ window.location.href = '?rota=search'; }, 2000);
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.toast('Por favor, preencha todos os campos.', 'error');
                });
            </script>";
        }
    }
}

include 'header.php';
?>

<main class="layout">
    <div class="login-cadastro-container">
        
        <div class="card-auth">
            <h3>Login</h3>
            <p>Acesse com e-mail/senha ou utilize o login social.</p>
            
            <form action="?rota=logar" method="POST">
                <div class="campo">
                    <label>E-mail</label>
                    <input type="email" name="email" placeholder="voce@exemplo.com" required>
                </div>
                
                <div class="campo">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="********" required>
                </div>
                
                <div class="opcoes-extras">
                    <div class="check-group">
                        <input type="checkbox" id="manter" name="manter">
                        <label for="manter">Manter conectado</label>
                    </div>
                    <a href="?rota=recuperar-senha" class="link-secundario">Esqueci a senha</a>
                </div>

                <div class="opcoes-2fa">
                    <div class="check-group">
                        <input type="checkbox" id="ativar2fa" name="2fa">
                        <label for="ativar2fa">Ativar 2FA</label>
                    </div>
                    <select name="meio_2fa" class="select-track">
                        <option value="email">E-mail</option>
                        <option value="sms">SMS</option>
                    </select>
                </div>

                <button type="submit" class="btn-principal">Entrar</button>
            </form>
        </div>

        <div class="card-auth">
            <div class="social-login-area">
                <h3>Entrar com</h3>
                <a href="?rota=login-google" class="btn-google">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google">
                    Entrar com Google
                </a>
            </div>

            <hr class="divisor">

            <h3>Criar conta</h3>
            <form action="?rota=cadastrar" method="POST">
                <div class="grid-cadastro">
                    <div class="campo">
                        <label>Nome</label>
                        <input type="text" name="nome" placeholder="Seu nome completo" required>
                    </div>
                    
                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email" placeholder="voce@exemplo.com" required>
                    </div>

                    <div class="campo">
                        <label>Cargo</label>
                        <select name="tipo_id" class="select-track" required>
                            <option value="3">Gerente</option>
                            <option value="2">Usuário</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Senha</label>
                        <input type="password" name="senha" placeholder="********" required>
                    </div>
                </div>

                <button type="submit" class="btn-secundario">Cadastrar</button>
            </form>
        </div>

    </div>
</main>

<?php include 'footer.php'; ?>
