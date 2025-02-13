<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Logout</title>
</head>
<body>
    <header>
        <h1>Logout</h1>
    </header>
    <div class="content">
        <?php
        include "security.php";
                
        session_start();

        $users = json_decode(file_get_contents("../DB/users.txt", true), true);
        
        if (isset($_SESSION["logged_in"])) {
            unset($_SESSION["logged_in"]);
        }

        header("Location: login.php");
        ?>
    </div>
    <footer>
            <a href="index.php"><img src="../IMG/home_icon.png" alt="Home"></a>
            <a href="login.php"><img src="../IMG/login_icon.png" alt="Login"></a>
            <a href="create.php"><img src="../IMG/add_user_icon.png" alt="Neuer Nutzer"></a>
    </footer>
</body>
</html>