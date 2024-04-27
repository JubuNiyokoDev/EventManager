<?php
include_once("../DB/base.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oui ou Non</title>
</head>

<body>
    <main>


        <?php
        if (isset($_GET['idevent']) && isset($_GET['iduser'])) {
            $myidevent = $_GET['idevent'];
            $myiduser = $_GET['iduser'];
            $myurl = $_GET['url'];
            echo "<div class='container-popup' id='container-popup'><div class='popup-delete'><h3 >Vous voulez vraiment Quiter cet evenemet?</h3><a href='desinscriptionevent.php?iduser=" . $myiduser."&idevent=".$myidevent."' name='yes'>Oui</a><a href='".$myurl."' name='non'> Non</a></div</div>";
        } 


        ?>
    </main>


</body>

</html>