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
        const menuState = localStorage.getItem('sidebarOpen');
        
        if (menuState === 'true') {
            sidebar.classList.add('open');
            layout.classList.add('menu-open');
        }

        toggleMenu.onclick = () => {
            sidebar.classList.toggle('open');
            if(layout) layout.classList.toggle('menu-open');
            const isOpen = sidebar.classList.contains('open');
            localStorage.setItem('sidebarOpen', isOpen);
            document.cookie = "sidebarStatus=" + (isOpen ? "active" : "inactive") + ";path=/";
        };
    }

    // ==========================================
    // 2. PAINEL DE NOTIFICAÇÕES (Sino) - NOVO!
    // ==========================================
    const notifyBtn = document.getElementById('notifyBtn');
    const notificationPanel = document.getElementById('notificationPanel');

    if (notifyBtn && notificationPanel) {
        notifyBtn.onclick = (e) => {
            e.stopPropagation();
            const isVisible = notificationPanel.style.display === 'block';
            notificationPanel.style.display = isVisible ? 'none' : 'block';
        };

        document.addEventListener('click', () => {
            notificationPanel.style.display = 'none';
        });

        notificationPanel.onclick = (e) => e.stopPropagation();
    }

    // ==========================================
    // 3. TEMAS (Claro / Escuro / Contraste)
    // ==========================================
    const btnTheme = $('#toggleTheme');
    const btnContrast = $('#toggleContrast');
   
    if (localStorage.getItem('theme') === 'light') document.body.classList.add('light');
    if (localStorage.getItem('contrast') === 'true') document.body.classList.add('high-contrast');

    if (btnTheme) {
        btnTheme.onclick = () => {
            const isLight = document.body.classList.toggle('light');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        };
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
                <td><button class="btn-ghost" onclick="window.toast('Detalhes de ${f.id}', 'info')">⚙️</button></td>
            </tr>
        `).join('');
    }

    document.addEventListener('input', (e) => {
        if (['searchInput', 'fCategoria', 'fStatus'].includes(e.target.id)) filtrarFerramentas();
    });

    if ($('#toolRows')) filtrarFerramentas();

    // ==========================================
    // 5. SISTEMA DE TOASTS
    // ==========================================
    window.toast = (msg, tipo = 'info') => {
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        toast.className = `custom-toast ${tipo}`;
        
        const ícones = { success: '✅', error: '⚠️', warn: '🔔', info: 'ℹ️' };
        const icone = ícones[tipo] || ícones.info;

        toast.innerHTML = `
            <span style="font-size: 1.2rem;">${icone}</span>
            <span style="font-size: 0.9rem; font-weight: 500;">${msg}</span>
        `;

        container.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-10px)';
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    };

    // ==========================================
    // 6. BUSCA DE CEP AUTOMÁTICA
    // ==========================================
    const inputCep = document.getElementById('cep');
    if (inputCep) {
        inputCep.addEventListener('blur', function() {
            let cep = this.value.replace(/\D/g, '');
            if (cep.length === 8) {
                window.toast("Buscando endereço...", "info");
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(res => res.json())
                    .then(dados => {
                        if (!("erro" in dados)) {
                            document.getElementById('logradouro').value = dados.logradouro;
                            document.getElementById('bairro').value = dados.bairro;
                            document.getElementById('cidade').value = dados.localidade;
                            document.getElementById('uf').value = dados.uf;
                            window.toast("Endereço preenchido!", "success");
                        } else {
                            window.toast("CEP não encontrado.", "error");
                        }
                    });
            }
        });
    }
});

// Fora do DOMContentLoaded
function buscarRastreio() {
    const idItem = document.getElementById('os-number')?.value;
    if(!idItem) return window.toast("Digite o ID do item", "warn");

    fetch(`buscar_rastreio.php?id_item=${idItem}`)
        .then(response => response.json())
        .then(data => {
            if(data.error) {
                window.toast(data.error, "error");
            } else {
                window.toast("Informações carregadas!", "success");
                document.getElementById('resultado-rastreio').style.display = 'block';
                document.getElementById('nome-equipamento').innerText = data.equipamento;
                document.getElementById('status-atual').innerText = data.status;
                document.getElementById('local-atual').innerText = "Localização: " + data.nome_local;
            }
        })
        .catch(() => window.toast("Erro ao buscar dados", "error"));
}

// ==========================================
// MODO LEITURA
// ==========================================
const btnReading = document.getElementById('toggleReading');

// Verifica se já estava ligado antes de recarregar a página
if (localStorage.getItem('readingMode') === 'true') {
    document.body.classList.add('reading-mode');
}

if (btnReading) {
    btnReading.onclick = () => {
        const isReading = document.body.classList.toggle('reading-mode');
        localStorage.setItem('readingMode', isReading);
        
        // Opcional: Mostra um aviso na tela
        if(window.toast) {
            window.toast(isReading ? "Modo Leitura Ativado" : "Modo Leitura Desativado", "info");
        }
    };
}

// 1. COLOCA ISTO LOGO NO TOPO DO FICHEIRO (FORA DE TUDO)
window.toast = (msg, tipo = 'info') => {
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        document.body.appendChild(container);
    }
    const toast = document.createElement('div');
    toast.className = `custom-toast ${tipo}`;
    const icones = { success: '✅', error: '⚠️', warn: '🔔', info: 'ℹ️' };
    toast.innerHTML = `<span>${icones[tipo] || 'ℹ️'}</span><span>${msg}</span>`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
    }, 4000);
};

// 2. DENTRO DO TEU document.addEventListener('DOMContentLoaded', () => { ... })
// Atualiza os teus botões para chamarem a função:

btnTheme.onclick = () => {
    const isLight = document.body.classList.toggle('light');
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
    window.toast(isLight ? "Tema Claro Ativado" : "Tema Escuro Ativado");
};

btnContrast.onclick = () => {
    const isHigh = document.body.classList.toggle('high-contrast');
    localStorage.setItem('contrast', isHigh);
    window.toast(isHigh ? "Alto Contraste Ativado" : "Alto Contraste Desativado", "warn");
};

btnReading.onclick = () => {
    const isReading = document.body.classList.toggle('reading-mode');
    localStorage.setItem('readingMode', isReading);
    window.toast(isReading ? "Modo Leitura Ativado" : "Modo Leitura Desativado");
};
