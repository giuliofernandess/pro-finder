<?php

session_start();

if (isset($_SESSION['email'])) {
  require_once '../../general_features/bdConnect.php';

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

} else {
  echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
  exit;
}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil - Pro Finder</title>
    <link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/profile.css">
    <link rel="stylesheet" href="../../css/style.css">
    <style>
      .form-group img {
        border: 2px dashed blue;
        border-radius: 50%;
        width: 100px;
        height: 100px;
      }
    </style>
  </head>
  <body>
    <?php
      $email = $_SESSION['email'];
      $sql = "SELECT * FROM `accounts` WHERE `email` = '$email'";
      $result = $connect->query($sql);
      $res = $result->fetch_array();
      $id_professional = $res['id_professional'];
      $state = $res['state'];
      $city = $res['city'];
    ?>

    <div class="profile-card">
        <!-- Foto -->
        <div class="profile-header">
            <?php if (empty($res['profile_image'])): ?>
                <img src="../../images/anonymous-user.jpg" alt="Foto de Perfil">
            <?php else: ?>
            <img src="../../images/profile-images/<?php echo $res['profile_image'] ?>"
                alt="Foto de Perfil">
            <?php endif; ?>
            <h5><strong><?php echo $res['name']; ?></strong></h5>
        </div>

        <!-- Informações -->
        <div class="info-item">
            <strong>Email:</strong>
            <?php echo $res['email']; ?>
        </div>
        <div class="info-item">
            <strong>Telefone:</strong>
            <?php echo $res['telephone']; ?>
        </div>
        <div class="info-item">
            <strong>Estado:</strong>
            <?php echo printStateOrCity("SELECT `name` FROM `state` WHERE id = '$state'"); ?>
        </div>
        <div class="info-item">
            <strong>Cidade:</strong>
            <?php echo printStateOrCity("SELECT `name` FROM `city` WHERE id = '$city'"); ?>
        </div>

        <?php if ($res['user_or_prof'] == 1): ?>
            <hr>
            <?php printProfessional("SELECT * FROM `professional` WHERE id_professional = '$id_professional'"); ?>
        <?php endif; ?>

        <!-- Botões Editar e Sair -->
        <div class="btn-action-group">
            <a href="ProfileEdit/profileEdit.php" class="btn btn-primary">Editar Perfil</a>
            <a href="Logout/logout.php" class="btn btn-danger">Sair</a>
        </div>

        <!-- Botão Tornar-se Profissional -->
        <?php if ($res['user_or_prof'] != 1): ?>
            <a href="BecomeProfessional/becomeProfessional.php" class="btn-full">Tornar-se Profissional</a>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>