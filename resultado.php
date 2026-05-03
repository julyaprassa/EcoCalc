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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Resultados</title>
</head>
<body>

    <div class="topo w3-bar">
    <span class="w3-bar-item w3-xlarge">EcoCalc</span>
    <a href="conta.php" class="w3-bar-item w3-button w3-right">Minha Conta</a>
    </div>

  <div class="w3-container w3-padding-64">
    <div class="w3-content" style="max-width:700px">

      <div class="card">
        <h2 class="titulo">Resultados</h2>
        <p class="recado">
          Veja abaixo sua pegada de carbono mensal e dicas para reduzir.
        </p>
      </div>

      <!-- Total de emissões -->
      <div class="resultado">
        <h3>Total de emissões:</h3>
        <p><strong>120 kg CO₂</strong></p> <!-- valor fixo só para teste -->
      </div>

      <!-- Gráfico -->
      <canvas id="graficoEmissoes"></canvas>

      <!-- Recomendações -->
      <div class="recomendacoes">
        <h3>Recomendações:</h3>
        <ul>
          <li>Prefira transporte coletivo ou bicicleta para reduzir emissões.</li>
          <li>Troque lâmpadas comuns por LED.</li>
          <li>Considere energia solar para diminuir impacto da conta de luz.</li>
        </ul>
      </div>

    </div>
  </div>

  <script>
    const ctx = document.getElementById('graficoEmissoes').getContext('2d');
    const graficoEmissoes = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Transporte', 'Energia'],
        datasets: [{
          data: [80, 40], // valores fictícios só para teste
          backgroundColor: ['#2e7d32', '#66bb6a']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' }
        }
      }
    });
  </script>
  
</body>
</html>

