<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trackfix • Oficina</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style_trackfix.css?v=<?php echo time(); ?>">
</head>
<body class="<?php echo (isset($_COOKIE['sidebarStatus']) && $_COOKIE['sidebarStatus'] === 'active') ? 'menu-open-body' : ''; ?>">
   
    <header class="nav">
        <div class="brand">
            <button id="toggleMenu" class="btn-ghost" style="font-size:20px">☰</button>
            <div class="logo"></div>
            <div>
                <div style="font-size:16px">Oficina • <span class="badge ok">Gestão</span></div>
                <small class="muted">Estoque & Rastreamento</small>
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
            <button id="notifyBtn" class="btn-ghost">🔔</button>
           
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
            // Função rápida para marcar o link ativo
            $current = $_GET['rota'] ?? 'home';
            function isActive($route, $current) { echo ($route === $current) ? 'active' : ''; }
        ?>

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
