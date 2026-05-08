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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Detalhes</title>
</head>
<body>
  <div class="topo w3-bar">
    <a href="paginainicial.php" class="w3-bar-item w3-xlarge" style="text-decoration:none;">
    EcoCalc
    </a>

    <a href="historico.php" class="w3-bar-item w3-button w3-right">
      Voltar
    </a>
  </div>

  <div class="w3-container w3-padding-64">

    <div class="w3-content" style="max-width:1000px">

      <div class="card">

        <h2 class="titulo">
          Detalhes da Emissão
        </h2>

        <p class="recado">
          Resultado referente ao mês de Março 2026.
        </p>

        <!-- total emitido -->
        <div class="resultado">
          <h3>Total emitido:</h3>
          <p><strong>120 kg CO₂</strong></p>
        </div>

        <div class="detalhescontainer">

          <!-- gráfico -->
          <div class="grafico">
            <canvas id="graficoDetalhes"></canvas>
          </div>

          <!-- detalhes -->
          <div class="detalhesinfo">

            <div class="infoitem">
              <h4>Transporte</h4>
              <p>80 kg CO₂</p>
            </div>

            <div class="infoitem">
              <h4>Energia</h4>
              <p>40 kg CO₂</p>
            </div>

            <div class="infoitem">
              <h4>Maior impacto</h4>
              <p>Uso frequente de transporte individual.</p>
            </div>

          </div>

        </div>

        <!-- recomendações -->
        <div class="recomendacoesdet">

          <h3>Recomendações</h3>

          <ul>
            <li>Utilize transporte coletivo mais vezes na semana.</li>
            <li>Troque lâmpadas comuns por LED.</li>
            <li>Evite desperdício de energia elétrica.</li>
          </ul>

        </div>

      </div>

    </div>

  </div>

  <script>
    const ctx = document.getElementById('graficoDetalhes').getContext('2d');

    new Chart(ctx, {
      type: 'pie',

      data: {
        labels: ['Transporte', 'Energia'],

        datasets: [{
          data: [80, 40],
          backgroundColor: ['#2e7d32', '#66bb6a']
        }]
      },

      options: {
        responsive: false,

        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });
  </script>

</body>
</html>