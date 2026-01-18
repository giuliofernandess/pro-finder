<!-- Proteção contra acessos indevidos -->
<?php

session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    require_once '../../../general_features/bdConnect.php';
    $sql = "SELECT * FROM `accounts` WHERE `email` = '$email'";
    $result = $connect->query($sql);
    $res = $result->fetch_array();
    $id_professional = $res['id_professional'];

    function printProfessional($key) {
        global $id_professional;
        global $connect;
        $sql = "SELECT * FROM `professional` WHERE `id_professional` = '$id_professional'";
        $result = $connect->query($sql);
        $res = $result->fetch_array();

        $columns = [$res['category'], $res['profession'], $res['neighborhood'], $res['address'], $res['availability'], $res['link'], $res['id_professional']];

        return $columns[$key];
    }

} else {
    echo "<meta http-equiv='refresh' content='0; url=../../index.php'>";
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Perfil - Pro Finder</title>
    <link rel="shortcut icon" href="../../../images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="../../../js/jquery.js"></script>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css" />
    <script src="../../../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../css/bootstrap-select.min.css">
    <script src="../../../js/bootstrap-select.min.js"></script>
    <script src="../../../js/inputMask.js"></script>
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/profileEdit.css">
    <style>
        body {
            background-image: none;
        }

        main {
            width: 100%;
        }

        .form-group input {
            width: 100% !important;
            background-color: #fff !important;
        }

        @media screen and (min-width: 768px) {
            main {
                width: 40%;
            }
        }
    </style>
</head>

<body>

    <main>
        <form action="validateProfileEdit.php" method="post" enctype="multipart/form-data">
            <h1>Editar Perfil</h1>
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $res['name']; ?>"
                    required>
            </div>
            <input type="hidden" class="form-control" name="email" id="email"
                    value="<?php echo $res['email']; ?>" required>
            <div class="form-group">
                <label for="tel">Telefone</label>
                <input type="text" class="form-control" name="telephone" id="tel"
                    value="<?php echo $res['telephone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="states">Estado</label>
                <select name="states" id="states" class="form-control" data-live-search="true" title="Selecione o Estado"></select>
            </div>
            <div class="form-group">
                <label for="cities">Cidade</label>
                <select name="cities" id="cities" class="form-control" data-live-search="true" title="Selecione a Cidade">
                </select>
            </div>
            <?php if ($res['user_or_prof'] == 1) { ?>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select name="category" id="category" class="form-control" title="Selecione a Categoria" required>
                        <option value="<?php echo printProfessional(0); ?>" selected><?php echo printProfessional(0); ?></  option>
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
                    <input type="text" class="form-control" name="profession" id="profession"
                        value="<?php echo printProfessional(1); ?>" required>
                </div>
                <div class="form-group">
                    <label for="neighborhood">Bairro</label>
                    <input type="text" class="form-control" name="neighborhood" id="neighborhood"
                        value="<?php echo printProfessional(2); ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input type="text" class="form-control" name="address" id="address"
                        value="<?php echo printProfessional(3); ?>" required>
                </div>
                <div class="form-group">
                    <label for="availability">Disponibilidade</label>
                    <input type="text" class="form-control" name="availability" id="availability"
                        value="<?php echo printProfessional(4); ?>" required>
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" name="link" id="link"
                        value="<?php echo printProfessional(5); ?>" required>
                </div>
                <div class="form-group">
                    <label for="biography">Biografia</label><br>
                    <textarea id="biography" name="biography" style="background-color: #fff; border: 1px solid #ccc; color: #000; width: 100%;"></textarea>
                </div>
                <input type="hidden" class="form-control" name="id_professional" id="id_professional"
                        value="<?php echo printProfessional(6) ?>" required>
            <?php } ?>
            <div class="form-group">
                    <label for="file">Foto de Perfil</label><br>
                    <input type="file" name="file" class="form-control" id="inputFile" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary w-100">Editar</button>
        </form>

        <form action="DeleteProfile/deleteProfile.php" method="post">
            <input type="hidden" name="id_professional" id="id_professional" value="<?php echo printProfessional(6); ?>">
            <button type="submit" class="btn btn-danger w-100 mt-3">Excluir Perfil</button>
        </form>
    </main>
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
                    url: "../../../general_features/loadInformations.php",
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