<?php
include_once("../DB/base.php");

if (isset($_POST["commentaire"]) && isset($_SESSION['iduser']) && isset($_SESSION['idevent'])) {
    $idevent = $_SESSION['idevent'];
    $iduser = $_SESSION['iduser'];
    if (!empty($_POST['commentaire'])) {
        $commentaire = $_POST['commentaire'];
        $q = "INSERT INTO comments(comment,idevent,iduser) VALUES(:comment,:idevent,:iduser)";
        $stmt = $pdo->prepare($q);
        $stmt->bindParam("iduser", $iduser);
        $stmt->bindParam("comment", $commentaire);
        $stmt->bindParam("idevent", $idevent);

        if ($stmt->execute()) {
            header("Location:eventdetail.php?id=$idevent&msg=Commentaire ajoute avec succes");
        } else {
            header("Location:eventdetail.php?id=$idevent&msg=Impossible d'ajoute un commentaire");
        }
    } else {
        header("Location:eventdetail.php?id=$idevent&msg=Le champ de commentaire est obligatoire");
        
    }
} 
