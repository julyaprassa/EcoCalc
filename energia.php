<?php
session_start();
// Recebe os dados do transporte da página anterior para levar até o resultado
$_SESSION['dados_transporte'] = $_POST;
?>
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
    <title>Calcular Pegada de Carbono - Energia</title>
</head>
<body>
    
    <div class="topo w3-bar">
        <span class="w3-bar-item w3-xlarge">EcoCalc</span>
        <a href="paginainicial.php" class="w3-bar-item w3-button w3-right">Sair</a>
    </div>

    <div class="w3-container w3-padding-64">
        <div class="w3-content" style="max-width:700px">
            
            <div class="progresso">
                <div class="barra" style="width: 100%;"></div> </div>

            <div class="card">
                <h2 class="titulo">Energia</h2>
                <p class="recado">Responda sobre seus hábitos de energia.</p>
            </div>
            
            <div class="perguntas">
                <form action="resultado.php" method="post" class="questionario-form">

                    <label>Quantas pessoas moram em sua residência?</label>
                    <input type="number" name="pessoas_residencia" min="1" placeholder="Ex: 3" class="questionario-input" required>

                    <label>Qual o valor médio da conta de energia (R$)?</label>
                    <input type="number" name="valor_conta" min="1" placeholder="Ex: 150" class="questionario-input" required>

                    <label>Utiliza lâmpadas LED?</label>
                    <select name="usa_led" class="questionario-select" required>
                        <option value=""> </option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>

                    <label>Faz uso de energia renovável (placas solares)?</label>
                    <select name="usa_renovavel" class="questionario-select" required>
                        <option value=""> </option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>

                    <br>
                    <button type="submit" class="botaocampo">
                        Calcular Resultado →
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>