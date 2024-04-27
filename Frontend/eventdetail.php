<?php
include_once("../DB/base.php");
include_once("../DB/connection.php");




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail de l'Evenement</title>
</head>

<body>
    <main>
        <?php
        $id = $_GET["id"];
        $sql = "SELECT * FROM evenements WHERE idevent=$id LIMIT 1";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Execute the statement
        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $intitule = $row["intitule"];
        $lieu = $row["lieu"];
        $datevent = $row["datevent"];
        $heuredebut = $row["heuredebut"];
        $heurefin = $row["heurefin"];
        $_SESSION['idevent'] = $row['idevent'];
        $idevent = $row['idevent'];
        $q = "SELECT COUNT(*) AS npart FROM inscriptions WHERE idevent=$idevent";
        $mystmt = $pdo->prepare($q);
        $mystmt->execute();
        $rowget = $mystmt->fetch(PDO::FETCH_ASSOC);



        ?>
        <div class="home">
            <div class="left-div">
                <div class="container-full">
                    <div class="container-detail">
                        <div class='title'>
                            <a href="eventdetail.php?id=<?php echo $id ?>">
                                <h1><?php echo $intitule ?></h1>
                            </a>
                        </div>
                        <div class="image-div">
                            <div class='image'><a href="eventdetail.php?id=<?php echo $id ?>"><img src='../Uploads/IMG_1932.jpg' alt=''></a></div>
                            <div class='image'><a href="eventdetail.php?id=<?php echo $id ?>"><img src='../Uploads/IMG_1932.jpg' alt=''></a></div>
                            <div class='image'><a href="eventdetail.php?id=<?php echo $id ?>"><img src='../Uploads/IMG_1932.jpg' alt=''></a></div>
                            <div class='image'><a href="eventdetail.php?id=<?php echo $id ?>"><img src='../Uploads/IMG_1932.jpg' alt=''></a></div>
                        </div>
                        <div class="lieu-time">
                            <p><strong>Adresse : </strong><small><?php echo $lieu ?></small></p>
                            <p><strong>Heure Debut : </strong><small><?php echo $heuredebut ?></small></p>
                            <p><strong>Heure Fin : </strong><small><?php echo $heurefin ?></small></p>
                            <p><strong>Date D'Evenement : </strong><small><?php echo $datevent ?></small></p>
                            <p><strong>Participants Total : </strong><small><?php echo $rowget['npart'] ?></small></p>
                        </div>
                        <div class="commentaire">
                            <form method="post" action="commentevent.php">
                                <textarea name="commentaire" id="commentaire"></textarea>
                                <input type="submit" class='deleteButton comment' value="Commenter">
                            </form>
                        </div>


                    </div>
                </div>
            </div>
            <div class='right-div'>
                <ul>
                    <li><a href='../DB/allevent.php'>Voir Tous Les Evenement</a></li>
                </ul>
            </div>

    </main>

</body>

</html>