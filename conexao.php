<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ecocalc');
define('DB_PORT', 3306);

function conectar(): mysqli
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    if ($conn->connect_error) {
        error_log('Falha na conexão: ' . $conn->connect_error);
        die('Não foi possível conectar ao banco de dados. Tente novamente mais tarde.');
    }

    $conn->set_charset('utf8mb4');
    return $conn;
}
