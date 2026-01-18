<?php

/* Captação de variáveis, conexão e comando sql */
$email = $_POST['email'];
$password = $_POST['password'];

require_once '../../general_features/bdConnect.php';

$sql = "SELECT * FROM `accounts` WHERE `email` = '$email' and `password` = '$password'";

$result = $connect->query($sql);

/* Tratamento de erros */
if (mysqli_num_rows($result) > 0) {
    session_start();

    $res = $result->fetch_array();
    $_SESSION['name'] = $res['name'];
    $_SESSION['email'] = $res['email'];
    $_SESSION['telephone'] = $res['telephone'];
    $_SESSION['state'] = $res['state'];
    $_SESSION['city'] = $res['city'];
    $_SESSION['profile_image'] = $res['profile_image'];
    $_SESSION['id_professional'] = $res['id_professional'];

    echo "<script type ='text/javascript'>
    alert('Login efetuado!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=../index.php'>";

} else {
    echo "<script type ='text/javascript'>
    alert('[ERRO] Usuário não encontrado!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}

?>
