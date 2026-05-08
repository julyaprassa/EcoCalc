<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Calcular Pegada de Carbono</title>
</head>
<body>
    
    <div class="topo w3-bar">
        <span class="w3-bar-item w3-xlarge">EcoCalc</span>
        <a href="paginainicial.php" class="w3-bar-item w3-button w3-right">Sair</a>
    </div>

    <div class="w3-container w3-padding-64">
        <div class="w3-content" style="max-width:700px">
            
            <div class="progresso">
                <div class="barra"></div>
            </div>

            <div class="card">
                <h2 class="titulo">Transporte</h2>
                <p class="recado">Responda sobre seus hábitos de transporte.</p>
            </div>
            
            <div class="perguntas">
                <form action="energia.php" method="post" class="questionario-form">
                    
                    <label>Qual transporte você mais utiliza?</label>
                    <select name="transporte" id="transporte" class="questionario-select" required onchange="verificarTransporte()">
                        <option value=""> </option>
                        <option value="Carro">Carro</option>
                        <option value="Moto">Moto</option>
                        <option value="Ônibus">Ônibus</option>
                        <option value="Bicicleta">Bicicleta</option>
                        <option value="A pé">A pé</option>
                    </select>

                    <label>Quantos km percorre por dia?</label>
                    <input type="number" name="km_dia" min="1" placeholder="Ex: 15" class="questionario-input" required>

                    <label>Quantos dias por semana?</label>
                    <select name="dias_semana" class="questionario-select" required>
                        <option value=""> </option>
                        <?php for($i=1; $i<=7; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>

                    <div id="campo-combustivel">
                        <label>Qual o combustível utilizado?</label>
                        <select name="combustivel" id="combustivel" class="questionario-select" required>
                            <option value=""> </option>
                            <option value="Gasolina">Gasolina</option>
                            <option value="Etanol">Etanol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Elétrico">Elétrico</option>
                        </select>
                    </div>

                    <br>
                    <button type="submit" class="botaocampo" style="text-decoration: none;">
                        Próximo →
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function verificarTransporte() {
        var transporte = document.getElementById("transporte").value;
        var campoCombustivel = document.getElementById("campo-combustivel");
        var selectCombustivel = document.getElementById("combustivel");

        // Lógica pedida pelo G. Ribeiro: Se for bike ou a pé, esconde o combustível
        if (transporte === "Bicicleta" || transporte === "A pé") {
            campoCombustivel.style.display = "none";
            selectCombustivel.required = false; // Não obriga a preencher se estiver escondido
            selectCombustivel.value = "Nenhum";
        } else {
            campoCombustivel.style.display = "block";
            selectCombustivel.required = true;
        }
    }
    </script>

</body>
</html>