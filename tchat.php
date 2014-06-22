<?php
session_start();
if (!isset($_SESSION["pseudo"]) || empty($_SESSION["pseudo"])) {
    header("location:index.php");
}
include 'includes/connect.php';
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/tchat.js"></script>
        <script type="text/javascript">
            <?php
                $sql = "SELECT id FROM messages ORDER BY id DESC LIMIT 1";
                $req = $connexion->query($sql);
                $data = $req->fetch(PDO::FETCH_ASSOC);
            ?>
            var lastid = <?php echo $data["id"]; ?>
        </script>
    </head>

    <body>
        <nav>
            <h1>QuickTchat</h1>
        </nav>
        <div id="conteneur" style="width:94%; margin-bottom:200px;">
            <p><i>Vous êtes connecté en tant que <?php echo $_SESSION["pseudo"]; ?>. (<a href="deconnect.php">Déconnexion</a>)</i></p>
            <div id="connected">

            </div>
            <div id="tchat">
                <?php
                    $sql = "SELECT * FROM messages ORDER BY date DESC LIMIT 15";
                    $req = $connexion->query($sql) or die(print_r($connexion->errorInfo()));
                    $d = array();
                    while($data = $req->fetch(PDO::FETCH_ASSOC)){
                        $d[] = $data;
                    }
                    for ($i=count($d)-1; $i >= 0 ; $i--) {
                    ?>
                        <p><strong><?php echo $d[$i]["pseudo"]; ?></strong> (<?php echo date("d/m/y H:i:s", $d[$i]["date"]); ?>) : <?php echo htmlentities($d[$i]["message"]); ?></p>
                    <?php
                    }
                ?>
            </div>
        </div>

        <div id="tchatForm" style="position:fixed;bottom:0;width:100%">
            <form method="POST" action="#">
                <div style="margin-right:110px;">
                    <textarea name="message" style="width:100%;"></textarea>
                </div>
                <div style="position:absolute; top:12px; right:15px;">
                    <input class="button" type="submit" value="Envoyer">
                </div>
            </form>
        </div>
    </body>
</html>