<?php
include_once("base.php");
include_once("../DB/connection.php");

if (isset($_SESSION["loggedin"])) {
    $loggedin = $_SESSION['loggedin'];
    if ($loggedin == true) {
        header("Location:allevent.php");
    }
} else {
    if (isset($_POST["email"]) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $q = "SELECT * FROM users WHERE email='$email'";
        $stmt = $pdo->prepare($q);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($row)) {
            echo "Email n'existe pas";
        } else {
            $_SESSION['email'] = $row['email'];
            $password_hashed = $row['password'];
            $_SESSION["loggedin"] = true;
            $_SESSION["iduser"] = $row['iduser'];
            $_SESSION["droit"] = $row['droit'];
            if (password_verify($password, $password_hashed)) {
                header("Location:allevent.php");
            } else {
                $password = $_POST['password'];
                $password_hashed = $row['password'];
                echo "<br>" . $password . " " . "entered<br>";
                echo $password_hashed . " " . "from db<br>";
                echo "mot de passe incorrect";
            }
        }
    } 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page De Se Connecter</title>

</head>

<body>
    <main>
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
            <form action="" method="post" class="form">
                <input type="email" name="email" required placeholder="Entrer votre email">
                <input type="password" name="password" required placeholder="Entre votre password">
                <input type="submit" value="Login">
            </form>
            <div class="footer-form">
                <a href="signup.php"><span>Pas encore un compte ?<small>&nbsp; S'Inscrire</small> </span></a>
            </div>
        </div>

    </main>

</body>

</html>