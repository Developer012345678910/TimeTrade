<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="style_source" rel="stylesheet" href="../CSS/style.css">
    <title>Login</title>
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <div class="content">
        <form action="login.php" method="post" class="card">
            <input type="text" name="user" required>
            <input type="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <?php
        include "security.php";
        
        session_start();

        $users = json_decode(file_get_contents("../DB/users.txt", true), true);
        
        if (isset($_POST["user"]) && isset($_POST["password"])) {
            foreach ($users as $key) {
                if ($_POST["user"] == $key["user"] && password_verify($_POST["password"] . "_This_string_will_store_your_password_better_!!!_This_code_too_:_12_35_55_67_78_76_-__", $key["password"])) {
                    $_SESSION["logged_in"] = true;
                    $_SESSION["user"] = $key["user"];
                    $_SESSION["job"] = $key["job"];
                    $_SESSION["discribtion"] = $key["discribtion"];
                    $_SESSION["trust"] = $key["trust"];
                    $_SESSION["position"] = $key["position"];
                    $_SESSION["tel"] = $key["tel"];
                    header("Location: index.php");
                    break;
                }
            }
        }

        file_put_contents("../DB/users.txt", json_encode($users, JSON_PRETTY_PRINT));
        ?>
    </div>
    <footer>
            <a href="index.php"><img src="../IMG/home_icon.png" alt="Home"></a>
            <a href="login.php"><img src="../IMG/login_icon.png" alt="Login"></a>
            <a href="create.php"><img src="../IMG/add_user_icon.png" alt="Neuer Nutzer"></a>
    </footer>
    <script src="../JS/main.js"></script>
</body>
</html>