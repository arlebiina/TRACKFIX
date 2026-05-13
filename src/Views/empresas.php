<?php include 'header.php'; ?>

<main class="layout">
    <div class="content empresa-section" style="padding: 20px; animation: fadeIn 0.8s ease-out;">
        <h2 style="color: #7da5fb; font-family: Verdana; margin-bottom: 25px;">🏢 Cadastrar Nova Unidade</h2>

        <div class="card" style="background: #1a1d29; border: 1px solid #2d3142; border-radius: 15px; padding: 30px;">
            <form action="index.php?rota=processar-empresa&acao=cadastrar_completo" method="POST">
                
                <h3 style="color: #fff; margin-bottom: 15px; border-bottom: 1px solid #2d3142; padding-bottom: 10px;">Dados da Empresa</h3>
                <div style="margin-bottom: 20px;">
                    <label class="muted">Razão Social / Nome da Unidade</label>
                    <input type="text" name="razao_social" class="input-dark" style="width: 100%; padding: 12px; background: #0f111a; border: 1px solid #2d3142; color: #fff; border-radius: 8px;" required placeholder="Ex: Oficina Central Matriz">
                </div>

                <h3 style="color: #fff; margin-bottom: 15px; border-bottom: 1px solid #2d3142; padding-bottom: 10px; margin-top: 30px;">Endereço</h3>
                <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 15px;">
                    <div>
                        <label class="muted">CEP</label>
                        <input type="text" name="cep" id="cep" class="input-dark" maxlength="9" style="width: 100%; padding: 12px; background: #0f111a; border: 1px solid #2d3142; color: #fff; border-radius: 8px;" required placeholder="00000-000">
                    </div>
                    <div>
                        <label class="muted">Logradouro (Rua/Av)</label>
                        <input type="text" name="logradouro" id="logradouro" class="input-dark" style="width: 100%; padding: 12px; background: #0f111a; border: 1px solid #2d3142; color: #fff; border-radius: 8px;" required>
                    </div>
                    <div>
                        <label class="muted">Número</label>
                        <input type="text" name="numero" class="input-dark" style="width: 100%; padding: 12px; background: #0f111a; border: 1px solid #2d3142; color: #fff; border-radius: 8px;" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-top: 15px;">
                    <div>
                        <label class="muted">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="input-dark" style="width: 100%; padding: 12px; background: #0f111a; border: 1px solid #2d3142; color: #fff; border-radius: 8px;" required>
                    </div>
                    <div>
                        <label class="muted">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="input-dark" style="width: 100%; padding: 12px; background: #0f111a; border: 1px solid #2d3142; color: #fff; border-radius: 8px;" required>
                    </div>
                    <div>
                        <label class="muted">Estado (UF)</label>
                        <input type="text" name="estado" id="uf" maxlength="2" class="input-dark" style="width: 100%; padding: 12px; background: #0f111a; border: 1px solid #2d3142; color: #fff; border-radius: 8px;" required>
                    </div>
                </div>

                <button type="submit" class="btn-glow" style="margin-top: 30px; width: 100%; padding: 15px; border: none; font-weight: bold; cursor: pointer; transition: 0.3s;">
                    Finalizar Cadastro e Vincular minha Conta
                </button>
            </form>
        </div>
    </div>
</main>

<script>
// Script para buscar CEP automaticamente (ViaCEP)
document.getElementById('cep').addEventListener('blur', function() {
    let cep = this.value.replace(/\D/g, '');
    if (cep !== "") {
        let validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {
            document.getElementById('logradouro').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('uf').value = "...";

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(res => res.json())
                .then(dados => {
                    if (!("erro" in dados)) {
                        document.getElementById('logradouro').value = dados.logradouro;
                        document.getElementById('bairro').value = dados.bairro;
                        document.getElementById('cidade').value = dados.localidade;
                        document.getElementById('uf').value = dados.uf;
                    } else {
                        alert("CEP não encontrado.");
                    }
                });
        }
    }
});
</script>

<?php include 'footer.php'; ?>
