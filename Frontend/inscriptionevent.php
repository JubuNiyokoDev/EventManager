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
    if (empty($row)) {
        if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["ddn"])) {
            if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['ddn']) || empty($_POST['adresse'])) {
                echo "Tous les champs sont obligatoires";
            } else {
                $query = "INSERT INTO participants (nom,prenom,adresse,ddn,iduser) VALUES (:nom,:prenom,:adresse,:ddn,:iduser)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":nom", $_POST['nom']);
                $stmt->bindParam(":prenom", $_POST['prenom']);
                $stmt->bindParam(":adresse", $_POST['adresse']);
                $stmt->bindParam(":ddn", $_POST['ddn']);
                $stmt->bindParam(":iduser", $iduser);
                if ($stmt->execute()) {
                    $q = "SELECT * FROM participants WHERE iduser=$iduser";
                    $stmt = $pdo->prepare($q);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $query = "INSERT INTO inscriptions (idpart,idevent) VALUES (:idpart,:idevent)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":idpart", $row['idpart']);
                        $stmt->bindParam(":idevent", $idevent);
                        $stmt->execute();
                        header("Location:../DB/allevent.php");
                    }
                } else {
                    echo "Enregistrement avec erreur";
                }
            }
        }
    } else {
        $idpart = $row["idpart"];
        $q = "SELECT * FROM inscriptions WHERE idpart=$idpart AND idevent=$idevent LIMIT 1";
        $stmt_finished = $pdo->prepare($q);
        $stmt_finished->execute();
        $row_finished = $stmt_finished->fetch(PDO::FETCH_ASSOC);
        if (empty($row_finished)) {
            $query = "INSERT INTO inscriptions (idpart,idevent) VALUES (:idpart,:idevent)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":idpart", $row['idpart']);
            $stmt->bindParam(":idevent", $idevent);
            $stmt->execute();
            header("Location:../DB/allevent.php");
        } else {
            header("Location:../DB/allevent.php");
            echo "Vous etes deja isncrit dans cet evenement";
        }
    }
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page D'Enregistrement</title>
</head>

<body>
    <main>
        <div class="home">
            <div class="left-div">
                <div class="container-full">
                    <div class="header-form">
                        <ul class="list-social">
                            <li class="list">Facebook</li>
                            <li class="list">Github</li>
                            <li class="list">Twiiter</li>
                            <li class="list">Whatsapp</li>
                            <li class="list">Youtube</li>
                        </ul>
                    </div>
                    <form action="" method="post" class="form inscription">
                        <input type="text" name="nom" required placeholder="Entrer votre nom">
                        <input type="text" name="prenom" required placeholder="Entrer votre prenom">
                        <input type="date" name="ddn" required>
                        <input type="text" name="adresse" required placeholder="Entre votre Adresse">
                        <input type="submit" value="Reserver une Place">
                    </form>
                </div>
            </div>
            <div class='right-div'>
                <ul>
                    <li><a href=''>Voir Tous Les Evenement</a></li>
                </ul>
            </div>
    </main>

</body>

</html>