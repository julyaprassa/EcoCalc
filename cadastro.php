<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <!-- fonte das letras -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Cadastro</title>
   <style>
    body {
    background: linear-gradient(135deg, #2e7d32, #4caf50);
}
</style>

</head>

<body>
    <div class="w3-container w3-padding-64">
        <div class="w3-content" style="max-width:500px">
        <div class="card">

            <h2 class="titulo w3-center">Criar Conta</h2>

            <p class="w3-center">
                Cadastre-se para calcular sua pegada de carbono
            </p>

            <!-- Preenchimento dos dados-->
            <form>

                <label>Nome</label>
                <input class="input" type="text" placeholder="Digite seu nome..." required>

                
                <!-- Email -->
                <label>Email</label>
                <input class="input" type="email" placeholder="Digite seu email..." required>
                

                <!-- Senha -->
                <label>Senha</label>
                <input class="input" type="password" placeholder="Digite sua senha..." required>
                

                <!-- Confirmar senha -->
                <label>Confirmar Senha</label>
                <input class="input" type="password" placeholder="Confirme sua senha" required>

                <br><br>

                <!-- botão -->
                <button class="botao w3-block">
                    Concluir cadastro
                </button>

            </form>

            <p class="w3-center" style="margin-top:15px;">
                Já possui uma conta?
                    <!-- text decoration: none = sem grifado embaixo -->
                <a href="login.php" style="color: #2e7d32; text-decoration: none;">
                    Fazer login
                </a>
            </p>

        </div>
</div>
</div> 
</body>
</html>