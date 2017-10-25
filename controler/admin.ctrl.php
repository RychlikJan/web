<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.10.2017
 * Time: 15:21
 */
include_once("/model/database.mod.class.php");
include_once("/view/admin.mod.class.php");

$administration = new admin();
$db = new MyDB();
$_SESSION["menu"] = $db->getAllCategory();

$action = @$_REQUEST["action"];

if(isset($_POST["publish_news"])){
    $news_id = $_POST['news_id'];
    if($db->publishNews($news_id)){

    }
}
if(isset($_POST["confirm"]) || isset($_POST["unblock"])){
    $user_id=$_POST["user_id"];
    if($db->setTypeUser($user_id, 2)){

    }
}
if(isset($_POST["block"])){
    $user_id=$_POST["user_id"];
    if($db->setTypeUser($user_id, 3)){

    }
}
if(isset($_POST["delete"])){
    $user_id=$_POST["user_id"];
    if($db->deleteUser($user_id)){

    }
}
$news = $db->getInfoAboutNews();
$users = $db->getAllUsers();

$administration->getAdminTables($_SESSION["menu"], $news, $users);



?>
