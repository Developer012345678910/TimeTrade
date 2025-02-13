<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Nutzer</title>
</head>
<body>
    <script src="../JS/main.js"></script>
    <header>
        <h1>Nutzer</h1>
    </header>
    <div class="content">
        <div class="row line"><a href="users.php">Alle Nutzer</a><a href="users.php?filter=search">Nutzer suchen</a></div>
        <div id="users" class='column'>
        <?php
        include "security.php";
        
        session_start();

        $users = json_decode(file_get_contents("../DB/users.txt", true), true);

        if (isset($_SESSION["logged_in"])) {
            if (isset($_GET["filter"])) {
                echo "
            <div id='search' class='card'>
            <input id='input' type='text' placeholder='Nutzer...'>
            <input type='button' onclick='Filter(`users`, input.value);' value='Suchen'>
            </div>
                ";
            }
            foreach ($users as $user => $value) {
                if (isset($_GET["filter"])) {
                    if (str_contains(strtolower($users[$user]["user"]), strtolower($_GET["filter"])) || str_contains(strtolower($users[$user]["job"]), strtolower($_GET["filter"])) || str_contains(strtolower($users[$user]["position"]), strtolower($_GET["filter"])) || str_contains(strtolower($users[$user]["discribtion"]), strtolower($_GET["filter"]))) {
                        echo "
                        <form action='users.php?user=" . $users[$user]["user"] . "'>
                            <div class='card'>
                                <h2>" . $users[$user]["user"] . "</h2>
                                <p><span>Beruf: </span>" . $users[$user]["job"] . "</p>
                                <p><span>Beschreibung:</span><br>" . $users[$user]["discribtion"] . "</p>
                                <p><span>Ort: </span>" . $users[$user]["position"] . "</p>
                                <input onclick='window.location.href = `chat.php?filter=input&target=" . $users[$user]["user"] . "`;' type='button' value='Nachricht senden'>
                                <a class='call' href='tel: " . $users[$user]["tel"] . "'>Anrufen</a>
                            </div>
                        </form>
                        ";
                    } 
                } else {
                    echo "
                    <form action='users.php?user=" . $users[$user]["user"] . "'>
                        <div class='card'>
                            <h2>" . $users[$user]["user"] . "</h2>
                            <p><span>Beruf: </span>" . $users[$user]["job"] . "</p>
                            <p><span>Beschreibung:</span><br>" . $users[$user]["discribtion"] . "</p>
                            <p><span>Ort: </span>" . $users[$user]["position"] . "</p>
                            <input onclick='window.location.href = `chat.php?filter=input&target=" . $users[$user]["user"] . "`;' type='button' value='Nachricht senden'>
                            <a class='call' href='tel: " . $users[$user]["tel"] . "'>Anrufen</a>
                        </div>
                    </form>
                    ";
                }
            }
        } else {
            header("Location: login.php");
        }


        file_put_contents("../DB/users.txt", json_encode($users, JSON_PRETTY_PRINT));
        ?>
        </div>
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