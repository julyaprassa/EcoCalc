<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- utilização do w3.css e css -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <!-- fonte das letras -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>EcoCalc</title>

</head>
<body>

<!-- menu com ecocalc, cadastro e login -->
    <div class="topo w3-bar">
    <span class="w3-bar-item w3-xlarge">EcoCalc</span>
    <a href="login.php" class="w3-bar-item w3-button w3-right">Entrar</a>
    <a href="cadastro.php" class="w3-bar-item w3-button w3-right">Cadastro</a>
</div>

<!-- apresentação do site -->
    <div class="w3-container w3-padding-64">

<!-- formato em card -->
    <div class="w3-content card" style="max-width:800px">

        <h1 class="titulo">Calcule sua Pegada de Carbono</h1>
        <p> O EcoCalc calcula sua pegada de carbono com base no seu transporte e consumo de energia, mostrando seu impacto ambiental e sugestões para reduzir a poluição.</p>
        <br>
        <a href="verifica_login.php" class="botao" style= "text-decoration: none;"> Calcular </a>

    </div>

</div>

<!-- elementos do site -->
    <div class="w3-container w3-content w3-padding-32" style="max-width:1000px">

    <div class="w3-row-padding">

        <div class="w3-third">
            <div class="card">
                <h3 class="titulo">Responda</h3>
                <p>Preencha o questionário sobre transporte e energia.</p>
            </div>
        </div>

        <div class="w3-third">
            <div class="card">
                <h3 class="titulo">Calculamos</h3>
                <p>Calculamos sua emissão de CO₂.</p>
            </div>
        </div>

        <div class="w3-third">
            <div class="card">
                <h3 class="titulo">Resultado</h3>
                <p>Veja gráficos e dicas para reduzir sua pegada.</p>
            </div>
        </div>

    </div>

</div>

</body>
</html>