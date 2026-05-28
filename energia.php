<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['dados_energia'] = [
        'pessoas_residencia' => $_POST['pessoas_residencia'] ?? 1,
        'valor_conta'        => $_POST['valor_conta'] ?? 0,
        'usa_led'            => $_POST['usa_led'] ?? 'Não',
        'usa_renovavel'      => $_POST['usa_renovavel'] ?? 'Não'
    ];
    header('Location: resultado.php');
    exit;
}
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Calcular Pegada de Carbono</title>
</head>
<body>
    <div class="topo w3-bar">
        <span class="w3-bar-item w3-xlarge">EcoCalc</span>
        <a href="index.php" class="w3-bar-item w3-button w3-right">Sair</a>
    </div>

    <div class="w3-container w3-padding-64">
        <div class="w3-content" style="max-width:700px">
            <div class="card">
                <h2 class="titulo">Energia</h2>
                <p class="recado">Responda sobre seus hábitos de energia.</p>
            </div>

            <form action="energia.php" method="post" class="questionario-form">
                <label>Quantas pessoas moram em sua residência?</label>
                <input type="number" name="pessoas_residencia" min="1" placeholder="Ex: 3" class="questionario-input" required>

                <label>Qual o valor médio da conta de energia?</label>
                <input type="number" name="valor_conta" min="1" placeholder="Ex: 150" class="questionario-input" required>

                <label>Utiliza lâmpadas LED?</label>
                <select name="usa_led" class="questionario-select" required>
                    <option value=""> </option>
                    <option>Sim</option>
                    <option>Não</option>
                </select>

                <label>Faz uso de energia renovável (placas solares)?</label>
                <select name="usa_renovavel" class="questionario-select" required>
                    <option value=""> </option>
                    <option>Sim</option>
                    <option>Não</option>
                </select>

                <button type="submit" class="botaocampo">Próximo →</button>
            </form>
        </div>
    </div>
</body>
</html>

