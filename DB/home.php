<?php
include_once("../DB/base.php");
include_once("../DB/connection.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <main>
        <div class="home">
            <div class="left-div">
                <?php
                $sql = "SELECT * FROM evenements";

                // Prepare the statement
                $stmt = $pdo->prepare($sql);

                // Execute the statement
                $stmt->execute();
                // Fetch and echo all rows
                echo "<div class='all-event' id='all-event'>";
                if (isset($_SESSION["loggedin"]) && isset($_SESSION['email']) && isset($_SESSION['iduser']) && isset($_SESSION['droit'])) {
                    if (($_SESSION['droit']) == 'Admin') {
                        $rowAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($rowAll !== null) {
                            for ($i = 0; $i < count($rowAll); $i++) {
                                $row = $rowAll[$i];
                                echo "<div class='event'><div class='title'><a href='../Backend/eventdetail.php?id=" . $row['idevent'] . "'><h1>" . $row['intitule'] . "</h1></a></div><div class='image'><a href='../Frontend/eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1960.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1992.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a></div><div class='content'><p><strong>Adresse</strong> : " . $row['lieu'] . "</p><br><p><strong>Heure Debut</strong> : " . $row['heuredebut'] . "</p></div><div class='button'><a href=../Backend/eventupdate.php?id=" . $row['idevent'] . ">Editer</a><button class='deleteButton' onclick='confirmDelete(" . $row['idevent'] . ")'>Supprimer</button></div></div>";
                            }
                            echo "</div>";
                            echo "<div class='container-popup hidden' id='container-popup'><div class='popup-delete'><h3 >Vous voulez vraiment supprimer cet evenemet?</h3><a href='' name='yes'>Oui</a><a href='allevent.php' name='non'> Non</a></div</div></div>";
                            echo "</div></div><div class='right-div'><ul><li><a href='../Backend/eventcreate.php'>Creer Un Evenement</a></li><li><a href=''>Creer Des Images</a></li><li><a href=''>Voir Tous Les Evenement</a></li></ul</div>";
                        } else {
                            echo "Pas d'evenements disponible";
                            echo "</div>";
                            echo "<div class='container-popup hidden' id='container-popup'><div class='popup-delete'><h3 >Vous voulez vraiment supprimer cet evenemet?</h3><a href='' name='yes'>Oui</a><a href='allevent.php' name='non'> Non</a></div</div></div>";
                            echo "</div></div><div class='right-div'><ul><li><a href='../Backend/eventcreate.php'>Creer Un Evenement</a></li><li><a href=''>Creer Des Images</a></li><li><a href=''>Voir Tous Les Evenement</a></li></ul</div>";
                        }
                    } else {
                        $rowAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($rowAll !== null) {
                            $iduser = $_SESSION['iduser'];
                            $q = "SELECT * FROM participants WHERE iduser=$iduser LIMIT 1";
                            $stmt_participant = $pdo->prepare($q);
                            $stmt_participant->execute();
                            $row_participant = $stmt_participant->fetch(PDO::FETCH_ASSOC);
                            if (!empty($row_participant)) {
                                for ($i = 0; $i < count($rowAll); $i++) {
                                    $row = $rowAll[$i];
                                    $idevent = $row['idevent'];
                                    $idpart = $row_participant['idpart'];
                                    $q_inscription = "SELECT * FROM inscriptions WHERE idpart=$idpart AND idevent=$idevent LIMIT 1";
                                    $stmt_finished = $pdo->prepare($q_inscription);
                                    $stmt_finished->execute();
                                    $row_finished = $stmt_finished->fetch(PDO::FETCH_ASSOC);
                                    if (empty($row_finished)) {
                                        echo "<div class='event'><div class='title'><a href='../Frontend/eventdetail.php?id=" . $row['idevent'] . "'><h1>" . $row['intitule'] . "</h1></a></div><div class='image'><a href='../Frontend/eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1960.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a></div><div class='content'><p><strong>Adresse</strong> : " . $row['lieu'] . "</p><br><p><strong>Heure Debut</strong> : " . $row['heuredebut'] . "</p><p><strong>Heure Debut</strong> : " . $row['heurefin'] . "</p></div><div class='button'><a href=../Frontend/inscriptionevent.php?idevent=" . $row['idevent'] . "&iduser=" . $_SESSION['iduser'] . ">S'inscrirer</a></div></div>";
                                    } else {
                                        echo "<div class='event'><div class='title'><a href='../Frontend/eventdetail.php?id=" . $row['idevent'] . "'><h1>" . $row['intitule'] . "</h1></a></div><div class='image'><a href='../Frontend/eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a></div><div class='content'><p><strong>Adresse</strong> : " . $row['lieu'] . "</p><br><p><strong>Heure Debut</strong> : " . $row['heuredebut'] . "</p><p><strong>Heure Debut</strong> : " . $row['heurefin'] . "</p></div><div class='button rejoindre'><a href=../Frontend/inscriptionevent.php?idevent=" . $row['idevent'] . "&iduser=" . $_SESSION['iduser'] . ">Rejoindre</a><button class='deleteButton' onclick='confirmQuit(" . $row['idevent'] . "," . $_SESSION['iduser'] . ")'>Quiter</button></div></div>";
                                    }
                                }
                                echo "</div>";
                                echo "<div class='container-popup hidden' id='container-popup'><div class='popup-delete'><h3 >Vous voulez vraiment supprimer cet evenemet?</h3><a href='' name='yes'>Oui</a><a href='allevent.php' name='non'> Non</a></div</div></div>";
                                echo "</div></div><div class='right-div'><ul><li><a href=''>Voir Tous Les Evenement</a></li></ul</div>";
                            } else {
                                for ($i = 0; $i < count($rowAll); $i++) {
                                    $row = $rowAll[$i];
                                    echo "<div class='event'><div class='title'><a href='../Frontend/eventdetail.php?id=" . $row['idevent'] . "'><h1>" . $row['intitule'] . "</h1></a></div><div class='image'><a href='../Frontend/eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1960.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a><a href='eventdetail.php?id=" . $row['idevent'] . "'><img src='../Uploads/IMG_1932.jpg' alt=''></a></div><div class='content'><p><strong>Adresse</strong> : " . $row['lieu'] . "</p><br><p><strong>Heure Debut</strong> : " . $row['heuredebut'] . "</p><p><strong>Heure Debut</strong> : " . $row['heurefin'] . "</p></div><div class='button'><a href=../Frontend/inscriptionevent.php?idevent=" . $row['idevent'] . "&iduser=" . $_SESSION['iduser'] . ">S'inscrirer</a></div></div>";
                                }
                                echo "</div>";
                                echo "<div class='container-popup hidden' id='container-popup'><div class='popup-delete'><h3 >Vous voulez vraiment supprimer cet evenemet?</h3><a href='' name='yes'>Oui</a><a href='allevent.php' name='non'> Non</a></div</div></div>";
                                echo "</div></div><div class='right-div'><ul><li><a href=''>Voir Tous Les Evenement</a></li></ul</div>";
                            }
                        } else {
                            echo "Pas d'evenements disponible";
                            echo "</div>";
                            echo "<div class='container-popup hidden' id='container-popup'><div class='popup-delete'><h3 >Vous voulez vraiment supprimer cet evenemet?</h3><a href='' name='yes'>Oui</a><a href='allevent.php' name='non'> Non</a></div</div></div>";
                            echo "</div></div><div class='right-div'><ul><li><a href=''>Voir Tous Les Evenement</a></li></ul</div>";
                        }
                    }
                } else {
                    header("Location:login.php");
                }

                ?>
                <script>
                    function confirmDelete(id) {
                        const val = id;
                        console.log(val);
                        window.location.href = "../Backend/askdelete.php?id=" + encodeURIComponent(id) + "&url=../DB/allevent.php";

                    }

                    function cancelDelete() {
                        window.history.back();
                    }

                    function confirmQuit(id1, id2) {
                        const idevent = id1;
                        const iduser = id2;
                        window.location.href = "../Frontend/askquit.php?idevent=" + encodeURIComponent(idevent) + "&iduser=" + encodeURIComponent(iduser) + "&url=../DB/allevent.php";

                    }

                    function cancelQuit() {
                        window.history.back();
                    }
                </script>
            </div>
        </div>
    </main>

</body>

</html>