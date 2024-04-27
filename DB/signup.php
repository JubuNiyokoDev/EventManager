<?php
include_once("base.php");
include_once("../DB/connection.php");
$q = "SHOW COLUMNS FROM users LIKE 'droit'";
$stmt = $pdo->prepare($q);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$enum_str = $row["Type"];
preg_match("/^enum\((.*)\)$/", $enum_str, $matches);
$enum_values = explode(",", str_replace("'", "", $matches[1]));
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["passwordc"]) && isset($_POST["droit"])) {
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['passwordc']) || empty($_POST['droit'])) {
        echo "Tous les champs sont obligatoires";
    } else {
        $password  = $_POST['password'];
        $passwordc = $_POST['passwordc'];
        $droit = $_POST['droit'];
        if ($password !== $passwordc) {
            echo "Password must match";
        } else {
            if (($_POST['droit']) === 'Admin') {
                $q = "SELECT * FROM users WHERE droit='Admin'";
                $stmt = $pdo->prepare($q);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($row)) {
                    $email = $_POST['email'];
                    $q = "SELECT * FROM users WHERE email='$email'";
                    $stmt = $pdo->prepare($q);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (empty($row)) {
                        $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $query = "INSERT INTO users (email,password,droit) VALUES (:email,:password,:droit)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":email", $_POST['email']);
                        $stmt->bindParam(":password", $password_hashed);
                        $stmt->bindParam(":droit", $droit);
                        if ($stmt->execute()) {
                            header("Location:login.php?msg=Enregistrement avec succes");
                        } else {
                            echo "Enregistrement avec erreur";
                        }
                    } else {
                        echo "Utilisateur avec cet email existe deja";
                    }
                } else {
                    echo "Desole tu ne peux pas etre un admin de cette site car admin axiste deja";
                }
            } else {
                $email = $_POST['email'];
                $q = "SELECT * FROM users WHERE email='$email'";
                $stmt = $pdo->prepare($q);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($row)) {
                    $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (email,password,droit) VALUES (:email,:password,:droit)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(":email", $_POST['email']);
                    $stmt->bindParam(":password", $password_hashed);
                    $stmt->bindParam(":droit", $droit);
                    if ($stmt->execute()) {
                        header("Location:login.php?msg=Enregistrement avec succes");
                    } else {
                        echo "Enregistrement avec erreur";
                    }
                } else {
                    echo "Utilisateur avec cet email existe deja";
                }
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
    <title>Page D'Enregistrement</title>
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
            <form action="" method="post" class="form register">
                <input type="email" name="email" required placeholder="Entrer votre email">
                <input type="password" name="password" required placeholder="Entre votre password">
                <input type="password" name="passwordc" required placeholder="Entre votre password Confirmation"><br>
                <select name="droit" id="" class="droit">
                    <?php
                    foreach ($enum_values as $value) {
                        echo "<option value='" . $value . "'>" . $value . "</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="S'Inscrire">
            </form>
            <div class="footer-form">
                <a href="login.php"><span>Deja un compte ?<small>&nbsp; Se Connecter</small> </span></a>
            </div>
        </div>

    </main>

</body>

</html>