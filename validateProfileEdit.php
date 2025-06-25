<?php

// Dados do formulário
$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$state = $_POST['states'];
$city = $_POST['cities'];
$category = $_POST['category'];
$profession = $_POST['profession'];
$neighborhood = $_POST['neighborhood'];
$address = $_POST['address'];
$availability = $_POST['availability'];
$link = $_POST['link'];
$biography = $_POST['biography'];
$id_professional = $_POST['id_professional'];

$connect = mysqli_connect('localhost', 'root', '', 'pro-finder') or die('Erro de conexão: ' . mysqli_connect_error());

// Verifica se a imagem foi enviada corretamente
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Gera nome único para evitar conflitos
    $newFileName = uniqid('profile_', true) . '.' . $fileExtension;

    $uploadFileDir = 'images/profile-images/';
    $destPath = $uploadFileDir . $newFileName;

    // Move o arquivo para a pasta
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // Atualiza com imagem
        $sql = "UPDATE `accounts` SET `name`='$name', `telephone`='$telephone', `profile_image`='$newFileName' WHERE `email`='$email'";
    } else {
        die('Erro ao mover a imagem para o diretório.');
    }
} else {
    // Atualiza sem imagem
    $sql = "UPDATE `accounts` SET `name`='$name', `telephone`='$telephone' WHERE `email`='$email'";
}

$result = $connect->query($sql);

if (!empty($state)) {
    $connect->query("UPDATE `accounts` SET `state`='$state' WHERE `email`='$email'");
} 

if (!empty($city)) {
    $connect->query("UPDATE `accounts` SET `city`='$city' WHERE `email`='$email'");
}

// Atualiza tabela `professional`
if (empty($biography)) {
    $sql = "UPDATE `professional` SET `category`='$category', `profession`='$profession', `neighborhood`='$neighborhood', `address`='$address', `availability`='$availability', `link`='$link' WHERE `id_professional` = '$id_professional'";

    $result = $connect->query($sql);

    echo "<script type ='text/javascript'>
    alert('Seus dados foram editados!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=profile.php'>";
} else {
    $sql = "UPDATE `professional` SET `category`='$category', `profession`='$profession', `neighborhood`='$neighborhood', `address`='$address', `availability`='$availability', `link`='$link', `biography`='$biography' WHERE `id_professional` = '$id_professional'";

    $result = $connect->query($sql);

    echo "<script type ='text/javascript'>
    alert('Seus dados foram editados!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=profile.php'>";
}

?>
