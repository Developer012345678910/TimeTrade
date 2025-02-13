<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Dashboard</title>
</head>
<body>
    <script src="../JS/main.js"></script>
    <header>
        <h1>Dashboard</h1>
    </header>
    <div class="content">
        <?php
        include "security.php";
        
        session_start();

        $users = json_decode(file_get_contents("../DB/users.txt", true), true);

        if (isset($_SESSION["logged_in"])) {
            echo "<div class='card'>Willkommen " . $_SESSION["user"] . "!</div>";
        } else {
            header("Location: login.php");
        }


        file_put_contents("../DB/users.txt", json_encode($users, JSON_PRETTY_PRINT));
        ?>
        <div class="card">
            Was ist TimeTrade?
            <p>
                TimeTrade ist eine Plattform, auf der
                du Dienstleistungen suchen und dich mit
                ihnen in Verbindung setzen kannst. Dies ist
                sowohl per Chat als auch per Telefon möglich.
            </p>
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