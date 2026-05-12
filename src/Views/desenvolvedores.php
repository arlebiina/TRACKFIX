<?php include 'header.php'; ?>

<style>
    /* Efeito de Vidro (Glassmorphism) */
    .card-dev-glass {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 20px !important;
        padding: 35px 25px;
        text-align: center;
        flex: 1 1 300px;
        max-width: 340px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card-dev-glass:hover {
        transform: translateY(-12px);
        background: rgba(255, 255, 255, 0.08) !important;
        border-color: var(--primary) !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
    }

    .dev-icon {
        font-size: 3.5rem;
        margin-bottom: 20px;
        filter: drop-shadow(0 0 10px rgba(255,255,255,0.2));
    }

    .dev-name {
        font-weight: 700;
        color: #fff;
        margin-bottom: 5px;
        font-size: 1.4rem;
    }

    /* Botão Voltar com Glow */
    .btn-glow-back {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 15px 40px;
        background: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 0 20px rgba(37, 99, 235, 0.4);
        border: none;
        margin-top: 50px;
    }

    .btn-glow-back:hover {
        box-shadow: 0 0 35px var(--primary);
        transform: scale(1.05);
        filter: brightness(1.1);
        color: #fff;
    }

    /* Grid que centraliza os itens que sobrarem */
    .dev-container-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        margin-top: 50px;
    }
</style>

<main class="layout">
    <div class="content">
        <section class="sobre-section">
            <div style="text-align: center;">
                <h1 class="sobre-titulo" style="font-size: 2.5rem; letter-spacing: -1px;">Equipa de Engenharia</h1>
                <p class="muted">Os desenvolvedores responsáveis pelo ecossistema TrackFix</p>
            </div>

            <div class="dev-container-grid">
                
                <div class="card-dev-glass">
                    <div class="dev-icon">👨‍💻</div>
                    <div class="dev-name">Nome do Dev 1</div>
                    <p class="muted" style="font-size: 0.8rem; text-transform: uppercase; margin-bottom: 15px;">Full Stack</p>
                    <p>Texto reservado para a biografia e competências do primeiro desenvolvedor.</p>
                </div>

                <div class="card-dev-glass">
                    <div class="dev-icon">💻</div>
                    <div class="dev-name">Nome do Dev 2</div>
                    <p class="muted" style="font-size: 0.8rem; text-transform: uppercase; margin-bottom: 15px;">Backend</p>
                    <p>Texto reservado para a biografia e competências do segundo desenvolvedor.</p>
                </div>

                <div class="card-dev-glass">
                    <div class="dev-icon">🛡️</div>
                    <div class="dev-name">Nome do Dev 3</div>
                    <p class="muted" style="font-size: 0.8rem; text-transform: uppercase; margin-bottom: 15px;">Segurança</p>
                    <p>Texto reservado para a biografia e competências do terceiro desenvolvedor.</p>
                </div>

                <div class="card-dev-glass">
                    <div class="dev-icon">🎨</div>
                    <div class="dev-name">Nome do Dev 4</div>
                    <p class="muted" style="font-size: 0.8rem; text-transform: uppercase; margin-bottom: 15px;">UI/UX Designer</p>
                    <p>Texto reservado para a biografia e competências do quarto desenvolvedor.</p>
                </div>

                <div class="card-dev-glass">
                    <div class="dev-icon">⚙️</div>
                    <div class="dev-name">Nome do Dev 5</div>
                    <p class="muted" style="font-size: 0.8rem; text-transform: uppercase; margin-bottom: 15px;">DevOps</p>
                    <p>Texto reservado para a biografia e competências do quinto desenvolvedor.</p>
                </div>

            </div>

            <div style="text-align: center; padding-bottom: 60px;">
                <a href="?rota=home" class="btn-glow-back">
                    <i class="fas fa-arrow-left"></i> Voltar ao Sistema
                </a>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
