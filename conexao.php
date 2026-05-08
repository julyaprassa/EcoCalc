<?php
// ============================================================
//  conexao.php — Conexão com o banco de dados MySQL (XAMPP)
//  Inclua este arquivo em todas as páginas que precisam do BD:
//      require_once 'conexao.php';
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // usuário padrão do XAMPP
define('DB_PASS', '');           // senha padrão do XAMPP (em branco)
define('DB_NAME', 'ecocalc');
define('DB_PORT', 3306);

function conectar(): mysqli
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    if ($conn->connect_error) {
        // Em produção substitua por uma página de erro amigável
        error_log('Falha na conexão: ' . $conn->connect_error);
        die('Não foi possível conectar ao banco de dados. Tente novamente mais tarde.');
    }

    $conn->set_charset('utf8mb4');
    return $conn;
}
