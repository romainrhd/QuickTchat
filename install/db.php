<?php
require_once('../includes/fonctions.php');
require_once('../includes/connect.php');
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" href="../css/style.css">
        </head>

        <body>
            <nav>
                <h1>QuickTchat</h1>
            </nav>
            <div id="conteneur">
                <p><i>Bienvenue dans l'installation de QuickTchat.</i></p>
<?php
$tables = getTables($connexion);
// On test l'existence de donénes dans la base de données oreti
if (empty($tables)) {
    // Récupération du fichier contenant la structure de la base de données
    $file = "tchat.sql";
    create_db($connexion, $file);
?>
                <p>Félicitation, la base de données à bien été installée. Vous pouvez maintenant utiliser QuickTchat en cliquant ici : <a href="../index.php">Démarrer QuickTchat</a>.</p>
<?php
}
else{
?>
                <p>Erreur ! La base de données n'est pas vide. Vous pouvez soit la vider, soit utiliser la structure de la base de données qui existe déjà et commencer à tchatter en cliquant ici : <a href="../index.php">Démarrer QuickTchat</a>.</p>
<?php
}
?>
            </div>
        </body>
    </html>