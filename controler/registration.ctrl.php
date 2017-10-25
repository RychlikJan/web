<?php

include_once("/model/database.mod.class.php");
include_once("/model/registrationprocess.mod.class.php");

$db = new MyDB();
$registration = new registrationprocess();

$action = @$_REQUEST["action"];

//$alert = true;
if($action == "registration"){

    if($_REQUEST['pswNewUser'] != $_REQUEST['pswNewUser-repeat']){
        echo "this password is not correct";
    }else{
        $loginNewUser = $_REQUEST['loginNewUser'];
        echo "password is good";

        if($db->controlNewLogin($loginNewUser)){
            $emailNewUser = $_REQUEST['emailNewUser'];
            $pswNewUser = $_REQUEST['pswNewUser'];
            $db->addNewUser($loginNewUser, $emailNewUser, $pswNewUser);
            if($db->loginUserInDataBaze($loginNewUser, $pswNewUser)){
                $registration->infoUser();
            }
        }else{
            ?>
            <div class="alert alert-danger">
                <strong>Bad login.</strong>
            </div>
            <?php
        }
    }
}

//if(!isset($_SESSION["user"])){
    $registration->getFormRegistration();
//}

$db->close();
unset($db);
unset($registration);
?>