<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.01.2018
 * Time: 17:53
 */

include_once("/models/db.php");
include_once("/views/admin.php");
include_once("/views/userDetails.php");
include_once("/views/loginUser.php");


$db = new db();
$user_view = new UserView();
$admin_view = new AdminView();
$login = new LoginView();

$action = @$_REQUEST["action"];
if($action == "login"){
    $username = $_REQUEST['username'];
    $userpassword = $_REQUEST['userpassword'];
    $userForControl = $db->controlUser($username, $userpassword);
    if($userForControl == null){
        $login->errorLogin();
        //errorLogin();
    }
    else{
        $_SESSION["user"] = $userForControl;
    }
}

if($action == "registration"){
    $userlogin = $_REQUEST['userlogin'];
    $useremail = $_REQUEST['useremail'];
    $psw1 = $_REQUEST['password1'];
    $psw2 = $_REQUEST['password2'];
    if($psw1 == $psw2){
        $userForControl = $db->registrationUser($userlogin,$useremail, $psw1);
        if($userForControl == null){
            $login->errorLogin();
        }
        else{
            header('Location: http://localhost/index.php?page=login');
        }
    }
}

if($action == "delete" && @$_SESSION["user"]["isAdmin"] == 1){
    if($db->deleteUser(@$_REQUEST["user_id"])){

    }
}

if($action == "block" && @$_SESSION["user"]["isAdmin"] == 1){
    if($db->blockOrUnblockUser(@$_REQUEST["user_id"], 1)){

    }
}

if($action == "unblock" && @$_SESSION["user"]["isAdmin"] == 1){
    if($db->blockOrUnblockUser(@$_REQUEST["user_id"], 0)){

    }
}

if($action == "tableusers" && @$_SESSION["user"]["isAdmin"] == 1){
    $news_id = @$_REQUEST["news_id"];
    $admin_view->getUserTableToNews($db->findAllUsersForAdmin(), $news_id, @$_REQUEST["autor_id"], $db->getRatingByNews($news_id));
}

if($action == "save_user_for_rating" && @$_SESSION["user"]["isAdmin"] == 1){
    if(isset($_POST['users'])){
        foreach ($_POST['users'] as $item){
            if($db->addNewRatingWithUserId($item, @$_REQUEST["news_id"])){

            }
        }
    }
}


if($action == "logOut"){
    @session_unset($_SESSION["user"]);
    header('Location: http://localhost/index.php?page=home');

}




if(!isset($_SESSION["user"])){
    $login = new LoginView();
    $action = @$_REQUEST["action"];
    if($action == "registrationopen"){
        $login->getRegistrationForm();
    }else{
        $login->getLoginForm();
    }

}else{
    if(@$_SESSION["user"]["isAdmin"] == 1 && $action != "tableusers") {
        $news_array = $db->findAllNews();
        $rating_array = $db->findAllRatings();
        $user_array = $db->findAllUsersForAdmin();
        $admin_view->getPanel(count($user_array), count($news_array));
        $admin_view->getUserTable($user_array, $news_array);
        $admin_view->getNewsTable($news_array, $rating_array, $user_array);

    }

    if(@$_SESSION["user"]["isAdmin"] == 0){
        $user_view->getUserDetails();
        $user_id = @$_SESSION["user"]["id"];
        $user_view->getNewsTable($db->findAllNewsByUserId($user_id), $db->getRatingByAutor($user_id), $db->getAllStatus());
        if(@$_SESSION["user"]["isBlocked"] == 0){
            $rating_news_for_user = $db->findRatingByUserId(@$_SESSION["user"]["id"]);
            if($rating_news_for_user!= null){
                $user_view->getNewsTableForRating($rating_news_for_user);
            }
        }
    }


}




