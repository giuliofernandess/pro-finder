<?php

/* Verificação de datas */
function more18Years($dateOfBirth) {
    $birth = new DateTime($dateOfBirth);
    $today = new DateTime();

    $age = $today -> diff($birth) -> y;

    return $age;
}

function ageVerification($dateOfBirth) {
    $year = date('Y');

    $yearDateOfBirth = date('Y', strtotime($dateOfBirth));

    if ($yearDateOfBirth >= $year) {
        return FALSE;
    } else {
        return TRUE;
    }

}

/* Captação de variáveis, conexão e comando sql */
$name = $_POST['name'];
$email = $_POST['email'];
$dateOfBirth = $_POST['dateOfBirth'];
$telephone = $_POST['telephone'];
$state = $_POST['states'];
$city = $_POST['cities'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

require_once '../../general_features/bdConnect.php';

$sql = "SELECT * FROM `accounts` WHERE `email` = '$email'";

$result = $connect->query($sql);

/* Tratamento de erros */
if (mysqli_num_rows($result) > 0) {
    echo "<script type ='text/javascript'>
    alert('[ERRO] Email já cadastrado!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=register.php'>";

} elseif ($password != $confirmPassword) {
    echo "<script type ='text/javascript'>
    alert('[ERRO] Senhas não conferem!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=register.php'>";
    
} elseif(ageVerification($dateOfBirth) == FALSE) {
    echo "<script type ='text/javascript'>
    alert('[ERRO] Data inválida!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=register.php'>";

} elseif (more18Years($dateOfBirth) < 18) {
    echo "<script type ='text/javascript'>
    alert('[ERRO] Não permitimos menores de idade!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=register.php'>";
} else {
    $sql = "INSERT INTO `accounts`(`name`, `email`, `date_of_birth`, `telephone`, `state`, `city`, `password`, `profile_image`, `user_or_prof`) VALUES ('$name','$email','$dateOfBirth', '$telephone', '$state', '$city', '$password', '', '0')";
    
    $result = $connect->query($sql);

    echo "<script type ='text/javascript'>
    alert('Seus dados foram cadastrados!');
    </script>";

    echo "<meta http-equiv='refresh' content='0; url=../Login/login.php'>";
}

?>
