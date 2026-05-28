<?php
session_start();

// Protege a página
if (empty($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'conexao.php';
$conn = conectar();

// Busca o histórico real do banco de dados para o usuário logado
$sql = "SELECT id, calculado_em, emissao_total 
        FROM calculos 
        WHERE usuario_id = ? 
        ORDER BY calculado_em DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$resultado = $stmt->get_result();
$meus_calculos = $resultado->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="estilo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <title>Meu Histórico — EcoCalc</title>
</head>

<body>

  <div class="topo w3-bar">
    <a href="index.php" class="w3-bar-item w3-xlarge" style="text-decoration:none;">EcoCalc</a>

    <?php if(!empty($_SESSION['usuario_nome'])): ?>
      <span class="w3-bar-item w3-right">Logado como <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong></span>
    <?php endif; ?>

    <label for="afmenu" class="w3-bar-item w3-button w3-right"><i class="fa fa-bars"></i></label>
    <input type="checkbox" id="afmenu" hidden>
    <div class="overlay"></div>

    <nav class="menu">
      <label for="afmenu" class="fechar"><i class="fa fa-bars"></i></label>
      <a href="conta.php" class="w3-bar-item w3-button">Minha Conta</a>
      <a href="historico.php" class="w3-bar-item w3-button">Histórico</a>
      <a href="sobre.php" class="w3-bar-item w3-button">Sobre</a>
      <a href="logout.php" class="w3-bar-item w3-button">Sair</a>
    </nav>
  </div>

  <div class="w3-container w3-padding-64">
    <div class="w3-content" style="max-width:1000px">
      <div class="card">
        <h2 class="titulo">Histórico de Emissões</h2>
        <p class="recado">Abaixo estão os resultados dos seus cálculos salvos no banco de dados.</p>

        <div class="historicolista">

          <?php if (empty($meus_calculos)): ?>

            <p style="text-align:center; color:#888;">Você ainda não realizou nenhum cálculo.</p>
            <div style="text-align:center;">
                <a href="transporte.php" class="botaohist" style="text-decoration:none; background:#2e7d32; color:white;">Começar agora</a>
            </div>

          <?php else: ?>

            <?php foreach ($meus_calculos as $calc): ?>
              <div class="historicoitem" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding: 15px 0;">

                <div>
                  <h3 style="margin:0; font-size:18px;">
                    <?= date('d/m/Y - H:i', strtotime($calc['calculado_em'])) ?>
                  </h3>

                  <p style="margin:0; color:#2e7d32; font-weight:bold;">
                    <?= number_format($calc['emissao_total'], 2, ',', '.') ?> kg CO₂
                  </p>
                </div>

                <!-- CORREÇÃO AQUI: envia o ID correto -->
                <a href="detalhes.php?id=<?= $calc['id'] ?>" class="botaohist" style="text-decoration:none;">
                  Ver detalhes
                </a>

              </div>
            <?php endforeach; ?>

          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>

</body>
</html>