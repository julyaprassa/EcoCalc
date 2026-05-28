<?php

session_start();

if (empty($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'conexao.php';

$conn = conectar();

$id = $_SESSION['usuario_id'];

// Exclui os cálculos do usuário
$stmt = $conn->prepare(
    "DELETE FROM calculos WHERE usuario_id = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

// Exclui a conta do usuário
$stmt = $conn->prepare(
    "DELETE FROM usuarios WHERE id = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

$conn->close();

// Encerra sessão
session_destroy();

// Redireciona para login
header("Location: login.php");
exit;

?>