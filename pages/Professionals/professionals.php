<?php

session_start();

require_once '../../general_features/bdConnect.php';

$conditions = [];

if (!empty($_POST['profession'])) {
    $profession = $_POST['profession'];
    $conditions[] = "profession LIKE '%$profession%'";
}
if (!empty($_POST['category'])) {
    $category = $_POST['category'];
    $conditions[] = "professional.category = '$category'";
}
if (!empty($_POST['city'])) {
    $city = $_POST['city'];
    $conditions[] = "accounts.city = (SELECT id FROM city WHERE name = '$city')";
}

$sql = "SELECT professional.profession, accounts.name, accounts.profile_image, professional.id_professional 
        FROM professional 
        INNER JOIN accounts ON professional.id_professional = accounts.id_professional";

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " LIMIT 4";

$result = $connect->query($sql);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profissionais - Pro Finder</title>
  <link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../../css/professionals.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

  <!-- header -->
  <div class="header">
      <a href="../index.php"><img src="../../images/logo.png" alt="ProFinder Logo" class="header-logo mb-2"></a>
      <h2 class="header-title">Buscar Profissionais</h2>
  </div>

  <!-- area de pesquisa -->
  <main>
    <div class="search-area">
      <form class="row g-3 align-items-end justify-content-center" method="post" action="professionals.php">

        <div class="col-12 col-md-3">
          <label for="category" class="form-label">Categoria</label>
          <select name="category" id="category" class="form-control">
            <option value=""></option>
            <option value="Saúde">Saúde</option>
            <option value="Tecnologia">Tecnologia</option>
            <option value="Jurídico">Jurídico</option>
            <option value="Design">Design</option>
            <option value="Educação">Educação</option>
            <option value="Construção">Construção</option>
          </select>
        </div>

        <div class="col-12 col-md-3">
          <label for="profession" class="form-label">Profissão</label>
          <input type="text" name="profession" class="form-control" id="profession" placeholder="Ex: Psicólogo">
        </div>

        <div class="col-12 col-md-3">
          <label for="city" class="form-label">Cidade</label>
          <input type="text" name="city" class="form-control" id="city" placeholder="Ex: São Paulo">
        </div>

        <div class="col-12 col-md-3 d-grid">
          <button type="submit" class="btn btn-light btnSearchProfessional">Buscar</button>
        </div>

      </form>
    </div>

    <!-- Cards -->
    <div class="cards-container py-4">
      <div class="row g-3">
                <?php
                    
                    while ($res = $result -> fetch_array()) {
                
                      $id_professional = $res['id_professional'];
                ?>
                    <div class="col-12">
                        <form method="post" action="professionalProfile.php" class="card card-custom p-3 d-flex flex-row align-items-center">
                            <?php if (empty($res['profile_image'])): ?>
                                <img src="../../images/anonymous-user.jpg" alt="Foto de Perfil" class="profile-img me-3">
                            <?php else: ?>
                                <img src="../../images/profile-images/<?php echo $res['profile_image'] ?>" alt="img" class="profile-img me-3">
                            <?php endif; ?>
                            <div class="flex-grow-1">
                                <input type="hidden" name="id_professional" value="<?php echo $id_professional ?>">
                                <strong><?php echo $res['name'] ?></strong><br>
                                <div class="city"><?php 
                              
                                $sql = "SELECT `name` FROM `city` WHERE `id` = (SELECT `city` FROM `accounts` WHERE `id_professional` = $id_professional)";

                                echo $connect->query($sql)->fetch_array()['name'];
                                ?></div>
                                <small><?php echo $res['profession'] ?></small>
                            </div>
                                <?php 
                                
                                if (isset($_SESSION['email'])) { ?>
                                     <button class="btn btnSeeProfile">Ver Perfil</button>
                                <?php } else { ?>
                                     <a href="../Login/login.php" class="btn btnSeeProfile">Ver Perfil</a>
                                <?php } ?>
                                 
                        </form>
                    </div>
                <?php } ?>
            </div>
    </div>
  </main>

  <!-- Footer -->
  <?php require_once '../../general_features/footer.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
        </script>
</body>

</html>