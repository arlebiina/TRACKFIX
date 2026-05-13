<?php include 'header.php'; ?>

<style>
    /* --- EFEITO: ANIMAÇÃO DE ENTRADA SUAVE --- */
    @keyframes fadeIn {
        from { 
            opacity: 0; 
            transform: translateY(20px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    .sobre-section {
        /* Garante que o fade-in funcione no container */
        animation: fadeIn 0.8s ease-out forwards;
    }

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
        
        /* Prepara para a animação em cascata e efeito de brilho */
        opacity: 0; 
        animation: fadeIn 0.8s ease-out forwards;
        position: relative;
        overflow: hidden;
    }

    /* --- EFEITO: ENTRADA EM CASCATA (STAGGER) --- */
    .sobre-card-glass:nth-child(1) { animation-delay: 0.1s; }
    .sobre-card-glass:nth-child(2) { animation-delay: 0.2s; }
    .sobre-card-glass:nth-child(3) { animation-delay: 0.3s; }
    .sobre-card-glass:nth-child(4) { animation-delay: 0.4s; }
    .sobre-card-glass:nth-child(5) { animation-delay: 0.5s; }

    /* --- EFEITO DE BRILHO AO PASSAR O MOUSE --- */
    .sobre-card-glass::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            120deg,
            transparent,
            rgba(255, 255, 255, 0.1),
            transparent
        );
        transition: all 0.6s;
    }

    .sobre-card-glass:hover::before {
        left: 100%;
    }

    .sobre-card-glass:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.07) !important;
        border-color: #7da5fb !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    }

    .sobre-icon-glass {
        font-size: 3rem;
        margin-bottom: 20px;
        display: block;
    }

    /* --- EFEITO 5: BOTÃO GLOW COM O TOM DE AZUL --- */
    .btn-glow {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 14px 45px;
        background: #7da5fb !important;
        color: white !important;
        text-decoration: underline !important;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 0 15px rgba(125, 165, 251, 0.4);
        border: none;
    }

    .btn-glow:hover {
        box-shadow: 0 0 30px #7da5fb;
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
