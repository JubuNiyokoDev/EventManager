<?php
include_once("../DB/base.php");
include_once("../DB/connection.php");
$id = $_GET["id"];
if (isset($_POST["intitule"]) && isset($_POST["datevent"]) && isset($_POST["heuredebut"]) && isset($_POST["heurefin"]) && isset($_POST["lieu"])) {

    if (empty($_POST['intitule']) || empty($_POST['datevent']) || empty($_POST['heuredebut']) || empty($_POST['heurefin']) || empty($_POST['lieu'])) {
        echo "Tous les champs sont obligatoires";
    } else {

        $heuredebut = $_POST['heuredebut'];
        $intitule = $_POST['intitule'];
        $datevent = $_POST['datevent'];
        $heurefin = $_POST['heurefin'];
        $lieu = $_POST['lieu'];


        $sql = "UPDATE evenements SET intitule=:intitule, datevent=:datevent, heuredebut=:heuredebut,heurefin=:heurefin,lieu=:lieu WHERE idevent=$id";
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the values to the placeholders
        $stmt->bindParam(':intitule', $intitule);
        $stmt->bindParam(':datevent', $datevent);
        $stmt->bindParam(':heuredebut', $heuredebut);
        $stmt->bindParam(':heurefin', $heurefin);
        $stmt->bindParam(':lieu', $lieu);
        if ($stmt->execute()) {
            header("Location:allevent.php?msg=Evenement Modifie avec succes");
        }
    }
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/style.css">
    <title>Modifier Evenement</title>
</head>

<body>
    <main>
        <?php
        $id = $_GET["id"];
        $sql = "SELECT * FROM evenements WHERE idevent=$id";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Execute the statement
        $stmt->execute();


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $intitule = $row["intitule"];
            $lieu = $row["lieu"];
            $datevent = $row["datevent"];
            $heuredebut = $row["heuredebut"];
            $heurefin = $row["heurefin"];
        }

        ?>
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
                        <input type="text" name="intitule" value="<?php echo $intitule ?>">
                        <input type="text" name="lieu" value="<?php echo $lieu ?>">
                        <input type="date" name="datevent" value="<?php echo $datevent ?>">
                        <input type="time" name="heuredebut" value="<?php echo $heuredebut ?>">
                        <input type="time" name="heurefin" value="<?php echo $heurefin ?>">
                        <input type="submit" value="Modifier">
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

    </main>

</body>

</html>