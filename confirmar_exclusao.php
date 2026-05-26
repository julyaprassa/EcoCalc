<?php
session_start();

if (empty($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Exclusão</title>

    <link rel="stylesheet"
          href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>

<div class="card" style="max-width:500px; margin:100px auto; text-align:center;">

        <h2>Tem certeza?</h2>

        <p>
            Deseja realmente excluir sua conta?
        </p>

<div style="margin-top:20px;">

    <a href="excluir.php"
       class="botao"
       style="background-color:#2e7d32; color:white; text-decoration: none; margin-right:15px;">
        Sim
    </a>

    <a href="conta.php"
       class="botao"
       style="background-color:#2e7d32; color:white; text-decoration: none; margin-right:15px;">
        Não
    </a>

</div>

    </div>

</div>

</body>
</html>