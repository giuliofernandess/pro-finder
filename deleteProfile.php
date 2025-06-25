<?php

session_start();

session_unset();

session_destroy();

$connect = mysqli_connect('localhost', 'root', '', 'pro-finder') or die('Erro de conexão: '. mysqli_connect_error());

$id_professional = $_POST['id_professional'];

$connect->query("DELETE FROM `accounts` WHERE `id_professional` = '$id_professional'");
$connect->query("DELETE FROM `professional` WHERE `id_professional` = '$id_professional'");

echo "<script>alert('Perfil excluído com sucesso!');</script>";

echo "<meta http-equiv='refresh' content='0; url=index.php'>";

?>
