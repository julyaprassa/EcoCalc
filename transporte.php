<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['dados_transporte'] = [
        'transporte'   => $_POST['transporte'] ?? '',
        'km_dia'       => $_POST['km_dia'] ?? 0,
        'dias_semana'  => $_POST['dias_semana'] ?? 0,
        'combustivel'  => $_POST['combustivel'] ?? ''
    ];
    header('Location: energia.php');
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
                <h2 class="titulo">Transporte</h2>
                <p class="recado">Responda sobre seus hábitos de transporte.</p>
            </div>

            <form action="transporte.php" method="post" class="questionario-form">
                <label>Qual transporte você mais utiliza?</label>
                <select name="transporte" class="questionario-select" required>
                    <option value=""> </option>
                    <option>Carro</option>
                    <option>Moto</option>
                    <option>Ônibus</option>
                    <option>Bicicleta</option>
                    <option>A pé</option>
                </select>

                <label>Quantos km percorre por dia?</label>
                <input type="number" name="km_dia" min="1" placeholder="Ex: 15" class="questionario-input" required>

                <label>Quantos dias por semana?</label>
                <select name="dias_semana" class="questionario-select" required>
                    <option value=""> </option>
                    <option>1</option><option>2</option><option>3</option>
                    <option>4</option><option>5</option><option>6</option><option>7</option>
                </select>

                <label>Qual o combustível utilizado?</label>
                <select name="combustivel" class="questionario-select" required>
                    <option value=""> </option>
                    <option>Gasolina</option>
                    <option>Etanol</option>
                    <option>Diesel</option>
                    <option>Elétrico</option>
                </select>

                <br>
                <button type="submit" class="botaocampo">Próximo →</button>
            </form>
        </div>
    </div>
</body>
</html>
