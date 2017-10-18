<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.10.2017
 * Time: 15:21
 */
include_once("/cfg/core.php");
include_once("/cfg/adminclass.php");

$administration = new admin();
$db = new MyDB();
$_SESSION["menu"] = $db->getAllCategory();
$news = $db->getInfoAboutNews();
$users = $db->getAllUsers();

$action = @$_REQUEST["action"];
if($action == "confirmUser"){
    $db ->setTypeUser($_POST["confirmUser"], 2);
}
if(isset($_POST["publish_news"])){
    $news_id = $_POST['news_id'];
    echo " id is " .$news_id;
    if($db->publishNews($news_id)){
        echo "it was goood";
    }
}

$administration->getAdminTables($_SESSION["menu"], $news, $users);



?>
