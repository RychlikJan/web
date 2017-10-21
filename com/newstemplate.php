<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.10.2017
 * Time: 17:58
 */
include_once("/cfg/core.php");
include_once("/cfg/addnews.php");

$db = new MyDB();
$news = new news();

$action = @$_REQUEST["action"];
$idNews = @$_REQUEST["newsid"];
if($action == "addnews"){
    $user_id = @$_SESSION["user"]["id"];;
    $newTitle = $_REQUEST['newTitle'];
    $newText = $_REQUEST['newText'];
    $category = $_REQUEST['selectCategory'];
    $imageNews = $_REQUEST['imageNews'];

//    echo "info user is ".$user_id." title ".$newTitle." text ".$newText. " category is ".$category."<br>";
    $db->addNewNews($newTitle, $newText, $user_id, $category, $imageNews);
    $news->alertNewsWasAdded();
}else if($action == "setnews"){
    $idNews = @$_REQUEST["newsid"];
    $newTitle = $_REQUEST['newTitle'];
    $newText = $_REQUEST['newText'];
    $category = $_REQUEST['selectCategory'];
    $imageNews = $_REQUEST['imageNews'];

    echo "info user is ".$category."<br>";
    if($db->setNews($idNews, $newTitle, $newText, $category, $imageNews)){
        $news->alertNewsWasEdited();
    }
}else if($idNews ==  ""){
    $news->getFormForNews($db -> getAllCategory());
}else{
    $news->setNews($db->getOneNewsWithArrayComment($idNews),$category);
}


?>