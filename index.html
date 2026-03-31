<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gestão de Estoque Patrimonial – Oficina</title>
  <meta name="description" content="Modelo de site (SPA) com HTML, CSS e JS para gestão de estoque e rastreamento de ferramentas em oficina mecânica." />
  <style>

    :root {
      --bg: #0b1020;
      --surface: #121833;
      --surface-2: #0f1430;
      --text: #e9edf8;
      --muted: #a6aed0;
      --primary: #7aa2ff;
      --primary-2: #a9c1ff;
      --accent: #6ef3c5;
      --danger: #ff6b80;
      --warning: #ffd166;
      --success: #56f59a;
      --shadow: 0 10px 30px rgba(16, 22, 53, .55);
      --radius: 18px;
      --radius-lg: 24px;
      --focus: 0 0 0 3px rgba(122,162,255,.45), 0 0 0 1px rgba(122,162,255,.9) inset;
      --trans: 170ms cubic-bezier(.2,.6,.2,1);
      --font: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
    }

    /* Alto contraste (WCAG AA+) */
    .high-contrast {
      --bg: #000;
      --surface: #111;
      --surface-2: #0b0b0b;
      --text: #fff;
      --muted: #f0f0f0;
      --primary: #4ea7ff;
      --accent: #00ffa6;
      --shadow: none;
    }

    html, body { height: 100%; }
    body {
      margin: 0;
      background: radial-gradient(1200px 800px at 80% -10%, #1b244c 0%, var(--bg) 60%);
      color: var(--text);
      font-family: var(--font);
      letter-spacing: .2px;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Layout base */
    header.nav {
      position: sticky; top: 0; z-index: 50;
      display: grid; grid-template-columns: 1fr auto auto auto; gap: 12px;
      align-items: center;
      padding: 14px clamp(16px, 4vw, 28px);
      background: rgba(10, 14, 35, .7);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(255,255,255,.06);
    }
    .brand { display:flex; align-items:center; gap:12px; font-weight:700; }
    .brand .logo {
      width: 36px; height: 36px; border-radius: 12px;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      box-shadow: var(--shadow);
    }

    .searchbar { position: relative; max-width: 700px; }
    .searchbar input {
      width: min(70vw, 680px);
      padding: 12px 42px 12px 44px;
      border-radius: var(--radius);
      border: 1px solid rgba(255,255,255,.08);
      background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
      color: var(--text);
      outline: none; transition: box-shadow var(--trans), border var(--trans);
    }
    .searchbar input:focus { box-shadow: var(--focus); border-color: rgba(122,162,255,.8); }
    .searchbar .icon { position:absolute; left: 12px; top: 10px; font-size: 18px; opacity:.85; }
    .searchbar .kbd { position:absolute; right: 12px; top: 8px; font-size: 12px; opacity:.7; padding: 4px 6px; border:1px solid rgba(255,255,255,.2); border-radius: 6px; }

    .actions { display:flex; gap:10px; align-items:center; }
    .actions button, .actions select { height: 38px; }

    .btn, button, input[type="submit"] {
      appearance: none; border: 0; color: #0b1020; font-weight: 700;
      background: linear-gradient(180deg, var(--primary-2), var(--primary));
      padding: 10px 14px; border-radius: var(--radius); cursor: pointer;
      box-shadow: var(--shadow); transition: transform var(--trans), filter var(--trans), opacity var(--trans);
    }
    .btn:hover { filter: brightness(1.06); transform: translateY(-1px); }
    .btn:active { transform: translateY(0); }

    .btn-ghost { background: rgba(255,255,255,.08); color: var(--text); }
    .btn-ghost:hover { background: rgba(255,255,255,.12); }

    .badge { font-size: 12px; padding: 4px 8px; border-radius: 999px; background: rgba(255,255,255,.12); color: var(--text); }
    .badge.ok { background: linear-gradient(90deg, #2ddf88, #6ef3c5); color: #04150f; font-weight: 800; }
    .badge.warn { background: linear-gradient(90deg, #ffd166, #ffb703); color: #271800; font-weight: 800; }
    .badge.danger { background: linear-gradient(90deg, #ff758f, #ff3d5a); color: #2b0010; font-weight: 800; }

    .layout { display:grid; grid-template-columns: 260px 1fr; gap: 18px; padding: 18px clamp(16px, 4vw, 28px); }
    @media (max-width: 980px) { .layout { grid-template-columns: 1fr; } }

    aside.sidebar {
      position: sticky; top: 78px; align-self: start; display:flex; flex-direction: column; gap: 10px;
      background: linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.02));
      border: 1px solid rgba(255,255,255,.06); border-radius: var(--radius-lg); padding: 14px;
    }
    .navlink { display:flex; gap:10px; align-items:center; text-decoration:none; color: var(--text); padding: 10px 12px; border-radius: 12px; }
    .navlink[aria-current="page"], .navlink:hover { background: rgba(255,255,255,.10); }

    .content { display:grid; gap: 18px; }
    .card {
      background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
      border: 1px solid rgba(255,255,255,.06);
      box-shadow: var(--shadow);
      border-radius: var(--radius-lg);
      padding: clamp(14px, 2.4vw, 22px);
    }
    .card h2 { margin: 0 0 8px; font-size: clamp(18px, 2.4vw, 24px); }
    .muted { color: var(--muted); font-size: 14px; }

    .grid { display:grid; gap: 14px; }
    .grid.cols-2 { grid-template-columns: repeat(2, minmax(0,1fr)); }
    .grid.cols-3 { grid-template-columns: repeat(3, minmax(0,1fr)); }
    .grid.cols-4 { grid-template-columns: repeat(4, minmax(0,1fr)); }
    @media (max-width: 1180px){ .grid.cols-3, .grid.cols-4 { grid-template-columns: repeat(2, 1fr);} }
    @media (max-width: 720px){ .grid.cols-2, .grid.cols-3, .grid.cols-4 { grid-template-columns: 1fr; } }

    input, select, textarea {
      background: rgba(255,255,255,.08); color: var(--text);
      border: 1px solid rgba(255,255,255,.14); border-radius: 12px; padding: 10px 12px;
      outline: none; transition: box-shadow var(--trans), border var(--trans);
    }
    input:focus, select:focus, textarea:focus { box-shadow: var(--focus); border-color: rgba(122,162,255,.8); }
    label { font-size: 14px; opacity: .9; }
    .field { display:grid; gap: 8px; }

    table { width: 100%; border-collapse: collapse; border-radius: 14px; overflow: hidden; }
    th, td { text-align:left; padding: 10px 12px; }
    thead { background: rgba(255,255,255,.08); }
    tbody tr { border-bottom: 1px solid rgba(255,255,255,.06); }

    /* Modal & Toast */
    .modal, .drawer { position: fixed; inset: 0; display: none; place-items: center; }
    .modal.open { display: grid; }
    .modal .box { width: min(560px, 92vw); background: var(--surface); border:1px solid rgba(255,255,255,.08); border-radius: var(--radius-lg); box-shadow: var(--shadow); padding: 18px; }
    .toast {
      position: fixed; right: 16px; bottom: 16px; display: grid; gap: 8px; min-width: 260px;
      padding: 14px; background: var(--surface); border:1px solid rgba(255,255,255,.12);
      border-radius: 14px; box-shadow: var(--shadow); opacity: 0; transform: translateY(10px); pointer-events: none; transition: all var(--trans);
    }
    .toast.show { opacity: 1; transform: translateY(0); pointer-events: auto; }

    /* Cookie banner */
    .cookie {
      position: fixed; left: 50%; transform: translateX(-50%);
      bottom: 18px; width: min(760px, 95vw); background: var(--surface);
      border:1px solid rgba(255,255,255,.14); border-radius: var(--radius-lg); padding: 14px; display:none; box-shadow: var(--shadow);
    }

    /* Calendário simples */
    .calendar { display:grid; gap: 8px; }
    .calendar .grid-7 { display:grid; grid-template-columns: repeat(7, 1fr); gap: 6px; }
    .calendar .day, .calendar .dow { text-align:center; padding: 8px; border-radius: 10px; }
    .calendar .dow { font-size:12px; color: var(--muted); }
    .calendar .day { background: rgba(255,255,255,.06); min-height: 64px; display:grid; align-content:start; gap:6px; }
    .calendar .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); display:inline-block; }

    /* Utilitários */
    .row { display:flex; gap: 10px; align-items:center; }
    .right { margin-left: auto; }
    .hidden { display:none !important; }
    .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
  </style>
</head>
<body>
  <!-- Top Bar -->
  <header class="nav" role="navigation" aria-label="Navegação principal">
    <div class="brand">
      <div class="logo" aria-hidden="true"></div>
      <div>
        <div style="font-size:16px">Oficina • <span class="badge ok">Gestão</span></div>
        <small class="muted" data-i18n="subtitle">Estoque & Rastreamento</small>
      </div>
    </div>
    <div class="searchbar" role="search">
      <span class="icon" aria-hidden>🔎</span>
      <input id="globalSearch" type="search" placeholder="Buscar ferramentas, registros…" aria-label="Campo de busca global" />
      <span class="kbd">/</span>
    </div>
    <div class="actions">
      <button id="toggleTheme" class="btn-ghost" aria-pressed="false" title="Modo noturno/Claro">🌓</button>
      <button id="toggleContrast" class="btn-ghost" aria-pressed="false" title="Alto contraste">⬛️</button>
      <select id="lang" aria-label="Selecionar idioma">
        <option value="pt">🇧🇷 PT</option>
        <option value="en">🇺🇸 EN</option>
      </select>
      <button id="notifyBtn" class="btn" title="Notificações">🔔</button>
      <button id="openLogin" class="btn" data-i18n="login">Entrar</button>
    </div>
  </header>

  <div class="layout" role="main">
    <!-- Sidebar -->
    <aside class="sidebar" aria-label="Menu lateral">
      <a class="navlink" href="#login" data-route="login" aria-current="page">🔐 <span data-i18n="menu_login">Login & Cadastro</span></a>
      <a class="navlink" href="#about" data-route="about">🏷️ <span data-i18n="menu_about">Sobre Nós</span></a>
      <a class="navlink" href="#privacy" data-route="privacy">🛡️ <span data-i18n="menu_privacy">Política de Privacidade</span></a>
      <a class="navlink" href="#help" data-route="help">🆘 <span data-i18n="menu_help">Ajuda / Suporte</span></a>
      <a class="navlink" href="#search" data-route="search">🧰 <span data-i18n="menu_search">Pesquisa</span></a>
      <a class="navlink" href="#tool-manager" data-route="tool-manager">🛠️ <span>Gerenciar Ferramentas</span></a>
      <a class="navlink" href="#profile" data-route="profile">👤 <span data-i18n="menu_profile">Perfil do Usuário</span></a>
      <a class="navlink" href="#settings" data-route="settings">⚙️ <span data-i18n="menu_settings">Configurações</span></a>
      <a class="navlink" href="#tracking" data-route="tracking">📍 <span data-i18n="menu_tracking">Rastreio</span></a>
      <a class="navlink" href="#maintenance" data-route="maintenance">🗓️ <span data-i18n="menu_maintenance">Agenda de Manutenção</span></a>
    </aside>

    <!-- Content -->
    <section class="content">

      <!-- LOGIN & CADASTRO -->
      <div id="view-login" class="card" role="region" aria-labelledby="h-login">
        <h2 id="h-login" data-i18n="login_title">Tela Inicial – Login e Cadastro</h2>
        <p class="muted" data-i18n="login_desc">Acesse com e-mail/senha, redes sociais ou ative 2FA.</p>
        <div class="grid cols-2">
          <form id="formLogin" class="card" aria-label="Login tradicional">
            <h3>Login</h3>
            <div class="grid">
              <div class="field">
                <label for="email">E-mail</label>
                <input id="email" type="email" placeholder="voce@exemplo.com" required />
              </div>
              <div class="field">
                <label for="password">Senha</label>
                <input id="password" type="password" placeholder="••••••••" required />
              </div>
              <div class="row">
                <label class="row" for="remember"><input id="remember" type="checkbox" /> <span>Manter conectado</span></label>
                <button type="button" id="forgot" class="btn-ghost right">Esqueci a senha</button>
              </div>
              <div class="row">
                <label class="row" for="twofa"><input id="twofa" type="checkbox" /> <span>Ativar 2FA (e-mail/SMS)</span></label>
                <select id="twofaMethod" aria-label="Método 2FA">
                  <option value="email">E-mail</option>
                  <option value="sms">SMS</option>
                </select>
              </div>
              <input type="submit" class="btn" value="Entrar" />
            </div>
          </form>

          <div class="card" aria-label="Login Social e Cadastro">
            <h3>Entrar com</h3>
            <div class="row">
              <button class="btn" id="googleBtn" aria-label="Entrar com Google">Google</button>
              <button class="btn" id="facebookBtn" aria-label="Entrar com Facebook">Facebook</button>
              <button class="btn" id="githubBtn" aria-label="Entrar com GitHub">GitHub</button>
            </div>
            <hr style="opacity:.15; margin:14px 0"/>
            <h3>Criar conta</h3>
            <div class="grid cols-2">
              <div class="field"><label for="regName">Nome</label><input id="regName" placeholder="Seu nome"/></div>
              <div class="field"><label for="regEmail">E-mail</label><input id="regEmail" type="email" placeholder="voce@exemplo.com"/></div>
              <div class="field"><label for="regRole">Cargo</label>
                <select id="regRole">
                  <option>Usuário</option>
                  <option>Supervisor</option>
                  <option>Administrador</option>
                </select>
              </div>
              <div class="field"><label for="regPass">Senha</label><input id="regPass" type="password" placeholder="••••••••"/></div>
              <button class="btn" id="createAccount">Cadastrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- SOBRE NÓS -->
      <div id="view-about" class="card hidden" aria-labelledby="h-about">
        <h2 id="h-about">Sobre Nós</h2>
        <div class="grid cols-3">
          <div class="card">
            <h3>Missão</h3>
            <p>Evitar perdas e aumentar a produtividade com rastreio e manutenção preventiva.</p>
          </div>
          <div class="card">
            <h3>Visão</h3>
            <p>Ser a plataforma de referência em gestão de ferramentas para oficinas e cursos do SENAI.</p>
          </div>
          <div class="card">
            <h3>Valores</h3>
            <p>Confiabilidade, simplicidade, segurança e acessibilidade.</p>
          </div>
        </div>
        <div class="card">
          <h3>Justificativa</h3>
          <p>Perdas, atrasos e custos extras vêm da falta de controle, rastreio e manutenção. Nosso sistema digital corrige isso com check-in/out, alertas e QR Code.</p>
        </div>
      </div>

      <!-- PRIVACIDADE -->
      <div id="view-privacy" class="card hidden" aria-labelledby="h-privacy">
        <h2 id="h-privacy">Política de Privacidade</h2>
        <ul>
          <li>Coletamos dados pessoais (nome, e-mail, cargo) para autenticação e auditoria.</li>
          <li>Usamos cookies para sessão e preferências (tema, idioma, acessibilidade).</li>
          <li>Você pode gerenciar cookies no painel e solicitar remoção de dados.</li>
        </ul>
        <button class="btn-ghost" id="openCookiePanel">Abrir painel de cookies</button>
      </div>

      <!-- AJUDA / SUPORTE -->
      <div id="view-help" class="card hidden" aria-labelledby="h-help">
        <h2 id="h-help">Ajuda / Suporte</h2>
        <div class="grid cols-2">
          <div class="card">
            <h3>FAQ</h3>
            <details><summary>Como faço login com 2FA?</summary><p>Ative 2FA nas configurações ou na tela de login, receba o código por e-mail ou SMS e confirme.</p></details>
            <details><summary>Como registrar um empréstimo?</summary><p>Na Pesquisa, selecione a ferramenta e clique em Check-out.</p></details>
            <details><summary>Posso usar QR Code?</summary><p>Sim. Use o leitor integrado (beta) ou informe o código manual.</p></details>
          </div>
          <form class="card" id="supportForm">
            <h3>Fale conosco</h3>
            <div class="grid">
              <div class="field"><label>Nome</label><input required/></div>
              <div class="field"><label>E-mail</label><input type="email" required/></div>
              <div class="field"><label>Assunto</label><input required/></div>
              <div class="field"><label>Mensagem</label><textarea rows="4" required></textarea></div>
              <button class="btn" type="submit">Enviar</button>
            </div>
          </form>
        </div>
      </div>

      <!-- PESQUISA -->
      <div id="view-search" class="card hidden" aria-labelledby="h-search">
        <h2 id="h-search">Pesquisa de Ferramentas</h2>
        <div class="grid cols-4 card">
          <div class="field"><label>Categoria</label>
            <select id="fCategoria"><option>Todos</option><option>Elétrica</option><option>Mecânica</option><option>Medição</option></select>
          </div>
          <div class="field"><label>Localização</label>
            <select id="fLocal"><option>Todos</option><option>Armário A</option><option>Armário B</option><option>Oficina 1</option></select>
          </div>
          <div class="field"><label>Status</label>
            <select id="fStatus"><option>Todos</option><option>Disponível</option><option>Emprestada</option><option>Em manutenção</option></select>
          </div>
          <div class="field"><label>Manutenção pendente</label>
            <select id="fPendencia"><option>Todos</option><option>Sim</option><option>Não</option></select>
          </div>
          <div class="field" style="grid-column:1/-1"><label>Buscar</label><input id="searchInput" placeholder="Ex: Paquímetro, Furadeira…" /></div>
        </div>

        <div class="card">
          <div class="row"><strong>Resultados</strong><span id="resultCount" class="badge right">0</span></div>
          <table aria-label="Tabela de ferramentas">
            <thead>
              <tr><th>Ferramenta</th><th>Categoria</th><th>Local</th><th>Status</th><th>Próx. manutenção</th><th>Ações</th></tr>
            </thead>
            <tbody id="toolRows"></tbody>
          </table>
        </div>

        <div class="grid cols-2">
          <div class="card">
            <h3>Leitor de QR Code (beta)</h3>
            <video id="qrVideo" width="100%" height="200" style="background:#000; border-radius:12px" aria-label="Prévia da câmera"></video>
            <div class="row" style="margin-top:8px">
              <button class="btn" id="startQR">Iniciar câmera</button>
              <button class="btn-ghost" id="stopQR">Parar</button>
              <input id="manualQR" placeholder="Ou informe o código manual" class="right" />
            </div>
          </div>

          <div class="card">
            <h3>Observações / Devolução</h3>
            <textarea id="obs" rows="5" placeholder="Registre danos, problemas ou sugestões"></textarea>
            <div class="row" style="margin-top:8px">
              <button class="btn" id="saveObs">Salvar observação</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Gerenciar Ferramentas -->
      <div id="view-tool-manager" class="card hidden" aria-labelledby="h-tool-manager">
        <h2 id="h-tool-manager">Gerenciar Ferramentas</h2>
        <form id="toolForm" class="grid cols-2" aria-label="Formulário de cadastro de ferramenta">
          <div class="field">
            <label for="toolId">Código QR</label>
            <input id="toolId" placeholder="Ex: QR-1234" required />
          </div>
          <div class="field">
            <label for="toolName">Nome</label>
            <input id="toolName" placeholder="Nome da ferramenta" required />
          </div>
          <div class="field">
            <label for="toolCategory">Categoria</label>
            <select id="toolCategory" required>
              <option value="" disabled selected>Selecione</option>
              <option>Elétrica</option>
              <option>Mecânica</option>
              <option>Medição</option>
            </select>
          </div>
          <div class="field">
            <label for="toolLocation">Localização</label>
            <select id="toolLocation" required>
              <option value="" disabled selected>Selecione</option>
              <option>Armário A</option>
              <option>Armário B</option>
              <option>Oficina 1</option>
            </select>
          </div>
          <div class="field">
            <label for="toolStatus">Status</label>
            <select id="toolStatus" required>
              <option value="" disabled selected>Selecione</option>
              <option>Disponível</option>
              <option>Emprestada</option>
              <option>Em manutenção</option>
            </select>
          </div>
          <div class="field">
            <label for="toolNextMaint">Próxima manutenção</label>
            <input id="toolNextMaint" type="date" required />
          </div>
          <div class="field">
            <label for="toolPendencia">Manutenção pendente</label>
            <select id="toolPendencia" required>
              <option value="" disabled selected>Selecione</option>
              <option value="false">Não</option>
              <option value="true">Sim</option>
            </select>
          </div>
          <div class="row" style="grid-column: span 2;">
            <button type="submit" class="btn" id="saveToolBtn">Adicionar</button>
            <button type="button" class="btn-ghost" id="cancelEdit" style="margin-left:10px;">Cancelar</button>
          </div>
        </form>

        <div style="margin-top: 18px;">
          <h3>Ferramentas cadastradas</h3>
          <table aria-label="Tabela de ferramentas cadastradas">
            <thead>
              <tr>
                <th>Código QR</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Localização</th>
                <th>Status</th>
                <th>Próx. manutenção</th>
                <th>Manutenção pendente</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="toolManagerRows"></tbody>
          </table>
        </div>
      </div>

      <!-- PERFIL -->
      <div id="view-profile" class="card hidden" aria-labelledby="h-profile">
        <h2 id="h-profile">Perfil do Usuário</h2>
        <div class="grid cols-3">
          <div class="card">
            <h3>Dados</h3>
            <div class="grid">
              <div class="field"><label>Nome</label><input id="pNome"/></div>
              <div class="field"><label>E-mail</label><input id="pEmail" type="email"/></div>
              <div class="field">
                <label>Cargo</label>
                <select id="pCargo"><option>Usuário</option><option>Supervisor</option><option>Administrador</option></select>
              </div>
              <button class="btn" id="salvarPerfil">Salvar</button>
            </div>
          </div>
          <div class="card">
            <h3>Histórico</h3>
            <ul id="historico"></ul>
          </div>
          <div class="card">
            <h3>Nível de acesso</h3>
            <p>Atual: <span class="badge" id="nivelAtual">Usuário</span></p>
            <p class="muted">Recursos avançados ficam indisponíveis se você não for supervisor/administrador.</p>
          </div>
        </div>
      </div>

      <!-- CONFIGURAÇÕES -->
      <div id="view-settings" class="card hidden" aria-labelledby="h-settings">
        <h2 id="h-settings">Configurações da Conta</h2>
        <div class="grid cols-3">
          <div class="card">
            <h3>Segurança</h3>
            <div class="grid">
              <div class="field"><label>Trocar e-mail</label><input id="sEmail" type="email" placeholder="novo@exemplo.com"/></div>
              <div class="field"><label>Trocar senha</label><input id="sSenha" type="password" placeholder="Nova senha"/></div>
              <label class="row"><input id="s2fa" type="checkbox"/> Ativar 2FA</label>
              <button class="btn" id="aplicarSeg">Aplicar</button>
            </div>
          </div>
          <div class="card">
            <h3>Notificações</h3>
            <label class="row"><input class="notif" data-k="manutencao" type="checkbox" checked/> Manutenção</label>
            <label class="row"><input class="notif" data-k="falha" type="checkbox"/> Alertas de falha</label>
            <label class="row"><input class="notif" data-k="emprestimo" type="checkbox" checked/> Empréstimos</label>
          </div>
          <div class="card">
            <h3>Preferências</h3>
            <label class="row"><input id="prefCompacto" type="checkbox"/> Layout compacto</label>
            <label class="row"><input id="prefLangSync" type="checkbox" checked/> Sincronizar idioma do topo</label>
          </div>
        </div>
      </div>

      <!-- RASTREIO -->
      <div id="view-tracking" class="card hidden" aria-labelledby="h-tracking">
        <h2 id="h-tracking">Página de Rastreio</h2>
        <div class="grid cols-2">
          <div class="card">
            <h3>Localização atual</h3>
            <div style="height:240px; border-radius:14px; background: linear-gradient(180deg,#0c1536,#060d26); display:grid; place-items:center">
              <div class="muted">🗺️ Mapa ilustrativo (placeholder)</div>
            </div>
            <p class="muted">Ferramenta <strong id="trkFerr"></strong> – última leitura via QR em <span id="trkTime"></span>.</p>
          </div>
          <div class="card">
            <h3>Trajeto recente</h3>
            <ol id="trajeto"></ol>
          </div>
        </div>
      </div>

      <!-- AGENDA DE MANUTENÇÃO -->
      <div id="view-maintenance" class="card hidden" aria-labelledby="h-maintenance">
        <h2 id="h-maintenance">Agenda Compartilhada de Manutenção</h2>
        <div class="calendar card">
          <div class="grid-7" id="dow"></div>
          <div class="grid-7" id="days"></div>
        </div>
        <div class="card">
          <h3>Tarefas</h3>
          <ul id="tarefas"></ul>
        </div>
      </div>

    </section>
  </div>

  <!-- MODALS -->
  <div class="modal" id="modal2FA" role="dialog" aria-modal="true" aria-labelledby="m2fatitle">
    <div class="box">
      <h3 id="m2fatitle">Confirmação 2FA</h3>
      <p class="muted">Enviamos um código de 6 dígitos por <span id="m2faMethod">e-mail</span>.</p>
      <div class="row"><input id="code2fa" placeholder="000000" inputmode="numeric" maxlength="6" aria-label="Código 2FA" /><button class="btn" id="confirm2fa">Confirmar</button></div>
    </div>
  </div>

  <div class="modal" id="modalForgot" role="dialog" aria-modal="true" aria-labelledby="mForgot">
    <div class="box">
      <h3 id="mForgot">Recuperação de Senha</h3>
      <p class="muted">Informe seu e-mail para enviarmos o link de redefinição.</p>
      <div class="row"><input id="resetMail" type="email" placeholder="voce@exemplo.com" /><button class="btn" id="sendReset">Enviar</button></div>
    </div>
  </div>

  <!-- TOAST -->
  <div class="toast" id="toast" role="status" aria-live="polite"></div>

  <!-- COOKIE BANNER -->
  <div id="cookie" class="cookie" role="dialog" aria-label="Banner de cookies">
    <div class="row">
      <div>
        <strong>Cookies & Privacidade</strong>
        <div class="muted">Usamos cookies para sessão e preferências. Gerencie abaixo.</div>
      </div>
      <div class="right row">
        <button class="btn-ghost" id="cookiePrefs">Preferências</button>
        <button class="btn" id="cookieAccept">Aceitar</button>
      </div>
    </div>
    <div id="cookiePanel" class="hidden" style="margin-top:10px">
      <label class="row"><input id="cNecessary" type="checkbox" checked disabled/> Necessários</label>
      <label class="row"><input id="cAnalytics" type="checkbox"/> Analytics</label>
      <label class="row"><input id="cMarketing" type="checkbox"/> Marketing</label>
    </div>
  </div>

  <script>
    // ====================== Dados simulados =======================
    const ferramentas = [
      { id: 'QR-1001', nome: 'Paquímetro 150mm', categoria: 'Medição', local: 'Armário A', status: 'Disponível', prox: '2025-10-02', pend: false },
      { id: 'QR-2002', nome: 'Furadeira 750W', categoria: 'Elétrica', local: 'Oficina 1', status: 'Emprestada', prox: '2025-09-18', pend: true },
      { id: 'QR-3003', nome: 'Chave de Impacto', categoria: 'Mecânica', local: 'Armário B', status: 'Disponível', prox: '2025-11-05', pend: false },
      { id: 'QR-4004', nome: 'Multímetro Digital', categoria: 'Medição', local: 'Oficina 1', status: 'Em manutenção', prox: '2025-09-20', pend: true },
    ];

    let usuario = { nome: 'Convidado', email: 'guest@example.com', cargo: 'Usuário', lang: 'pt', twofa: false };
    let sessãoAtiva = false;
    let sessionTimer;

    const i18n = {
      pt: {
        subtitle: 'Estoque & Rastreamento', login: 'Entrar', menu_login:'Login & Cadastro', menu_about:'Sobre Nós', menu_privacy:'Política de Privacidade', menu_help:'Ajuda / Suporte', menu_search:'Pesquisa', menu_profile:'Perfil do Usuário', menu_settings:'Configurações', menu_tracking:'Rastreio', menu_maintenance:'Agenda de Manutenção', login_title:'Tela Inicial – Login e Cadastro', login_desc:'Acesse com e-mail/senha, redes sociais ou ative 2FA.'
      },
      en: {
        subtitle: 'Inventory & Tracking', login: 'Sign in', menu_login:'Login & Signup', menu_about:'About Us', menu_privacy:'Privacy Policy', menu_help:'Help / Support', menu_search:'Search', menu_profile:'User Profile', menu_settings:'Settings', menu_tracking:'Tracking', menu_maintenance:'Maintenance Calendar', login_title:'Welcome – Login & Sign up', login_desc:'Sign in via email/password, social, or enable 2FA.'
      }
    };

    // ====================== Utilitários =======================
    const $ = (q) => document.querySelector(q);
    const $$ = (q) => document.querySelectorAll(q);
    function toast(msg, type='info'){ const t=$('#toast'); t.textContent=msg; t.classList.add('show'); setTimeout(()=>t.classList.remove('show'), 2600); }
    function routeTo(name){
      $$('[id^="view-"]').forEach(el=>el.classList.add('hidden'));
      $(`#view-${name}`).classList.remove('hidden');
      $$('[data-route]').forEach(a=>a.setAttribute('aria-current', a.dataset.route===name?'page':'false'));
      history.replaceState({}, '', `#${name}`);
    }

    function applyLang(lang){
      usuario.lang = lang; $('#lang').value = lang;
      const dict = i18n[lang];
      if(!dict) return;
      $$('[data-i18n]').forEach(el=>{ const k = el.getAttribute('data-i18n'); el.textContent = dict[k] || el.textContent; });
    }

    function applyRole(){
      $('#nivelAtual').textContent = usuario.cargo;
      const isAdmin = usuario.cargo==='Administrador' || usuario.cargo==='Supervisor';
      $('#startQR').disabled = !isAdmin;
      $('#stopQR').disabled = !isAdmin;
    }

    // ====================== Login / 2FA =======================
    $('#formLogin').addEventListener('submit', (e)=>{
      e.preventDefault();
      const wants2FA = $('#twofa').checked; const method = $('#twofaMethod').value;
      if(wants2FA){ $('#m2faMethod').textContent = method==='sms'?'SMS':'e-mail'; $('#modal2FA').classList.add('open'); $('#code2fa').focus(); }
      else { completeLogin(); }
    });
    $('#confirm2fa').onclick = ()=>{ const ok = /^\d{6}$/.test($('#code2fa').value); if(ok){ $('#modal2FA').classList.remove('open'); completeLogin(); } else toast('Código 2FA inválido', 'warn'); };
    $('#forgot').onclick = ()=> $('#modalForgot').classList.add('open');
    $('#sendReset').onclick = ()=>{ toast('Enviamos um link de redefinição para o e-mail informado.'); $('#modalForgot').classList.remove('open'); };

    function completeLogin(){
      sessãoAtiva = true; usuario.nome = $('#email').value.split('@')[0] || 'Usuário'; usuario.email = $('#email').value; usuario.twofa = $('#twofa').checked; startSessionTimer(); toast(`Bem-vindo, ${usuario.nome}!`); routeTo('search'); $('#openLogin').textContent = 'Sair';
    }

    $('#openLogin').onclick = ()=>{
      if(sessãoAtiva){ sessãoAtiva=false; toast('Sessão encerrada.'); routeTo('login'); $('#openLogin').textContent = i18n[usuario.lang].login; clearTimeout(sessionTimer); }
      else routeTo('login');
    };

    function startSessionTimer(){ clearTimeout(sessionTimer); sessionTimer = setTimeout(()=>{ sessãoAtiva=false; toast('Sessão expirada por inatividade.'); routeTo('login'); $('#openLogin').textContent = i18n[usuario.lang].login; }, 1000*60*5); /* 5 min */ }
    ['click','keydown','mousemove'].forEach(ev=>document.addEventListener(ev, ()=>sessãoAtiva&&startSessionTimer()));

    // ====================== Cookie banner =======================
    const cookieAccepted = localStorage.getItem('cookieAccepted');
    if(!cookieAccepted) { $('#cookie').style.display = 'block'; }
    $('#cookiePrefs').onclick = ()=> $('#cookiePanel').classList.toggle('hidden');
    $('#cookieAccept').onclick = ()=>{ localStorage.setItem('cookieAccepted','1'); $('#cookie').style.display='none'; toast('Preferências salvas.'); };
    $('#openCookiePanel').onclick = ()=>{ $('#cookie').style.display='block'; };

    // ====================== Tema & Acessibilidade =======================
    $('#toggleTheme').onclick = ()=> document.body.classList.toggle('light');
    $('#toggleContrast').onclick = (e)=>{ document.body.classList.toggle('high-contrast'); const on = document.body.classList.contains('high-contrast'); e.currentTarget.setAttribute('aria-pressed', on); };

    $('#lang').onchange = (e)=> applyLang(e.target.value);

    // Atalho de teclado para busca
    document.addEventListener('keydown', (e)=>{ if(e.key === '/') { e.preventDefault(); $('#globalSearch').focus(); } });

    // ====================== Pesquisa & Filtros =======================
    const tbody = $('#toolRows');
    function renderRows(){
      const cat = $('#fCategoria').value; const loc = $('#fLocal').value; const sts = $('#fStatus').value; const pen = $('#fPendencia').value; const q = ($('#searchInput').value || '').toLowerCase();
      const filtradas = ferramentas.filter(f=>
        (cat==='Todos'||f.categoria===cat) &&
        (loc==='Todos'||f.local===loc) &&
        (sts==='Todos'||f.status===sts) &&
        (pen==='Todos'|| (pen==='Sim'?f.pend:true&&!f.pend)) &&
        (f.nome.toLowerCase().includes(q) || f.id.toLowerCase().includes(q))
      );
      tbody.innerHTML = '';
      filtradas.forEach(f=>{
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${f.nome}<div class="muted" style="font-size:12px">${f.id}</div></td>
                        <td>${f.categoria}</td>
                        <td>${f.local}</td>
                        <td>${badgeStatus(f.status)}</td>
                        <td>${f.prox}</td>
                        <td class="row">
                          <button class="btn-ghost" data-act="checkout" data-id="${f.id}">Check-out</button>
                          <button class="btn" data-act="checkin" data-id="${f.id}">Devolver</button>
                        </td>`;
        tbody.appendChild(tr);
      });
      $('#resultCount').textContent = filtradas.length;
    }
    function badgeStatus(s){
      const cls = s==='Disponível'?'ok':(s==='Emprestada'?'warn':'danger');
      return `<span class="badge ${cls}">${s}</span>`;
    }
    ['change','input'].forEach(ev=>{
      ['#fCategoria','#fLocal','#fStatus','#fPendencia','#searchInput','#globalSearch'].forEach(sel=>$(sel).addEventListener(ev, renderRows));
    });

    tbody.addEventListener('click', (e)=>{
      const btn = e.target.closest('button'); if(!btn) return;
      const id = btn.dataset.id; const act = btn.dataset.act;
      if(act==='checkout'){ toast(`Ferramenta ${id} emprestada.`); addHistorico(`Check-out ${id}`); addTrajeto(`Retirada ${id} — Oficina 1`); }
      if(act==='checkin'){ toast(`Ferramenta ${id} devolvida.`); addHistorico(`Check-in ${id}`); addTrajeto(`Devolução ${id} — Armário A`); }
    });

    $('#saveObs').onclick = ()=>{ const t=$('#obs').value.trim(); if(!t) return toast('Nada para salvar'); addHistorico('Obs: '+t); $('#obs').value=''; toast('Observação registrada.'); };

    // ====================== QR (mock) =======================
    let stream;
    $('#startQR').onclick = async()=>{
      try{ stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } }); $('#qrVideo').srcObject = stream; $('#qrVideo').play(); toast('Câmera iniciada (demo)'); }
      catch(e){ toast('Permissão negada ou indisponível.'); }
    };
    $('#stopQR').onclick = ()=>{ if(stream){ stream.getTracks().forEach(t=>t.stop()); $('#qrVideo').srcObject = null; toast('Câmera parada.'); } };

    // ====================== Perfil & Históricos =======================
    function addHistorico(txt){ const li=document.createElement('li'); li.textContent = new Date().toLocaleString() + ' — ' + txt; $('#historico').prepend(li); }

    // ====================== Rastreio =======================
    function addTrajeto(txt){ const li=document.createElement('li'); li.textContent = new Date().toLocaleString() + ' — ' + txt; $('#trajeto').prepend(li); $('#trkFerr').textContent = (txt.match(/QR-\d+/)||[''])[0]; $('#trkTime').textContent = new Date().toLocaleString(); }

    // ====================== Agenda (calendário simples) =======================
    const dow = ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'];
    const tarefas = [
      { data: '2025-09-12', titulo: 'Multímetro — calibração' },
      { data: '2025-09-18', titulo: 'Furadeira — troca escovas' },
      { data: '2025-10-02', titulo: 'Paquímetro — inspeção' },
    ];
    function renderCalendar(){
      // Cabeçalho dias
      $('#dow').innerHTML = dow.map(d=>`<div class="dow">${d}</div>`).join('');
      const now = new Date(); const y = now.getFullYear(); const m = now.getMonth();
      const first = new Date(y,m,1); const last = new Date(y,m+1,0);
      const start = first.getDay(); const total = last.getDate();
      const cells = [];
      for(let i=0;i<start;i++) cells.push('<div></div>');
      for(let d=1; d<=total; d++){
        const dateStr = `${y}-${String(m+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
        const its = tarefas.filter(t=>t.data===dateStr);
        cells.push(`<div class="day"><div><strong>${d}</strong></div>${its.map(()=>'<span class="dot" title="Manutenção"></span>').join(' ')}</div>`);
      }
      $('#days').innerHTML = cells.join('');
      $('#tarefas').innerHTML = tarefas.map(t=>`<li><span class="badge warn">${t.data}</span> — ${t.titulo}</li>`).join('');
    }

    // ====================== Navegação SPA =======================
    $$('a[data-route]').forEach(a=> a.addEventListener('click', (e)=>{ e.preventDefault(); routeTo(a.dataset.route); }));
    window.addEventListener('hashchange', ()=>{ const r = location.hash.replace('#','')||'login'; routeTo(r); });

    // ====================== Notificações =======================
    $('#notifyBtn').onclick = ()=> toast('🔔 Ferramenta QR-2002 com manutenção pendente em 09/18.');

    // ====================== Gerenciar ferramentas no localStorage ===
    const storageKey = 'ferramentasStorage';

    function loadTools() {
      const saved = localStorage.getItem(storageKey);
      if(saved) return JSON.parse(saved);
      return ferramentas; // array inicial
    }

    function saveTools(arr) {
      localStorage.setItem(storageKey, JSON.stringify(arr));
    }

    let tools = loadTools();

    const toolForm = $('#toolForm');
    const toolManagerRows = $('#toolManagerRows');
    const saveToolBtn = $('#saveToolBtn');
    const cancelEditBtn = $('#cancelEdit');

    let editIndex = -1;

    function renderToolManager() {
      toolManagerRows.innerHTML = '';
      tools.forEach((t, i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${t.id}</td>
                        <td>${t.nome}</td>
                        <td>${t.categoria}</td>
                        <td>${t.local}</td>
                        <td>${t.status}</td>
                        <td>${t.prox}</td>
                        <td>${t.pend ? "Sim" : "Não"}</td>
                        <td class="row" style="gap:6px;">
                          <button class="btn-ghost" data-act="edit" data-index="${i}">Editar</button>
                          <button class="btn-danger" data-act="remove" data-index="${i}">Remover</button>
                        </td>`;
        toolManagerRows.appendChild(tr);
      });
    }

    function fillForm(tool) {
      $('#toolId').value = tool.id;
      $('#toolName').value = tool.nome;
      $('#toolCategory').value = tool.categoria;
      $('#toolLocation').value = tool.local;
      $('#toolStatus').value = tool.status;
      $('#toolNextMaint').value = tool.prox;
      $('#toolPendencia').value = tool.pend.toString();
    }

    function clearForm() {
      toolForm.reset();
      $('#toolCategory').value = '';
      $('#toolLocation').value = '';
      $('#toolStatus').value = '';
      $('#toolPendencia').value = '';
      editIndex = -1;
      saveToolBtn.textContent = 'Adicionar';
    }

    cancelEditBtn.onclick = () => {
      clearForm();
    };

    toolForm.onsubmit = (e) => {
      e.preventDefault();

      const newTool = {
        id: $('#toolId').value.trim(),
        nome: $('#toolName').value.trim(),
        categoria: $('#toolCategory').value,
        local: $('#toolLocation').value,
        status: $('#toolStatus').value,
        prox: $('#toolNextMaint').value,
        pend: $('#toolPendencia').value === 'true'
      };

      if(editIndex >= 0) {
        tools[editIndex] = newTool;
        toast(`Ferramenta ${newTool.id} atualizada.`);
      } else {
        if(tools.some(t => t.id === newTool.id)){
          toast('Código QR já cadastrado.', 'warn');
          return;
        }
        tools.push(newTool);
        toast(`Ferramenta ${newTool.id} adicionada.`);
      }

      saveTools(tools);
      renderToolManager();
      renderRows(); // Atualiza tabela de pesquisa existente
      clearForm();
    };

    toolManagerRows.onclick = (e) => {
      const btn = e.target.closest('button');
      if(!btn) return;
      const idx = Number(btn.dataset.index);
      if(btn.dataset.act === 'edit'){
        editIndex = idx;
        fillForm(tools[idx]);
        saveToolBtn.textContent = 'Salvar';
        routeTo('tool-manager');
      } else if(btn.dataset.act === 'remove'){
        if(confirm(`Remover ferramenta ${tools[idx].id}?`)) {
          toast(`Ferramenta ${tools[idx].id} removida.`);
          tools.splice(idx, 1);
          saveTools(tools);
          renderToolManager();
          renderRows();
          if(editIndex === idx) clearForm();
        }
      }
    };

    // ====================== Inicialização =======================
    const originalInit = init;
    init = function(){
      originalInit();
      renderToolManager();
    };
    init();
  </script>
</body>
</html>
