<?php
include_once("../DB/base.php");
include_once("../DB/connection.php");
if (isset($_GET['iduser']) && isset($_GET['idevent'])) {
    $iduser = $_GET['iduser'];
    $idevent = $_GET['idevent'];
    $q = "SELECT * FROM participants WHERE iduser=$iduser LIMIT 1";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $idpart = $row["idpart"];
    $q = "DELETE FROM inscriptions WHERE idpart=$idpart AND idevent=$idevent LIMIT 1";
    $stmt_finished = $pdo->prepare($q);
    if ($stmt_finished->execute()) {
        header("Location:../DB/allevent.php?msg=Vous avez desabonner l'evenement avec succes");
    } else {
        header("Location:../DB/allevent.php?msg=Desole Vous n'avez pas desabonner l'evenement");
    }
}
