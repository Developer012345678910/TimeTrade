<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Registrieren</title>
</head>
<body>
    <header>
        <h1>Registrieren</h1>
    </header>
    <div class="content">
        <form action="create.php" method="post" class="card">
            <label for="user">Nutzername: </label>
            <input type="text" name="user" required>
            <label for="password">Password: </label>
            <input type="password" name="password" required>
            <label for="password_verified">Password: </label>
            <input name="password_verified" type="password" required>
            <label for="job">Beruf: </label>
            <input type="text" name="job" required>
            <label for="tel">Telefon: </label>
            <input type="text" name="tel" required>
            <label for="discribtion">Beschreibung: </label>
            <input type="text" name="discribtion" required>
            <label for="position">Ort: </label>
            <input type="text" name="position" required>
            <input type="submit" value="Registrieren">
        </form>
        <?php
        include "security.php";

        session_start();

        $users = json_decode(file_get_contents("../DB/users.txt", true), true);
        
        if (isset($_POST["user"]) && isset($_POST["password"])  && isset($_POST["password_verified"])  && isset($_POST["job"])  && isset($_POST["discribtion"]) && isset($_POST["position"]) && isset($_POST["tel"])) {
            foreach ($users as $user => $value) {
                if ($users[$user]["user"] == $_POST["user"]) {
                    echo "Dieser Nutzer existiert bereits!";
                    exit;
                }
            }
            if ($_POST["password"] == $_POST["password_verified"]) {
                array_push(
                    $users,
                    [
                        "user" => $_POST["user"],
                        "password" => password_hash($_POST["password"] . "_This_string_will_store_your_password_better_!!!_This_code_too_:_12_35_55_67_78_76_-__", PASSWORD_DEFAULT),
                        "job" => $_POST["job"],
                        "discribtion" => $_POST["discribtion"],
                        "position" => $_POST["position"],
                        "tel" => $_POST["tel"],
                        "messages" => [],
                        "output" => []
                    ]
                );
            }
        } else {
            echo "Fehler!!!";
        }

        file_put_contents("../DB/users.txt", json_encode($users, JSON_PRETTY_PRINT));
        ?>
    </div>
    <footer>
            <a href="index.php"><img src="../IMG/home_icon.png" alt="Home"></a>
            <a href="login.php"><img src="../IMG/login_icon.png" alt="Login"></a>
            <a href="create.php"><img src="../IMG/add_user_icon.png" alt="Neuer Nutzer"></a>
    </footer>
</body>
</html>