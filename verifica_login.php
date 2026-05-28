<?php

//  Se o usuário não estiver logado, redireciona para o login.
//  Se estiver logado, vai direto para o questionário.

session_start();

if (!empty($_SESSION['usuario_id']) && !empty($_SESSION['usuario_nome'])) {
    header('Location: transporte.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
