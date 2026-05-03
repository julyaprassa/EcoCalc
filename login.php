<?php
// ============================================================
//  login.php — Autenticação de usuários
// ============================================================
session_start();

// Redireciona se já estiver logado
if (!empty($_SESSION['usuario_id'])) {
    header('Location: paginainicial.php');
    exit;
}

require_once 'conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha']      ?? '';

    if (empty($email) || empty($senha)) {
        $erro = 'Preencha e-mail e senha.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido.';

    } else {
        $conn = conectar();

        $stmt = $conn->prepare('SELECT id, nome, email, senha_hash FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            if (password_verify($senha, $usuario['senha_hash'])) {
                // Login bem-sucedido
                session_regenerate_id(true); // Previne session fixation

                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nome']       = $usuario['nome'];
                $_SESSION['email']      = $usuario['email'];

                $stmt->close();
                $conn->close();

                header('Location: paginainicial.php');
                exit;
            } else {
                $erro = 'E-mail ou senha incorretos.';
            }
        } else {
            // Mantemos a mesma mensagem para não revelar se o e-mail existe
            $erro = 'E-mail ou senha incorretos.';
        }

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
    <title>Entrar — EcoCalc</title>
    <style>
        body {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
        }
        .mensagem-erro {
            background-color: #ffebee;
            color: #c62828;
            border-left: 4px solid #c62828;
            padding: 10px 14px;
            border-radius: 8px;
            margin-top: 14px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="w3-container w3-padding-64">
        <div class="w3-content" style="max-width:500px">
            <div class="card">

                <h2 class="titulo w3-center">Entrar na minha conta</h2>
                <p class="w3-center">Conecte-se para calcular sua pegada de carbono</p>

                <?php if ($erro): ?>
                    <div class="mensagem-erro"><?= htmlspecialchars($erro) ?></div>
                <?php endif; ?>

                <form method="POST" action="login.php">

                    <label>Email</label>
                    <input class="input" type="email" name="email"
                           placeholder="Digite seu email..."
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

                    <label>Senha</label>
                    <input class="input" type="password" name="senha"
                           placeholder="Digite sua senha..." required>

                    <br><br>

                    <button type="submit" class="botao w3-block">
                        Entrar
                    </button>

                </form>

                <p class="w3-center" style="margin-top:15px;">
                    Não possui uma conta?
                    <a href="cadastro.php" style="color:#2e7d32; text-decoration:none;">
                        Cadastrar-se
                    </a>
                </p>

            </div>
        </div>
    </div>
</body>
</html>
