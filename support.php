<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suporte - ProFinder</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body, html {
            height: 100vh;
        }
    </style>
</head>

<body>

    <!-- Logo -->
    <div class="logo">
        <a href="index.php"><img src="images/logo.png" alt="Logo"></a>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <h1 class="form-title">Contato</h1>
        <form method="post" action="support.php" class="form-box">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="email" class="form-control" id="name" placeholder="Digite seu Nome">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Digite seu Email">
            </div>
            <div class="form-group">
                <label for="mensage">Mensagem</label><br>
                <textarea id="mensage"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>

</body>

</html>