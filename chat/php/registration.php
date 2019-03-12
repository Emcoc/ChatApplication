<html>
    <head>
        <meta charset="utf-8">
        <title>Registrazione nuovo utente</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link href="img/favicon.png" rel="icon">
        <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Bootstrap CSS File -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Main Stylesheet File -->
        <link href="../css/registrazione.css" rel="stylesheet">
    </head>
    <body>
        <form method="post">
            <h1 class="jumbotron">Registrazione nuovo utente</h1>
            <div class="form container jumbotron">
                <div id="nameDiv" class="form-group div">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div id="surnameDiv" class="form-group div">
                    <label for="surname">Cognome</label>
                    <input type="text" class="form-control" name="surname" id="surname" required>
                </div>
                <div id="phoneDiv" class="form-group div">
                    <label for="phone">Cellulare</label>
                    <input type="tel" class="form-control" name="phone" id="phone" required>
                </div>
                <div id="emailDiv" class="form-group div">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div id="usernameDiv" class="form-group div">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div id="passwordDiv" class="form-group div">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" minlength="8" maxlength="16" required>
                    <small>Min 8 caratteri; max 16 caratteri</small>
                </div>
                <div id="repeatPasswordDiv" class="form-group div">
                    <label for="repeatPassword">Ripeti password</label>
                    <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" minlength="8" maxlength="16" required>
                    <small>Min 8 caratteri; max 16 caratteri</small>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Registrati</button>
            </div>
        </form>
        <?php
        if(isset($_POST["submit"])) {
            require config.php;
            $conn = new mysqli($host, $username, $password, $db);
            /*********************************
             * Controllo utente già iscritto *
             *********************************/
            $email = $_POST["email"];
            $result = $conn->query("select email from " . $table . " where email='" . $email . "'");
            if($result->num_rows > 0) {
                //utente già esistente
                $message = "L'utente collegato a questa email risulta già esistente!";
                echo "<script type='text/javascript'>alert(" . $message . ")</script>";
            } else {
                /*****************************
                 * Nome utente già esistente *
                 *****************************/
                $username = $_POST["username"];
                $result = $conn->query("select username from" . $table . " where username='" . $username . "'");
                if($result->num_rows > 0) {
                    //nome utente già esistente
                    $message = "L'username scelto è già utilizzato da un altro utente. Sceglierne un altro.";
                    echo "<script type='text/javascript'>alert(" . $message . ")</script>";
                } else {
                    /*******************************
                     * Password non corrispondente *
                     *******************************/
                    $password = $_POST["password"];
                    $repeatPassword = $_POST["repeatPassword"];
                    if($password != $repeatPassword) {
                        $message = "Password non corrispondente";
                        echo "<script type='text/javascript'>alert(" . $message . ")</script>";
                    } else {
                        /****************************
                         * Inserimento nuovo utente *
                         ****************************/
                        $name = $_POST["name"];
                        $surname = $_POST["surname"];
                        $phone = $_POST["phone"];
                        $password = $_POST["password"];
                        $result = $conn->query("insert into " . $table . " values(" . $name . ", " . $surname . ", " . $phone . ", " . $email . ", " . password_hash($password, PASSWORD_DEFAULT) . ");");
                        if ($result->num_rows > 0) {
                            //utente inserito correttamente
                            $message = "Registrazione avvenuta con successo!";
                            echo "<script type='text/javascript'>alert(" . $message . ")</script>";
                            $_SESSION["username"] = $username;
                            header("location: index.html");
                        }
                    }
                }
            }
        }
        ?>
    </body>
</html>