<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profissional - ProFinder</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <script src="js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">
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
        <a href="index.php"><img src="images/logo.png" alt="Logo"></a>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <h1 class="form-title">Torne-se um Profissional</h1>
        <form method="post" action="submitBecomeProfessional.php" class="form-box">
            <div class="form-group">
                <label for="category">Categoria</label>
                <select name="category" id="category" class="form-control" required>
                    <option value=""></option>
                    <option value="Saúde">Saúde</option>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Jurídico">Jurídico</option>
                    <option value="Design">Design</option>
                    <option value="Educação">Educação</option>
                    <option value="Construção">Construção</option>
                    <option value="Músico">Músico</option>
                </select>
            </div>
            <div class="form-group">
                <label for="profession">Profissão</label>
                <input type="text" class="form-control" name="profession" id="profession" placeholder="Digite sua Profissão" required>
            </div>
            <div class="form-group">
                <label for="neighborhood">Bairro</label>
                <input type="text" class="form-control" name="neighborhood" id="neighborhood" placeholder="Digite sua Bairro" required>
            </div>
            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" name="address" id="adress" placeholder="Logradouro, Número da casa" required>
            </div>
            <div class="form-group">
                <label for="availability">Horários Disponíveis</label>
                <input type="text" class="form-control" name="availability" id="availability" placeholder="Ex.: Segunda à Sexta das 8:00 às 18:00" required>
            </div>
            <div class="form-group">
                <label for="link">Link</label><br>
                <input id="link" name="link" class="form-control" placeholder="Link para contato com o usuário" required></input>
            </div>
            <div class="form-group">
                <label for="biography">Biografia</label><br>
                <textarea id="biography" name="biography" placeholder="Sua história, conquistas e formações" required></textarea>
            </div>
            <input type="hidden" class="form-control" name="email" id="email"
                    value="<?php echo $_SESSION['email']; ?>" required>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>

</body>

</html>