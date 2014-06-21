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
if (!file_exists('../config.php')) {
    $step = isset( $_POST['step'] ) ? (int) $_POST['step'] : 0;
    switch ($step) {
        case '0':
?>
                <form action="index.php" method="POST">
                    Nom de la base de données <input type="text" name="nameDB"><br>
                    Nom de l'utilisateur MySQL <input type="text" name="nameUser"><br>
                    Mot de passe de l'utilisateur MySQL <input type="password" name="passwordUser"><br>
                    Adresse du serveur MySQL <input type="text" name="addressServer"><br>
                    <input type="hidden" name="step" value="1">
                    <input type="submit" value="Envoyer">
                </form>
<?php
            break;

            case '1':
                $content_file = array(
                    "open" => "<?php\r\n",
                    "nameDB" => "define('DB_NAME', '".$_POST['nameDB']."');\r\n",
                    "nameUser" => "define('DB_USER', '".$_POST['nameUser']."');\r\n",
                    "passwordUser" => "define('DB_PASSWORD', '".$_POST['passwordUser']."');\r\n",
                    "addressServer" => "define('DB_ADDRESS', '".$_POST['addressServer']."');\r\n",
                    "close" => "?>"
                );

                $handle = fopen('../config.php', 'w');
                foreach( $content_file as $line ) {
                    fwrite( $handle, $line );
                }
                fclose($handle);
?>
                <p>Félicitation, votre fichier config.php vient d'être créer. Vous pouvez maintenant passer à l'installation de la base de données en cliquant ici : <a href="db.php">Installation de la base de données</a>.</p>
<?php
                break;
    }
?>
<?php
}
else{
?>
                <p>
                    Erreur votre fichier config.php existe déjà.<br>
                    Si vous voulez modifier les données, vous pouvez soit l'éditer, soit le supprimer et relancer l'installation.<br>
                    Sinon vous pouvez passer directement à l'installation de la base de données en cliquant ici : <a href="db.php">Installation de la base de données</a>.
                </p>
<?php
}
?>
            </div>
        </body>
    </html>