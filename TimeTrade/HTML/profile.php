<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Profil</title>
</head>
<body>
    <header>
        <h1>Profil</h1>
        <div></div>
    </header>
    <div class="content">
    <?php
    include "security.php";

    session_start();

    $users = json_decode(file_get_contents("../DB/users.txt", true), true);

    if (isset($_SESSION["logged_in"])) {
        if (isset($_POST["edit"])) {
            foreach ($users as $key =>$value) {
                if ($users[$key]["user"] == $_SESSION["user"]) {
                    $users[$key]["user"] = $_POST["user"];
                    $_SESSION["user"] = $_POST["user"];

                    $users[$key]["discribtion"] = $_POST["discribtion"];
                    $_SESSION["discribtion"] = $_POST["discribtion"];

                    $users[$key]["job"] = $_POST["job"];
                    $_SESSION["job"] = $_POST["job"];

                    $users[$key]["position"] = $_POST["position"];
                    $_SESSION["position"] = $_POST["position"];

                    $users[$key]["tel"] = $_POST["tel"];
                    $_SESSION["tel"] = $_POST["tel"];
                    break;
                }
            }
        }

        if (isset($_POST["delete"])) {
            foreach ($users as $user => $value) {
                if ($users[$user]["user"] == $_SESSION["user"]) {
                    unset($_SESSION["logged_in"]);
                    unset($users[$user]);
                    file_put_contents("../DB/users.txt", json_encode($users, JSON_PRETTY_PRINT));
                    header("Location: index.php");
                }
            }
        }

        echo
        "
        <form action='profile.php' method='post' class='card' style='gap: 0;'>
        <label for='user'>Nutzername: </label>
        <input type='text' name='user' value='" . $_SESSION["user"] . "'>
        <label for='discribtion'>Beschreibung: </label>
        <input type='text' name='discribtion' value='" . $_SESSION["discribtion"] . "'>
        <label for='job'>Beruf: </label>
        <input type='text' name='job' value='" . $_SESSION["job"] . "'>
        <label for='position'>Ort: </label>
        <input type='text' name='position' value='" . $_SESSION["position"] . "'>
        <label for='tel'>Nummer: </label>
        <input type='text' name='tel' value='" . $_SESSION["tel"] . "'>
        <label for='edit'></label>
        <input type='submit' name='edit' value='Speichern'>
        </form>
        ";
    } else {
        header("Location: login.php");
    }

    file_put_contents("../DB/users.txt", json_encode($users, JSON_PRETTY_PRINT));
    ?>
    <form action="profile.php" method="post" class="card">
        <input type="submit" name="delete" value="!Nutzer löschen!">
    </form>
    </div>
    <footer>
        <a href="index.php"><img src="../IMG/home_icon.png" alt="Home"></a>
        <a href="users.php"><img src="../IMG/users_icon.png" alt="Nutzer"></a>
        <a href="chat.php?filter=input"><img src="../IMG/chat_icon.png" alt="Chat"></a>
        <a href="profile.php"><img src="../IMG/user_icon.png" alt="Profil"></a>
        <a href="logout.php"><img src="../IMG/logout_icon.png" alt="Logout"></a>
    </footer>
</body>
</html>