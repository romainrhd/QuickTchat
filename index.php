<?php
require_once('includes/fonctions.php');
if (!file_exists('includes/config.php')) {
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
            $pseudo = $_POST["pseudo"];
            $pseudo = $connexion->quote($pseudo);
            $sql = "SELECT * FROM connected WHERE pseudo LIKE $pseudo LIMIT 1";
            $req = $connexion->query($sql);
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                $ip = $_SERVER["REMOTE_ADDR"];
                $sql = "INSERT INTO connected(pseudo,ip,date) VALUES ($pseudo, '$ip', ".time().")";
                $req = $connexion->query($sql);
                $idTchat = $connexion->lastInsertId();
            }
            else{
                if ($data["ip"] == $_SERVER["REMOTE_ADDR"] && time()-$data["date"]<60) {
                    $idTchat = $data["id"];
                }
                else if (time()-$data["date"]>60) {
                    $idTchat = $data["id"];
                }
                else{
                    $erreur = "Ce pseudo est déjà en cours d'utilisation";
                }
            }
            if (!isset($erreur)) {
                $_SESSION["pseudo"] = $_POST["pseudo"];
                $_SESSION["idTchat"] = $idTchat;
                header("location:tchat.php");
            }
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
                    <?php if(isset($erreur)){echo '<p>'.$erreur.'</p>';}?>
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