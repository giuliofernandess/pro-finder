<?php

session_start();

  $id_professional = $_POST['id_professional'];
  $connect = mysqli_connect('localhost', 'root', '', 'pro-finder');
  
  function printInfoPersonal($sql) {
    global $connect;
    $result = $connect->query($sql);
    $res = $result->fetch_array();
    
    echo "<strong> " . $res['name'] . "</strong>";
    echo "<div class='info-item'>
    <strong>Email:</strong>
    <p>Email: " . $res['email'] . "</p></div>";
    echo "<div class='info-item'>
    <strong>Telefone:</strong>
    <p>Telefone: " . $res['telephone'] . "</p>
    </div>";
  }

  function printStateOrCity($sql) {
    global $connect;
    $result = $connect->query($sql);
    $res = $result->fetch_array();
    return $res['name'];
  }

  function printProfessional($sql) {
    global $connect;
    $result = $connect->query($sql);
    $res = $result->fetch_array();

    echo "<p>Categoria: " . $res['category'] . "</p>";
    echo "<p>Profissão: " . $res['profession'] . "</p>";
    echo "<p>Bairro: " . $res['neighborhood'] . "</p>";
    echo "<p>Endereço: " . $res['address'] . "</p>";
    echo "<p>Disponibilidade: " . $res['availability'] . "</p>";
    echo "<p>Link para Contato: <a href='" . $res['link'] . "' target='_blank'>" . $res['link'] . "</a></p>";
    echo "<p>Biografia: " . $res['biography'] . "</p>";
  }
  
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil Profissional - Pro Finder</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 2px solid #105b7e;
            margin-bottom: 15px;
        }

        .info-item {
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 10px;
            background-color: #f9fafb;
            text-align: left;
        }

        .info-item strong {
            display: block;
            margin-bottom: 5px;
        }

        .info-item p {
          margin: 0;
        }
    </style>
  </head>
  <body>
    <?php
      $sql = "SELECT * FROM `accounts` WHERE `id_professional` = '$id_professional'";
      $result = $connect->query($sql);
      $res = $result->fetch_array();
    ?>

    <div class="profile-card">
        <!-- Foto do Usuário Logado -->
        <div class="profile-header">
            <?php if (empty($res['profile_image'])): ?>
                <img src="images/anonymous-user.jpg" alt="Foto de Perfil">
            <?php else: ?>
            <img src="images/profile-images/<?php echo $res['profile_image'] ?>"
                alt="Foto de Perfil">
            <?php endif; ?>
        </div>

        <!-- Dados do Profissional Selecionado -->
        <?php printInfoPersonal("SELECT * FROM `accounts` WHERE `id_professional` = $id_professional"); ?>

        <div class="info-item">
            <strong>Estado:</strong>
            <?php echo printStateOrCity("SELECT `name` FROM `state` WHERE `id` = (SELECT `state` FROM `accounts` WHERE `id_professional` = $id_professional)"); ?>
        </div>

        <div class="info-item">
            <strong>Cidade:</strong>
            <?php echo printStateOrCity("SELECT `name` FROM `city` WHERE `id` = (SELECT `city` FROM `accounts` WHERE `id_professional` = $id_professional)"); ?>
        </div>

        <hr>

        <?php printProfessional("SELECT * FROM `professional` WHERE id_professional = '$id_professional'"); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
