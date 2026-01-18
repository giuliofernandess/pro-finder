<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ProFinder</title>
    <link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <script src="../../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        body,
        html {
            height: 100vh;
        }

        .form-box {
            width: 400px;
        }

        @media screen and (min-width: 768px) {
            .form-box {
                width: 450px;
            }
        }
    </style>
</head>

<body>

    <!-- Logo -->
    <div class="logo">
        <a href="../index.php"><img src="../../images/logo.png" alt="Logo"></a>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <h1 class="form-title">Login</h1>
        <form method="post" action="validateLogin.php" class="form-box">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu Email">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="password"   id="password" placeholder="Digite sua Senha">
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>

        <div class="footer-text">
            Não tem uma conta? <a href="../Register/register.php">Cadastre-se</a>
        </div>
    </div>

</body>

</html>