<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <!-- fonte das letras -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <div class="topo w3-bar">
    <span class="w3-bar-item w3-xlarge">EcoCalc</span>
    <a href="paginainicial.php" class="w3-bar-item w3-button w3-right">Sair</a>
    </div>

  <div class="w3-container w3-padding-64">
    <div class="w3-content" style="max-width:700px">

      <!-- Card com dados do usuário -->
      <div class="card">
        <h2 class="titulo">Minha Conta</h2>
        <p class="recado">Meus dados:</p>

        <div class="dados-usuario">
          <p><strong>Nome:</strong> xx</p>
          <p><strong>Email:</strong> xx@email.com</p>
        </div>
      </div>

      <!-- Histórico de resultados -->
      <div class="card">
        <h3 class="titulo">Histórico de Pegada de Carbono</h3>
        <p class="recado">Veja seus cálculos anteriores:</p>
        <table class="w3-table w3-striped">
          <tr>
            <th>Data</th>
            <th>Total CO₂ (kg)</th>
            <th>Detalhes</th>
          </tr>
          <tr>
            <td>ex 01/04/2026</td>
            <td>ex 120</td>
            <td><a href="">Ver gráfico</a></td>
          </tr>
          <tr>
            <td>ex 15/03/2026</td>
            <td>ex 135</td>
            <td><a href="">Ver gráfico</a></td>
          </tr>
        </table>
      </div>

    </div>
  </div>
</body>
</html>