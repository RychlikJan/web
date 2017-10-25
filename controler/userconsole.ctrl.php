<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 10.10.2017
 * Time: 20:42
 */

include_once("/model/database.mod.class.php");
include_once("/view/userprocess.mod.class.php");

$db = new MyDB();
   $userInfo = new userprocess();
    $userInfo ->getUserMainInfo($db->getNewsByUserId($_SESSION["user"]["id"]));

?>