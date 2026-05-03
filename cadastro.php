<?php
// ============================================================
//  cadastro.php — Cadastro de novos usuários
// ============================================================
session_start();

// Redireciona se já estiver logado
if (!empty($_SESSION['usuario_id'])) {
    header('Location: paginainicial.php');
    exit;
}

require_once 'conexao.php';

$erro    = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- Coleta e sanitização dos dados ---
    $nome            = trim($_POST['nome']            ?? '');
    $email           = trim($_POST['email']           ?? '');
    $senha           = $_POST['senha']                ?? '';
    $confirmar_senha = $_POST['confirmar_senha']      ?? '';

    // --- Validações ---
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $erro = 'Preencha todos os campos.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido.';

    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter pelo menos 6 caracteres.';

    } elseif ($senha !== $confirmar_senha) {
        $erro = 'As senhas não coincidem.';

    } else {
        $conn = conectar();

        // Verifica se o e-mail já está cadastrado
        $stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $erro = 'Este e-mail já está cadastrado.';
        } else {
            // Cadastra o novo usuário
            $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

            $ins = $conn->prepare('INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)');
            $ins->bind_param('sss', $nome, $email, $senha_hash);

            if ($ins->execute()) {
                // Faz login automático após o cadastro
                $_SESSION['usuario_id'] = $ins->insert_id;
                $_SESSION['nome']       = $nome;
                $_SESSION['email']      = $email;

                $ins->close();
                $stmt->close();
                $conn->close();

                header('Location: paginainicial.php');
                exit;
            } else {
                $erro = 'Erro ao cadastrar. Tente novamente.';
            }

            $ins->close();
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
    <title>Cadastro — EcoCalc</title>
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

                <h2 class="titulo w3-center">Criar Conta</h2>
                <p class="w3-center">Cadastre-se para calcular sua pegada de carbono</p>

                <?php if ($erro): ?>
                    <div class="mensagem-erro"><?= htmlspecialchars($erro) ?></div>
                <?php endif; ?>

                <form method="POST" action="cadastro.php">

                    <label>Nome</label>
                    <input class="input" type="text" name="nome"
                           placeholder="Digite seu nome..."
                           value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>

                    <label>Email</label>
                    <input class="input" type="email" name="email"
                           placeholder="Digite seu email..."
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

                    <label>Senha</label>
                    <input class="input" type="password" name="senha"
                           placeholder="Mínimo 6 caracteres..." required>

                    <label>Confirmar Senha</label>
                    <input class="input" type="password" name="confirmar_senha"
                           placeholder="Confirme sua senha..." required>

                    <br><br>

                    <button type="submit" class="botao w3-block">
                        Concluir cadastro
                    </button>

                </form>

                <p class="w3-center" style="margin-top:15px;">
                    Já possui uma conta?
                    <a href="login.php" style="color:#2e7d32; text-decoration:none;">
                        Fazer login
                    </a>
                </p>

            </div>
        </div>
    </div>
</body>
</html>
