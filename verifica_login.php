<?php
// ============================================================
//  verifica_login.php
//  Middleware chamado pelo botão "Calcular" da paginainicial.
//  Se o usuário não estiver logado, redireciona para o login.
//  Se estiver logado, vai direto para o questionário.
// ============================================================
session_start();

if (!empty($_SESSION['usuario_id'])) {
    header('Location: transporte.php');
} else {
    header('Location: login.php');
}
exit;
