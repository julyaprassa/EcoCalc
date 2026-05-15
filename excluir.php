<?php

session_start();
include("conexao.php");

$id = $_SESSION['id'];

$sql = "DELETE FROM usuarios WHERE id = $id";

mysqli_query($conn, $sql);

session_destroy();

header("Location: login.php");

?>