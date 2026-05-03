<?php
// ============================================================
//  conta.php — Perfil e histórico de cálculos do usuário
// ============================================================
session_start();

// Protege a página: redireciona se não estiver logado
if (empty($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'conexao.php';

$conn = conectar();

// Busca dados atualizados do usuário no banco
$stmt = $conn->prepare('SELECT nome, email, criado_em FROM usuarios WHERE id = ? LIMIT 1');
$stmt->bind_param('i', $_SESSION['usuario_id']);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Busca histórico de cálculos do usuário
$hist = $conn->prepare(
    'SELECT calculado_em, emissao_transporte, emissao_energia, emissao_total,
            tipo_transporte, combustivel, km_dia, dias_semana,
            valor_conta, usa_led, usa_renovavel
     FROM calculos
     WHERE usuario_id = ?
     ORDER BY calculado_em DESC'
);
$hist->bind_param('i', $_SESSION['usuario_id']);
$hist->execute();
$calculos = $hist->get_result()->fetch_all(MYSQLI_ASSOC);
$hist->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta — EcoCalc</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
        }
        .badge-baixo  { background:#e8f5e9; color:#2e7d32; }
        .badge-medio  { background:#fff8e1; color:#f57f17; }
        .badge-alto   { background:#ffebee; color:#c62828; }
        .tabela-hist  { width:100%; border-collapse:collapse; margin-top:12px; font-size:14px; }
        .tabela-hist th { background:#f1f8e9; color:#2e7d32; padding:10px; text-align:left; }
        .tabela-hist td { padding:10px; border-bottom:1px solid #eee; vertical-align:middle; }
        .tabela-hist tr:last-child td { border-bottom:none; }
        .sem-historico { color:#888; font-style:italic; margin-top:10px; }
        .membro-desde { font-size:13px; color:#aaa; margin-top:4px; }
    </style>
</head>
<body>

    <div class="topo w3-bar">
        <span class="w3-bar-item w3-xlarge">EcoCalc</span>
        <a href="logout.php" class="w3-bar-item w3-button w3-right">Sair</a>
    </div>

    <div class="w3-container w3-padding-64">
        <div class="w3-content" style="max-width:750px">

            <!-- Card com dados do usuário -->
            <div class="card" style="margin-bottom:28px">
                <h2 class="titulo">Minha Conta</h2>

                <p style="margin:0">
                    <strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?>
                </p>
                <p style="margin:6px 0">
                    <strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?>
                </p>
                <p class="membro-desde">
                    Membro desde <?= date('d/m/Y', strtotime($usuario['criado_em'])) ?>
                </p>
            </div>

            <!-- Histórico de cálculos -->
            <div class="card">
                <h3 class="titulo">Histórico de Pegada de Carbono</h3>

                <?php if (empty($calculos)): ?>
                    <p class="sem-historico">Nenhum cálculo realizado ainda.</p>
                    <a href="transporte.php" class="botao" style="text-decoration:none; display:inline-block; margin-top:14px;">
                        Fazer meu primeiro cálculo →
                    </a>
                <?php else: ?>
                    <table class="tabela-hist">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Transporte (kg CO₂)</th>
                                <th>Energia (kg CO₂)</th>
                                <th>Total mensal (kg CO₂)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($calculos as $c): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($c['calculado_em'])) ?></td>
                                <td><?= number_format($c['emissao_transporte'], 2, ',', '.') ?></td>
                                <td><?= number_format($c['emissao_energia'],    2, ',', '.') ?></td>
                                <td><strong><?= number_format($c['emissao_total'], 2, ',', '.') ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <a href="transporte.php" class="botao" style="text-decoration:none; display:inline-block; margin-top:20px;">
                        Novo cálculo →
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>

</body>
</html>
