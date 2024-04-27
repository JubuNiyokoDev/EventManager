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
        if (isset($_GET['id'])) {
            $myid = $_GET['id'];
            $myurl = $_GET['url'];
            echo "<div class='container-popup' id='container-popup'><div class='popup-delete'><h3 >Vous voulez vraiment supprimer cet evenemet?</h3><a href='eventdelete.php?id=" . $myid ."' name='yes'>Oui</a><a href='".$myurl."' name='non'> Non</a></div</div>";
        } 


        ?>
    </main>


</body>

</html>
