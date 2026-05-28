<?php
session_start();
require_once 'conexao.php';

// Verifica se veio ID
if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = intval($_GET['id']);
$usuario = $_SESSION['usuario_id'];

// Busca no banco
$conn = conectar();
$sql = "SELECT * FROM calculos WHERE id = ? AND usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $usuario);
$stmt->execute();
$result = $stmt->get_result();
$calc = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$calc) {
    die("Cálculo não encontrado.");
}

// Variáveis
$transporte         = $calc['tipo_transporte'];
$km_dia             = $calc['km_dia'];
$dias_semana        = $calc['dias_semana'];
$combustivel        = $calc['combustivel'];
$emissao_transporte = $calc['emissao_transporte'];
$pessoas            = $calc['num_moradores'];
$conta_mes          = $calc['valor_conta'];
$usa_led            = $calc['usa_led'] ? 'Sim' : 'Não';
$usa_renov          = $calc['usa_renovavel'] ? 'Sim' : 'Não';
$emissao_energia    = $calc['emissao_energia'];
$emissao_total      = $calc['emissao_total'];
$data               = date("d/m/Y H:i", strtotime($calc['calculado_em']));
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Detalhes</title>
</head>
<body>

<div class="topo w3-bar">
  <a href="index.php" class="w3-bar-item w3-xlarge" style="text-decoration:none;">EcoCalc</a>
  <a href="historico.php" class="w3-bar-item w3-button w3-right">Voltar</a>
</div>

<div class="w3-container w3-padding-64">
  <div class="w3-content" style="max-width:1000px">

    <div class="card">
      <h2 class="titulo">Detalhes da Emissão</h2>
      <p class="recado">Cálculo realizado em <strong><?= $data ?></strong></p>

      <div class="resultado">
        <h3>Total emitido:</h3>
        <p><strong><?= number_format($emissao_total, 2, ',', '.') ?> kg CO₂</strong></p>
      </div>
      <div class="detalhescontainer" 
           style="display:flex; gap:30px; margin-top:30px; flex-wrap:wrap;">

        <!-- Gráfico -->
        <div class="grafico" style="flex:1; min-width:300px;">
          <canvas id="graficoDetalhes"></canvas>
        </div>

        <!-- Informações em coluna -->
        <div class="detalhesinfo" 
             style="flex:1; min-width:300px; display:flex; flex-direction:column; gap:20px;">

          <div class="infoitem" style="background:#f5f5f5; padding:15px; border-radius:8px;">
            <h4>Transporte</h4>
            <p><?= number_format($emissao_transporte, 2, ',', '.') ?> kg CO₂</p>
          </div>

          <div class="infoitem" style="background:#f5f5f5; padding:15px; border-radius:8px;">
            <h4>Energia</h4>
            <p><?= number_format($emissao_energia, 2, ',', '.') ?> kg CO₂</p>
          </div>

          <div class="infoitem" style="background:#f5f5f5; padding:15px; border-radius:8px;">
            <h4>Transporte usado</h4>
            <p><?= $transporte ?> (<?= $combustivel ?>)</p>
          </div>

          <div class="infoitem" style="background:#f5f5f5; padding:15px; border-radius:8px;">
            <h4>Conta de energia</h4>
            <p>R$ <?= number_format($conta_mes, 2, ',', '.') ?></p>
          </div>

          <div class="infoitem" style="background:#f5f5f5; padding:15px; border-radius:8px;">
            <h4>Moradores</h4>
            <p><?= $pessoas ?></p>
          </div>

        </div>

      </div>

      <div class="recomendacoesdet">
        <h3>Recomendações</h3>
        <ul>
          <?php if ($emissao_transporte > $emissao_energia): ?>
            <li>Seu maior impacto vem do transporte. Considere reduzir o uso de veículo individual.</li>
          <?php else: ?>
            <li>Seu maior impacto vem da energia. Considere reduzir o consumo elétrico.</li>
          <?php endif; ?>

          <?php if ($usa_led == 'Não'): ?>
            <li>Trocar lâmpadas por LED pode reduzir até 20% do consumo.</li>
          <?php endif; ?>

          <?php if ($usa_renov == 'Não'): ?>
            <li>Considere migrar para energia renovável se possível.</li>
          <?php endif; ?>
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
      data: [<?= $emissao_transporte ?>, <?= $emissao_energia ?>],
      backgroundColor: ['#2e7d32', '#66bb6a']
    }]
  },
  options: {
    responsive: false,
    plugins: {
      legend: { position: 'bottom' }
    }
  }
});
</script>

</body>
</html>