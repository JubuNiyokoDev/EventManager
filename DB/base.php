<?php 
include_once("../DB/connection.php");
session_start();
if (isset($_SESSION["loggedin"]) && isset($_SESSION['email']) && isset($_SESSION['iduser']) && isset($_SESSION['droit'])) {
    $email = $_SESSION['email'];
    $droit = $_SESSION['droit'];
}
if (isset($_GET['msg'])) {
    $msg = $_GET["msg"];
    echo $msg;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/style.css">
</head>
<body>
    <header>
        <nav>
            <h3>Welcome <?php if(isset($_SESSION['email']) && isset($_SESSION['droit'])) { echo $email." Comme ",$droit;} ?> </h3>
            <?php if(isset($_SESSION["loggedin"]) && isset($_SESSION['email']) && isset($_SESSION['iduser']) && isset($_SESSION['droit'])){echo "<a class='logout' href='../DB/logout.php'>Se Deconnecter</a>";}  ?>
        </nav>
    </header>
</body>
</html>