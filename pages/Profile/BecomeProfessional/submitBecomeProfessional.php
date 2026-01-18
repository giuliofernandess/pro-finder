<?php

$email = $_POST['email'];
$category = $_POST['category'];
$profession = $_POST['profession'];
$neighborhood = $_POST['neighborhood'];
$address = $_POST['address'];
$availability = $_POST['availability'];
$link = $_POST['link'];
$biography = $_POST['biography'];

require_once '../../../general_features/bdConnect.php';

$sql = "INSERT INTO `professional` (`category`, `profession`, `neighborhood`, `address`, `availability`, `link`, `biography`) 
        VALUES ('$category', '$profession', '$neighborhood', '$address', '$availability', '$link', '$biography')";
$connect->query($sql);

$id_professional = $connect->insert_id;

$sql = "
    UPDATE accounts a
    JOIN professional p ON p.id_professional = '$id_professional'
    SET a.user_or_prof = '1', a.id_professional = p.id_professional
    WHERE a.email = '$email'
";

$result = $connect->query($sql);

if ($result) {
    echo "<script type ='text/javascript'>
        alert('Parabéns! Você agora é um profissional Pro Finder.');
        </script>";
    echo "<meta http-equiv='refresh' content='0; url=../profile.php'>";
} else {
    echo "Erro ao atualizar: " . $connect->error;
}

?>
