<?php
include_once("../DB/base.php");
include_once("../DB/connection.php");
if (isset($_SESSION["loggedin"]) && isset($_SESSION['email']) && isset($_SESSION['iduser']) && isset($_SESSION['droit'])) {
    $loggedin = $_SESSION['loggedin'];
    if ($loggedin == true) {
        if (($_SESSION['droit']) == 'Admin') {

            if (isset($_POST["intitule"]) && isset($_POST["datevent"]) && isset($_POST["heuredebut"]) && isset($_POST["heurefin"]) && isset($_POST["lieu"])) {

                if (empty($_POST['intitule']) || empty($_POST['datevent']) || empty($_POST['heuredebut']) || empty($_POST['heurefin']) || empty($_POST['lieu'])) {
                    echo "Tous les champs sont obligatoires";
                } else {
                    $currentDate = new DateTime(); // Current date
                    $heuredebut = $_POST['heuredebut'];
                    $intitule = $_POST['intitule'];
                    $datevent = $_POST['datevent'];
                    $heurefin = $_POST['heurefin'];
                    $lieu = $_POST['lieu'];

                    $dateget = date("Y-m-d", strtotime($datevent));



                    // Compare the dates
                    if ($dateget > $currentDate) {
                        echo "Desole la date d'evenement doit etre superieur ou egal a la date d'aujourd'hui";
                    } else {
                        $sql = "INSERT INTO evenements (intitule, datevent, heuredebut,heurefin,lieu) VALUES (:intitule, :datevent, :heuredebut,:heurefin,:lieu)";
                        // Prepare the statement
                        $stmt = $pdo->prepare($sql);

                        // Bind the values to the placeholders
                        $stmt->bindParam(':intitule', $intitule);
                        $stmt->bindParam(':datevent', $datevent);
                        $stmt->bindParam(':heuredebut', $heuredebut);
                        $stmt->bindParam(':heurefin', $heurefin);
                        $stmt->bindParam(':lieu', $lieu);

                        if ($stmt->execute()) {
                            header("Location:../DB/allevent.php?msg=Evenement Cree avec succes");
                        }
                    }
                }
            }
        } else {
            header("Location:../DB/allevent.php");
        }
    } else {
    }
} else {
    header("Location:../DB/login.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/style.css">
    <title>Creer Evenement</title>
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
                    <form action="" class="form eventcreate" method="post">
                        <input type="text" name="intitule" placeholder="Entrer L'intitule de l'evenement">
                        <input type="text" name="lieu" placeholder="Entrer lieu de l'evenement">
                        <input type="date" name="datevent">
                        <input type="time" name="heuredebut">
                        <input type="time" name="heurefin">
                        <input type="submit" value="Creer">
                    </form>
                </div>
            </div>
            <div class='right-div'>
                <ul>
                    <li><a href='../Backend/eventcreate.php'>Creer Un Evenement</a></li>
                    <li><a href=''>Creer Des Images</a></li>
                    <li><a href=''>Voir Tous Les Evenement</a></li>
                </ul>
            </div>
        </div>
    </main>

</body>

</html>