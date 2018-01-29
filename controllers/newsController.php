<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.01.2018
 * Time: 17:55
 */
include_once("/models/db.php");
include_once("/views/openNews.php");

$db = new db();
$news_view = new NewsView();

$action = @$_REQUEST["action"];
$id_news = @$_REQUEST["news_id"];

if($action=="open_news"){
    $news_view->getPageNews($db->findNewsById($id_news), $db->getRatingByNews($id_news));
}
if($action == "download"){
    $file_name= @$_REQUEST["pdf"];
    //$file_name= $_POST["pdf"];
    $file_path = "resource/".$_POST["pdf"];
    if(file_exists($file_path)){
        header("Cache-Control: public");
        header("Content-disposition: attachment; filename=".$file_name);
        header("Content-type: application/pdf");
        readfile($file_path);
    }
}


if(@$_SESSION["user"]){

    $id_user = @$_SESSION["user"]["id"];

    if($action == "addnews"){

        $user_id = @$_SESSION["user"]["id"];;
        $newTitle = $_REQUEST['newTitle'];
        $newText = $_REQUEST['newText'];
        $imageNews = $_REQUEST['imageNews'];
        $namePDFfile= null;
        $fileExist = true;

        $target_dir = "resource/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;

        if(!empty($_FILES["fileToUpload"])){
            $fileToUpdate = $_FILES["fileToUpload"];
            if($fileToUpdate["error"]!== UPLOAD_ERR_OK){
                $fileExist = false;
            }
        }else{
            $fileExist = false;
        }
        if($_FILES["fileToUpload"]["type"] != "application/pdf"){
            $fileExist = false;
        }

        if($fileExist){
            $namePDFfile = preg_replace("/[^A-Z0-9._-]/i", "_", $fileToUpdate["name"]);
            $i = 0;
            $parts = pathinfo($namePDFfile);
            while (file_exists($target_dir . $namePDFfile)) {
                $i++;
                $namePDFfile = $parts["filename"] . "-" . $i . "." . $parts["extension"];
            }
            $success = move_uploaded_file($fileToUpdate["tmp_name"],
                $target_dir . $namePDFfile);
            if (!$success) {
                echo "<p>Unable to save file.</p>";
                exit;
            }
            chmod($target_dir . $namePDFfile, 0644);
        }

        if($db->addNews($newTitle, $newText, $user_id, $imageNews, $namePDFfile)){
            $news_view->addNewsWasTrue();
        }

    }

    if($action == "update_news"){
        $newTitle = $_REQUEST['newTitle'];
        $newText = $_REQUEST['newText'];
        $imageNews = $_REQUEST['imageNews'];

        if($db->updateNews($id_news, $newTitle, $newText, $imageNews)){
            $news_view->addNewsWasTrue();
        }
    }

    if($action ==  "openform"){//uzivatel smi pridat novy prispevek
        $news_view->getForm();
    }

    if($action == "accept" && @$_SESSION["user"]["isAdmin"]==1){
        if($db->setStatusNews($id_news, 2)){
            $news_view->setStatusNewsWas("accept");
        }
    }

    if($action == "decline" && @$_SESSION["user"]["isAdmin"]==1){
        if($db->setStatusNews($id_news, 3)){
            $news_view->setStatusNewsWas("decline");
        }
    }

    if($action == "deletenews" &&  @$_SESSION["user"]["id"]>0){
        if($db->deleteNews($id_news)){
            $news_view->deleteModal();
        }
    }

    if($action == "save_rating"){
        $image_rating = $_REQUEST['image_rating'];
        $style_rating = $_REQUEST['style_rating'];
        $interesting_rating = $_REQUEST['image_rating'];
        if($image_rating == "Obrazek" || $style_rating == "Styl" || $interesting_rating=="Zajímavost"){
            $news_view->addRatingToNews(false);

        }else{
            if($db->addRatingToNews($id_user, $id_news, $interesting_rating, $image_rating, $style_rating)){
                $news_view->addRatingToNews(true);
            }else{
                $news_view->addRatingToNews(false);
            }
        }
    }

    if($action == "open_form_for_edit"){
        $newsForSet = $db->findNewsById($id_news);
        ///kontrola aby uzivatel nemel pristup k cizim a jiz publikovanym prispevku
        if($newsForSet["status_id"]==1 && $newsForSet["user_id"] == $id_user){
            $news_view->getEditionNews($newsForSet);
        }else{
//            header('Location: http://localhost/index.php?page=404');
        }
    }
}


