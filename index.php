<?php
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
        <div id="conteneur">
            <h1>QuickTchat</h1>
            <form action="index.php" method="POST">
                Pseudo : <input type="text" name="pseudo">
                <input type="submit" value="tchatter">
            </form>
        </div>
    </body>
</html>