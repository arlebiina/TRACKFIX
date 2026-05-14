<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trackfix • Oficina</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style_trackfix.css?v=<?php echo time(); ?>">
    
    <style>
        .brand .logo {
            width: 42px;
            height: 42px;
            background-image: url('img/logo-trackfix.png') !important;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 50%;
            border: 2px solid #7da5fb;
            display: inline-block;
            flex-shrink: 0;
        }

        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .notification-panel {
            position: absolute;
            top: 60px;
            right: 0;
            width: 280px;
            background: #11141b;
            border: 1px solid #7da5fb;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);
            z-index: 1000;
            display: none;
            overflow: hidden;
        }
    </style>
</head>
<body class="<?php echo (isset($_COOKIE['sidebarStatus']) && $_COOKIE['sidebarStatus'] === 'active') ? 'menu-open-body' : ''; ?>">
   
    <div id="toast-container"></div>

    <header class="nav">
        <div class="brand">
            <button id="toggleMenu" class="btn-ghost" style="font-size:20px">☰</button>
            <div class="logo"></div>
            <div>
                <div style="font-size:16px">Oficina • <span class="badge ok">Gestão</span></div>
                <small class="muted">TrackFix</small>
            </div>
        </div>
        
        <form action="index.php" method="GET" class="searchbar">
            <input type="hidden" name="rota" value="search">
            <span class="icon">🔎</span>
            <input name="q" id="globalSearch" type="search" placeholder="Buscar (Atalho: / )" value="<?= $_GET['q'] ?? '' ?>" />
        </form>

        <div class="actions">
            <button id="toggleTheme" class="btn-ghost" title="Alternar Tema">🌓</button>
            <button id="toggleContrast" class="btn-ghost" title="Alto Contraste">◐</button>
            
            <div style="position: relative; display: inline-block;">
                <button id="notifyBtn" class="btn-ghost">🔔</button>
                <div id="notificationPanel" class="notification-panel">
                    <div style="padding: 12px; background: rgba(125,165,251,0.1); border-bottom: 1px solid #333; font-weight: bold; color: #fff; font-size: 13px;">
                        Notificações
                    </div>
                    <div style="padding: 20px; text-align: center; color: #666; font-size: 12px;">
                        Nenhuma notificação nova
                    </div>
                </div>
            </div>
            
            <?php if(isset($_SESSION['usuario_nome'])): ?>
                <span style="margin-right: 10px; font-size: 14px;">Olá, <?= explode(' ', $_SESSION['usuario_nome'])[0] ?></span>
                <a href="?rota=logout" class="btn-ghost">Sair</a>
            <?php else: ?>
                <a href="?rota=login" class="btn">Entrar</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="layout">
    <aside class="sidebar">
        <?php
            $current = $_GET['rota'] ?? 'home';
            function isActive($route, $current) { echo ($route === $current) ? 'active' : ''; }
        ?>

        <a href="?rota=empresas" class="navlink <?php isActive('empresas', $current); ?>">🏢 <span>Cadastrar empresa</span></a>
        <a href="?rota=login" class="navlink <?php isActive('login', $current); ?>">🔒 <span>Login & Cadastro</span></a>
        <a href="?rota=sobre" class="navlink <?php isActive('sobre', $current); ?>">🏷️ <span>Sobre Nós</span></a>
        <a href="?rota=politica" class="navlink <?php isActive('politica', $current); ?>">🛡️ <span>Política de Privacidade</span></a>
        <a href="?rota=ajuda" class="navlink <?php isActive('ajuda', $current); ?>">🆘 <span>Ajuda / Suporte</span></a>
        
        <hr style="opacity: 0.1; margin: 10px 0;">
        
        <a href="?rota=search" class="navlink <?php isActive('search', $current); ?>">🧰 <span>Pesquisa</span></a>
        <a href="?rota=rastreio" class="navlink <?php isActive('rastreio', $current); ?>">🗺️ <span>Rastrear Item</span></a>
        <a href="?rota=manutencao" class="navlink <?php isActive('manutencao', $current); ?>">📅 <span>Agenda de Manutenção</span></a>
        <a href="?rota=tool-manager" class="navlink <?php isActive('tool-manager', $current); ?>">🛠️ <span>Gerenciar Ferramentas</span></a>
        
        <hr style="opacity: 0.1; margin: 10px 0;">

        <a href="?rota=profile" class="navlink <?php isActive('profile', $current); ?>">👤 <span>Perfil do Usuário</span></a>
        <a href="?rota=config" class="navlink <?php isActive('config', $current); ?>">⚙️ <span>Configurações</span></a>
        <a href="?rota=desenvolvedores" class="navlink <?php isActive('desenvolvedores', $current); ?>">🧑‍💻 <span>Desenvolvedores</span></a>
    </aside>

    <script src="js/Script_trackfix.js?v=<?php echo time(); ?>"></script>
