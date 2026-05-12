document.addEventListener('DOMContentLoaded', () => {
    // Atalho para selecionar elementos
    const $ = (q) => document.querySelector(q);

    // ==========================================
    // 1. MENU LATERAL (Sidebar) - Persistente
    // ==========================================
    const toggleMenu = document.getElementById('toggleMenu');
    const sidebar = $('aside.sidebar');
    const layout = $('.layout');

    if (toggleMenu && sidebar && layout) {
        // Recupera o estado salvo na memória
        const menuState = localStorage.getItem('sidebarOpen');
       
        if (menuState === 'true') {
            sidebar.classList.add('open');
            layout.classList.add('menu-open');
        }

        toggleMenu.onclick = () => {
            sidebar.classList.toggle('open');
            layout.classList.toggle('menu-open');

            // Salva o novo estado
            const isOpen = sidebar.classList.contains('open');
            localStorage.setItem('sidebarOpen', isOpen);
        };
    }

    // ==========================================
    // 2. MODO CLARO (body.light)
    // ==========================================
    const btnTheme = $('#toggleTheme');
   
    if (localStorage.getItem('theme') === 'light') {
        document.body.classList.add('light');
    }

    if (btnTheme) {
        btnTheme.onclick = () => {
            const isLight = document.body.classList.toggle('light');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        };
    }

    // ==========================================
    // 3. ALTO CONTRASTE (.high-contrast)
    // ==========================================
    const btnContrast = $('#toggleContrast');

    if (localStorage.getItem('contrast') === 'true') {
        document.body.classList.add('high-contrast');
    }

    if (btnContrast) {
        btnContrast.onclick = () => {
            const isHigh = document.body.classList.toggle('high-contrast');
            localStorage.setItem('contrast', isHigh);
        };
    }

    // ==========================================
    // 4. PESQUISA DE FERRAMENTAS
    // ==========================================
    const ferramentas = [
        { id: 'QR-1001', nome: 'Paquímetro Digital', cat: 'Medição', local: 'Armário A', status: 'Disponível' },
        { id: 'QR-1002', nome: 'Furadeira Bosch', cat: 'Elétrica', local: 'Oficina 1', status: 'Em manutenção' },
        { id: 'QR-1003', nome: 'Chave de Fenda Kit', cat: 'Mecânica', local: 'Armário B', status: 'Disponível' },
        { id: 'QR-1004', nome: 'Multímetro Minipa', cat: 'Medição', local: 'Bancada 2', status: 'Emprestada' },
    ];

    function filtrarFerramentas() {
        const termo = $('#searchInput')?.value.toLowerCase() || '';
        const cat = $('#fCategoria')?.value || 'Todos';
        const status = $('#fStatus')?.value || 'Todos';
        const tbody = $('#toolRows');
        const count = $('#resultCount');

        if (!tbody) return;

        const filtrados = ferramentas.filter(f => {
            const bateNome = f.nome.toLowerCase().includes(termo) || f.id.toLowerCase().includes(termo);
            const bateCat = cat === 'Todos' || f.cat === cat;
            const bateStatus = status === 'Todos' || f.status === status;
            return bateNome && bateCat && bateStatus;
        });

        tbody.innerHTML = filtrados.map(f => `
            <tr>
                <td><strong>${f.nome}</strong><br><small class="muted">${f.id}</small></td>
                <td>${f.cat}</td>
                <td>${f.local}</td>
                <td><span class="badge ${f.status === 'Disponível' ? 'ok' : f.status === 'Em manutenção' ? 'danger' : 'warn'}">${f.status}</span></td>
                <td><button class="btn-ghost" onclick="window.toast('Abrindo detalhes de ${f.id}')">⚙️</button></td>
            </tr>
        `).join('');

        if (count) count.textContent = filtrados.length;
    }

    // Ativa eventos de digitação
    document.addEventListener('input', (e) => {
        if (['searchInput', 'fCategoria', 'fStatus'].includes(e.target.id)) {
            filtrarFerramentas();
        }
    });

    // Inicializa se estiver na página de pesquisa
    if ($('#toolRows')) {
        filtrarFerramentas();
    }

    // ==========================================
    // 5. NOTIFICAÇÕES (Toast)
    // ==========================================
    window.toast = (msg) => {
        const t = $('#toast');
        if (t) {
            t.textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3000);
        }
    };
});
