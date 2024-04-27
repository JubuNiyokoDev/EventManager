<?php
include_once("../DB/base.php");
include_once("../DB/connection.php");

$id = $_GET['id'];



$sql = "DELETE  FROM evenements WHERE idevent=$id";


$stmt = $pdo->prepare($sql);


if ($stmt->execute()) {
    header("Location:../DB/allevent.php?msg=Evenement supprime avec succes");
}
else{
    header("Location:../DB/allevent.php?msg=Evenement supprime avec erreur");
}
?>
