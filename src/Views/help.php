<?php include 'header.php'; ?>

<div class="content">
    <div class="ajuda-v2-container">
        <h2>Ajuda / Suporte</h2>

        <div class="ajuda-v2-grid">
            <div class="ajuda-v2-card">
                <h3>FAQ</h3>
                <div class="ajuda-v2-faq-item">
                    <details>
                        <summary>▶ Como faço login com 2FA?</summary>
                        <p>Ative no seu perfil para maior segurança.</p>
                    </details>
                </div>
                <div class="ajuda-v2-faq-item">
                    <details>
                        <summary>▶ Como registrar um empréstimo?</summary>
                        <p>Acesse o menu Gerenciador e selecione a ferramenta.</p>
                    </details>
                </div>
            </div>

            <div class="ajuda-v2-card">
                <h3>Fale conosco</h3>
                <form action="?rota=enviar-ajuda" method="POST" class="ajuda-v2-form">
                    <div class="ajuda-v2-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="ajuda-v2-input" placeholder="Seu nome">
                    </div>
                    <div class="ajuda-v2-group">
                        <label>Mensagem</label>
                        <textarea name="msg" class="ajuda-v2-input" rows="4"></textarea>
                    </div>
                    <button type="submit" class="ajuda-v2-btn">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
