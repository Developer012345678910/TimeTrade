<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Nachrichten</title>
</head>
<body>
    <header>
        <h1>Nachrichten</h1>
    </header>
    <div class="content">
        <button id="add" onclick="Slider(editor, chat);">+</button>
        <div id="editor">
        <form action="chat.php?filter=output" method="post" class="card">
            <div class="row">
                <h2>Neue Nachricht</h2>
            </div>
            <label for="to">An:</label>
            <input name="to" id="to" type="text" placeholder="Developer123">
            <label for="message">Nachricht</label>
            <input name="message" type="text" placeholder="Hallo...">
            <label for="send"></label>
            <input name="send" type="submit" value="Senden">
        </form>
        </div>
        <div id="chat" class="column">
        <div class="row line"><a onclick="Filter('chat', 'input');">Eingang</a><a onclick="Filter('chat', 'output');">Ausgang</a></div>
        <script src="../JS/main.js"></script>
        <script>
            Slider(editor, chat);
        </script>
        <?php
    include "security.php";

    session_start();

    $users = json_decode(file_get_contents("../DB/users.txt", true), true);

    if (isset($_SESSION["logged_in"])) {
        if (isset($_POST["send"])) {

            foreach ($users as $user => $value) {
                if ($users[$user]["user"] == $_POST["to"]) {
                    array_push($users[$user]["messages"], "<p><span>Von " . $_SESSION["user"] . ": </span>" . $_POST["message"] . "</p>");
                }

                if ($users[$user]["user"] == $_SESSION["user"]) {
                    array_push($users[$user]["output"], "<p><span>An " . $_POST["to"] . ": </span>" . $_POST["message"] . "</p>");               
                }
            }       
        }

        foreach ($users as $user) {
            if ($user["user"] == $_SESSION["user"] && $_GET["filter"] == "input") {
                foreach ($user["messages"] as $message) {
                    echo "<div class='row card'>" . $message . "</div>";
                }
                break;
            }

            if ($user["user"] == $_SESSION["user"] && $_GET["filter"] == "output") {
                foreach ($user["output"] as $message) {
                    echo "<div class='row card'>" . $message . "</div>";
                }
                break;
            }
        }

        if (isset($_GET["target"])) {
            echo "<script>autoFill('" . $_GET["target"] . "');</script>";
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