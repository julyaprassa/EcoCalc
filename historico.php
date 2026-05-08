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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <title>Histórico</title>
</head>

<body>

  <!-- topo -->
  <div class="topo w3-bar">
    <a href="paginainicial.php" class="w3-bar-item w3-xlarge" style="text-decoration:none;">
    EcoCalc
    </a>
    <label for="afmenu" class="w3-bar-item w3-button w3-right">
    <i class="fa fa-bars"></i>
    </label>
    <input type="checkbox" id="afmenu" hidden>

    <div class="overlay"></div>

  <!-- menu lateral -->
    <nav class="menu">
    <label for="afmenu" class="fechar">
    <i class="fa fa-bars"></i>
    </label>
    <a href="conta.php" class="w3-bar-item w3-button">Minha Conta</a>
    <a href="historico.php" class="w3-bar-item w3-button">Histórico</a>
    <a href="sobre.php" class="w3-bar-item w3-button">Sobre</a>
  </nav>
  </div>

  <div class="w3-container w3-padding-64">
    <div class="w3-content" style="max-width:1000px">
      <div class="card">
        <h2 class="titulo">Histórico de Emissões</h2>

        <p class="recado">
          Veja os cálculos realizados anteriormente.
        </p>

        <!-- lista -->
        <div class="historicolista">

          <!-- item -->
          <div class="historicoitem">

            <div>
              <h3>Março 2026</h3>
              <p>120 kg CO₂</p>
            </div>
            
            <a href="detalhes.php" class="botaohist">
            Ver detalhes
            </a>
          </div>

          <!-- item -->
          <div class="historicoitem">

            <div>
              <h3>Fevereiro 2026</h3>
              <p>95 kg CO₂</p>
            </div>

            <a href="detalhes.php" class="botaohist">
            Ver detalhes
            </a>

          </div>

          <!-- item -->
          <div class="historicoitem">

            <div>
              <h3>Janeiro 2026</h3>
              <p>140 kg CO₂</p>
            </div>

            <a href="detalhes.php" class="botaohist">
            Ver detalhes
            </a>
  </div>
  </div>
  </div>
  </div>
  </div>

</body>
</html>