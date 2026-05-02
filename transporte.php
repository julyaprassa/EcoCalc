<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <!-- fonte das letras -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Calcular Pegada de Carbono</title>
</head>
<body>
    
    <div class="topo w3-bar">
    <span class="w3-bar-item w3-xlarge">EcoCalc</span>
    <a href="paginainicial.php" class="w3-bar-item w3-button w3-right">Sair</a>
    </div>
    <div class="w3-container w3-padding-64">
    <div class="w3-content" style="max-width:700px">
    

    <!-- barra -->
    <div class="progresso">
    <div class="barra"></div>
    </div>

    <div class="card">
      <h2 class="titulo">Transporte</h2>
      <p class="recado">
        Responda sobre seus hábitos de transporte.
      </p>
    </div>
    
<div class="perguntas">
    <form action="energia.php" method="post" class="questionario-form">
<!-- Perguntas de opção -->
    <label>Qual transporte você mais utiliza?</label>
    <select class="questionario-select" required>
    <option value=""> </option>
    <option>Carro</option>
    <option>Moto</option>
    <option>Ônibus</option>
    <option>Bicicleta</option>
    <option>A pé</option>
    </select>

<!-- Pergunta sobre km -->
    <label>Quantos km percorre por dia?</label>
    <input type="number" min="1" placeholder="Ex: 15" class="questionario-input" required>

<!-- Selecionar quantos dias da semana -->
    <label>Quantos dias por semana?</label>
    <select class="questionario-select" required>
    <option value="">Selecione</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    </select>

    <label>Qual o combustível utilizado?</label>
    <select class="questionario-select" required>
    <option value="">Selecione</option>
    <option>Gasolina</option>
    <option>Etanol</option>
    <option>Diesel</option>
    <option>Elétrico</option>
    </select>

<br>
    <button type="submit" class="botao" style= "text-decoration: none;">
    Próximo →
    </button>
    

</form>
</div>
    </div>
    </div>
    </div>
</body>
</html>