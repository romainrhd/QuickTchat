<?php
require_once('includes/fonctions.php');
if (!file_exists('config.php')) {
    header("location:install/");
}
else{
    require_once('includes/connect.php');
    // On test si la base de données est bien installée
    $tables = getTables($connexion);
    if (empty($tables)) {
        header("location:install/db.php");
    }
    else{
        if(!empty($_POST) && isset($_POST["pseudo"]) && !empty($_POST["pseudo"])){
            session_start();
            $_SESSION["pseudo"] = $_POST["pseudo"];
            header("location:tchat.php");
        }
?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link rel="stylesheet" href="css/style.css">
            </head>

            <body>
                <nav>
                    <h1>QuickTchat</h1>
                </nav>
                <div id="conteneur">
                    <p><i>Bienvenue sur QuickTchat.</i></p>
                    <form action="index.php" method="POST">
                        Pseudo <input type="text" name="pseudo">
                        <input type="submit" value="tchatter">
                    </form>
                </div>
            </body>
        </html>
<?php
    }
}
?>