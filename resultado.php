<?php
session_start();
require_once 'conexao.php';

// 1. Coleta os dados das páginas anteriores (Sessão + Post atual)
$dados_t = $_SESSION['dados_transporte'] ?? [];
$transporte = $dados_t['transporte'] ?? 'Não informado';
$km_dia     = floatval($dados_t['km_dia'] ?? 0);
$dias_semana= intval($dados_t['dias_semana'] ?? 0);
$combustivel= $dados_t['combustivel'] ?? 'Nenhum';

$pessoas    = intval($_POST['pessoas_residencia'] ?? 1);
$conta_mes  = floatval($_POST['valor_conta'] ?? 0);
$usa_led    = $_POST['usa_led'] ?? 'Não';
$usa_renov  = $_POST['usa_renovavel'] ?? 'Não';

// 2. LÓGICA DE CÁLCULO (O que o Ribeiro pediu)
$emissao_transporte = 0;

if ($transporte !== 'Bicicleta' && $transporte !== 'A pé') {
    // Fatores de emissão simplificados (kg CO2 por km)
    $fator = 0.20; // Padrão Gasolina
    if ($combustivel == 'Etanol') $fator = 0.14;
    if ($combustivel == 'Diesel') $fator = 0.25;
    if ($combustivel == 'Elétrico') $fator = 0.05;
    if ($transporte == 'Ônibus') $fator = 0.03;

    $emissao_transporte = ($km_dia * $dias_semana * 4.3) * $fator; 
}

// Cálculo Energia (simplificado)
$emissao_energia = ($conta_mes / $pessoas) * 0.5;
if ($usa_led == 'Sim') $emissao_energia *= 0.8;
if ($usa_renov == 'Sim') $emissao_energia = 0;

$emissao_total = $emissao_transporte + $emissao_energia;

// 3. SALVAR NO BANCO DE DADOS
if (!empty($_SESSION['usuario_id'])) {
    $conn = conectar();
    $sql = "INSERT INTO calculos (usuario_id, emissao_transporte, emissao_energia, emissao_total, tipo_transporte, combustivel, km_dia, dias_semana, valor_conta, usa_led, usa_renovavel) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idddssdidss", $_SESSION['usuario_id'], $emissao_transporte, $emissao_energia, $emissao_total, $transporte, $combustivel, $km_dia, $dias_semana, $conta_mes, $usa_led, $usa_renov);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Resultados — EcoCalc</title>
</head>
<body>

    <div class="topo w3-bar">
        <a href="paginainicial.php" class="w3-bar-item w3-xlarge" style="text-decoration:none;">EcoCalc</a>
        <a href="conta.php" class="w3-bar-item w3-button w3-right">Minha Conta</a>
    </div>

    <div class="w3-container w3-padding-64">
        <div class="w3-content" style="max-width:1100px">
            <div class="card">
                <h2 class="titulo">Seu Resultado</h2>
                <p class="recado">Cálculo baseado nos seus hábitos de consumo.</p>
            </div>

            <div class="resultado w3-center" style="margin: 20px 0;">
                <h3>Total de emissões:</h3>
                <p style="font-size: 48px; color: #2e7d32;"><strong><?= number_format($emissao_total, 2, ',', '.') ?> kg CO₂</strong>/mês</p>
            </div>

            <div class="resultado-container" style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 20px;">
                <div class="grafico card" style="flex: 1; min-width: 300px; display: flex; justify-content: center;">
                    <canvas id="graficoEmissoes" width="300" height="300"></canvas>
                </div>

                <div class="recomendacoes card" style="flex: 1; min-width: 300px;">
                    <h3>Dicas para você:</h3>
                    <ul>
                        <?php if($emissao_transporte > 0): ?>
                            <li>Seu transporte impacta bastante. Considere caronas ou transporte público.</li>
                        <?php else: ?>
                            <li>Parabéns! Seu transporte (<?= $transporte ?>) não emite CO₂. Continue assim!</li>
                        <?php endif; ?>
                        
                        <?php if($usa_led == 'Não'): ?>
                            <li>Trocar para lâmpadas LED pode reduzir sua conta e emissão em até 20%.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('graficoEmissoes').getContext('2d');
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
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>
</body>
</html>