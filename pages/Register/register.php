<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro - ProFinder</title>
    <link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
    <script src="../../js/jquery.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <script src="../../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap-select.min.css">
    <script src="../../js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <!-- Logo -->
    <div class="logo">
        <a href="../index.php"><img src="../../images/logo.png" alt="Logo Pro Finder"></a>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <h1 class="form-title">Cadastre-se</h1>
        <form method="post" action="validateRegister.php" class="form-box">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Digite seu Nome" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu Email"
                    required>
            </div>

            <div class="form-group">
                <label for="date">Data de Nascimento</label>
                <input type="date" class="form-control" name="dateOfBirth" id="date" required>
            </div>

            <div class="form-group">
                <label for="tel">Telefone</label>
                <input type="text" class="form-control" name="telephone" id="tel" required>
            </div>

            <div class="form-group">
                <label for="states">Estado</label>
                <select name="states" id="states" class="form-control" data-live-search="true"
                    title="Selecione o Estado" required></select>
            </div>
            <div class="form-group">
                <label for="cities">Cidade</label>
                <select name="cities" id="cities" class="form-control" data-live-search="true"
                    title="Selecione a Cidade" required></select>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua Senha"
                    required minlength="8" maxlength="20">
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirmar Senha</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"
                    placeholder="Digite sua Senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>

        <div class="footer-text">
            Já possui uma conta? <a href="../Login/login.php">Acesse</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        // Mascara de input para telefone
        $('#tel').mask('(00) 00000-0000', { placeholder: '(00) 00000-0000' });

    </script>
    <script>
        $(document).ready(function () {

            $('select').selectpicker();

            //$('#cities').selectpicker();

            loadInformations('states');

            function loadInformations(type, cat_id = '') {
                $.ajax({
                    url: "../../general_features/loadInformations.php",
                    method: "POST",
                    data: { type: type, cat_id: cat_id },
                    dataType: "json",
                    success: function (data) {
                        var html = '';
                        for (var count = 0; count < data.length; count++) {
                            html += '<option value="' + data[count].id + '">' + data[count].name + '</option>';
                        }
                        if (type == 'states') {
                            $('#states').html(html);
                            $('#states').selectpicker('refresh');
                        } else {
                            $('#cities').html(html);
                            $('#cities').selectpicker('refresh');
                        }
                    }
                })
            }

            $(document).on('change', '#states', function () {
                var cat_id = $('#states').val();
                loadInformations('cities', cat_id);
            });

        });
    </script>

</body>

</html>