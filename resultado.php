<?php
session_start();
require_once 'conexao.php';

if (!empty($_GET['id'])) {

    $conn = conectar();
    $sql = "SELECT * FROM calculos WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $_GET['id'], $_SESSION['usuario_id']);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $calc = $resultado->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($calc) {
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
    }

} else {


    $dados_t = $_SESSION['dados_transporte'] ?? [];
    $transporte   = $dados_t['transporte']   ?? 'Não informado';
    $km_dia       = floatval($dados_t['km_dia'] ?? 0);
    $dias_semana  = intval($dados_t['dias_semana'] ?? 0);
    $combustivel  = $dados_t['combustivel']  ?? 'Nenhum';

    $dados_e = $_SESSION['dados_energia'] ?? [];
    $pessoas   = intval($dados_e['pessoas_residencia'] ?? 1);
    $conta_mes = floatval($dados_e['valor_conta'] ?? 0);
    $usa_led   = $dados_e['usa_led'] ?? 'Não';
    $usa_renov = $dados_e['usa_renovavel'] ?? 'Não';

    // Transporte
    $emissao_transporte = 0;
    if ($transporte !== 'Bicicleta' && $transporte !== 'A pé') {
        $fator = 0.20;
        if ($combustivel == 'Etanol') $fator = 0.14;
        if ($combustivel == 'Diesel') $fator = 0.25;
        if ($combustivel == 'Elétrico') $fator = 0.05;
        if ($transporte == 'Ônibus') $fator = 0.03;

        $emissao_transporte = ($km_dia * $dias_semana * 4.3) * $fator;
    }

    // Energia
    $emissao_energia = ($conta_mes / max($pessoas,1)) * 0.5;
    if ($usa_led == 'Sim') $emissao_energia *= 0.8;
    if ($usa_renov == 'Sim') $emissao_energia = 0;

    $emissao_total = $emissao_transporte + $emissao_energia;


    if (!empty($_SESSION['usuario_id'])) {

        // VARIÁVEIS SEPARADAS (ESSENCIAL)
        $led   = ($usa_led == 'Sim' ? 1 : 0);
        $renov = ($usa_renov == 'Sim' ? 1 : 0);

        $conn = conectar();
        $sql = "INSERT INTO calculos (
            usuario_id, tipo_transporte, km_dia, dias_semana, combustivel,
            emissao_transporte, num_moradores, valor_conta, usa_led, usa_renovavel,
            emissao_energia, emissao_total
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);


       $stmt->bind_param(
    "isdisdididdd",
    $_SESSION['usuario_id'],  // i
    $transporte,              // s
    $km_dia,                  // d
    $dias_semana,             // i
    $combustivel,             // s
    $emissao_transporte,      // d
    $pessoas,                 // i
    $conta_mes,               // d
    $led,                     // i
    $renov,                   // i
    $emissao_energia,         // d
    $emissao_total            // d
);
        

        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Resultados — EcoCalc</title>
</head>
<body>

    <div class="topo w3-bar">
        <a href="index.php" class="w3-bar-item w3-xlarge" style="text-decoration:none;">EcoCalc</a>
        <a href="conta.php" class="w3-bar-item w3-button w3-right">Minha Conta</a>
    </div>

    <div class="w3-container w3-padding-64">
        <div class="w3-content" style="max-width:1100px">
            <div class="card">
                <h2 class="titulo">Seu Resultado</h2>
                <?php if(!empty($_SESSION['usuario_nome'])): ?>
                    <p class="recado">Usuário logado: <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong></p>
                <?php endif; ?>
                <p class="recado">Cálculo baseado nos seus hábitos de consumo.</p>
            </div>

            <div class="resultado w3-center" style="margin: 20px 0;">
                <h3>Total de emissões:</h3>
                <p style="font-size: 48px; color: #2e7d32;">
                    <strong><?= number_format($emissao_total, 2, ',', '.') ?> kg CO₂</strong>/mês
                </p>
            </div>

            <div class="resultado-container" style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 20px;">
                <div class="grafico card" style="flex: 1; min-width: 300px; display: flex; justify-content: center;">
                    <canvas id="graficoEmissoes" width="300" height="300"></canvas>
                </div>

                <div class="detalhes card" style="flex: 1; min-width: 300px;">
                    <h3>Detalhes do cálculo:</h3>
                    <ul>
                        <li><strong>Transporte:</strong> <?= htmlspecialchars($transporte) ?> (<?= htmlspecialchars($combustivel) ?>)</li>
                        <li><strong>Km/dia:</strong> <?= $km_dia ?> km</li>
                        <li><strong>Dias/semana:</strong> <?= $dias_semana ?></li>
                        <li><strong>Moradores:</strong> <?= $pessoas ?></li>
                        <li><strong>Conta de energia:</strong> R$ <?= number_format($conta_mes, 2, ',', '.') ?></li>
                        <li><strong>LED:</strong> <?= $usa_led ?></li>
                        <li><strong>Energia renovável:</strong> <?= $usa_renov ?></li>
                    </ul>
                </div>

                <div class="recomendacoes card" style="flex: 1; min-width: 300px;">
                    <h3>Dicas para você:</h3>
                    <ul>
                        <?php if($emissao_transporte > 0): ?>
                            <li>Seu transporte impacta bastante. Considere caronas ou transporte público.</li>
                        <?php else: ?>
                            <li>Parabéns! Seu transporte (<?= htmlspecialchars($transporte) ?>) não emite CO₂. Continue assim.</li>
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
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true, text: 'Emissões por categoria' }
                }
            }
        });
    </script>

    <div class="w3-center" style="margin-top: 40px;">
        <a href="historico.php" class="botao" style="margin-right: 10px; text-decoration: none;">
            Ver Histórico
        </a>

        <a href="index.php" class="botao" style="margin-right: 10px; text-decoration: none;">
            Novo Cálculo
        </a>
    </div>

</body>
</html>