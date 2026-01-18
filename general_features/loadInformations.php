<?php
require_once 'bdConnect.php';

if (isset($_POST["type"])) {
    if ($_POST["type"] == "states") {
        $sql = "
                SELECT * FROM state
                ORDER BY uf ASC
                ";
        $states = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_array($states)) {
            $saida[] = array(
                'id' => $row["id"],
                'name' => $row["uf"] . " - " . $row["name"]
            );
        }
        echo json_encode($saida);
    } else {
        $cat_id = $_POST["cat_id"];
        $sql = "
                SELECT * FROM city 
                WHERE state = '" . $cat_id . "' 
                ORDER BY name ASC
                ";
        $cities = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_array($cities)) {
            $saida[] = array(
                'id' => $row["id"],
                'name' => $row["name"]
            );
        }
        echo json_encode($saida);
    }
}
?>
