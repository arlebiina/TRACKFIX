<?php include 'header.php'; ?>

<style>
    /* Estilo Glassmorphism para os Cartões */
    .sobre-card-glass {
        background: rgba(255, 255, 255, 0.03) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 20px !important;
        padding: 30px;
        text-align: center;
        flex: 1 1 300px;
        max-width: 350px;
        transition: all 0.4s ease !important;
    }

    .sobre-card-glass:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.07) !important;
        border-color: var(--primary) !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    }

    .sobre-icon-glass {
        font-size: 3rem;
        margin-bottom: 20px;
        display: block;
    }

    /* Botão com efeito Glow */
    .btn-glow {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 14px 35px;
        background: var(--primary);
        color: white;
        text-decoration: underline;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 0 15px rgba(37, 99, 235, 0.4);
        border: none;
    }

    .btn-glow:hover {
        box-shadow: 0 0 30px var(--primary);
        transform: scale(1.05);
        color: #fff;
    }

    .grid-centralizado {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
        margin-top: 40px;
    }
</style>

<main class="layout">
    <div class="content">
        <section class="sobre-section">
            <header style="text-align: center; margin-bottom: 50px;">
                <h1 class="sobre-titulo">Equipe de Desenvolvimento </h1>
                <p class="muted">Conheça os 5 especialistas por trás do TrackFix.</p>
            </header>

            <div class="grid-centralizado">
                
                <div class="sobre-card-glass">
                    <span class="sobre-icon-glass">👩🏻‍💻</span>
                     <h3 style="color: #7da5fb; font-size: 1.5rem; font-weight: 800; font-family: Verdana, sans-serif; margin-bottom: 10px;">Nome do Dev 1</h3>
                    <p class="muted" style="font-size: 0.85rem;">Especialidade 1</p>
                    <hr style="opacity: 0.1; margin: 15px 0;">
                    <p>Texto para a descrição das atividades do primeiro desenvolvedor.</p>
                </div>

                <div class="sobre-card-glass">
                    <span class="sobre-icon-glass">💻</span>
                     <h3 style="color: #7da5fb; font-size: 1.5rem; font-weight: 800; font-family: Verdana, sans-serif; margin-bottom: 10px;">Nome do Dev 2</h3>
                    <p class="muted" style="font-size: 0.85rem;">Especialidade 2</p>
                    <hr style="opacity: 0.1; margin: 15px 0;">
                    <p>Texto para a descrição das atividades do segundo desenvolvedor.</p>
                </div>

                <div class="sobre-card-glass">
                    <span class="sobre-icon-glass">🛡️</span>
                     <h3 style="color:#7da5fb; font-size: 1.5rem; font-weight: 800; font-family: Verdana, sans-serif; margin-bottom: 10px;">Nome do Dev 3</h3>
                    <p class="muted" style="font-size: 0.85rem;">Especialidade 3</p>
                    <hr style="opacity: 0.1; margin: 15px 0;">
                    <p>Texto para a descrição das atividades do terceiro desenvolvedor.</p>
                </div>

                <div class="sobre-card-glass">
                    <span class="sobre-icon-glass">🎨</span>
                     <h3 style="color: #7da5fb; font-size: 1.5rem; font-weight: 800; font-family: Verdana, sans-serif; margin-bottom: 10px;">Nome do Dev 4</h3>
                    <p class="muted" style="font-size: 0.85rem;">Especialidade 4</p>
                    <hr style="opacity: 0.1; margin: 15px 0;">
                    <p>Texto para a descrição das atividades do quarto desenvolvedor.</p>
                </div>

               <div class="sobre-card-glass">
                    <span class="sobre-icon-glass">🔨</span>
                     <h3 style="color: #7da5fb; font-size: 1.5rem; font-weight: 800; font-family: Verdana, sans-serif; margin-bottom: 10px;">Nome do Dev 5</h3>
                    <p class="muted" style="font-size: 0.85rem;">Especialidade 5</p>
                    <hr style="opacity: 0.1; margin: 15px 0;">
                    <p>Texto para a descrição das atividades do quinto desenvolvedor.</p>
                </div>

            </div>

            <div style="text-align: center; margin-top: 60px; padding-bottom: 40px;">
                <a href="?rota=home" class="btn-glow">
                    <i class="fas fa-chevron-left"></i> Voltar ao Sistema
                </a>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
