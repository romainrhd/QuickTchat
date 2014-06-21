<?php
session_start();
require("connect.php");
$d = array();

if (!isset($_SESSION["pseudo"]) || empty($_SESSION["pseudo"]) || !isset($_POST["action"])) {
    $d["erreur"] = "Vous devez être connecté pour utiliser le tchat";
}
else{

    extract($_POST);
    $pseudo = $connexion->quote($_SESSION["pseudo"]);

    /**
     * Action : addMessage
     * Permet l'ajout d'un message
     */
    if ($_POST["action"] == "addMessage") {
        $message = $connexion->quote($message);
        $sql = "INSERT INTO messages(pseudo, message, date) VALUES ($pseudo, $message, ".time().")";
        $connexion->query($sql) or die(print_r($connexion->errorInfo()));
        $d["erreur"] = "ok";
    }

    /**
     * Action : getMessages
     * Permet l'affichage des derniers messages
     */
    if ($_POST["action"] == "getMessages") {
        $lastid = floor($lastid);
        $sql = "SELECT * FROM messages WHERE id>$lastid ORDER BY date ASC";
        $req = $connexion->query($sql) or die(print_r($connexion->errorInfo()));
        $d["result"] = "";
        $d["lastid"] = $lastid;
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $d["result"] .= '<p><strong>'.$data["pseudo"].'</strong> ('.date("d/m/y H:i:s",$data["date"]).') : '.htmlentities(utf8_decode($data["message"])).'</p>';
            $d["lastid"] = $data["id"];
        }
        $d["erreur"] = "ok";
    }

}
echo json_encode($d);
?>