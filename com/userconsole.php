<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 10.10.2017
 * Time: 20:42
 */

include_once("/cfg/core.php");
include_once("/cfg/userprocess.php");

$db = new MyDB();
   $userInfo = new userprocess();
    $userInfo ->getUserMainInfo($db->getNewsByUserId($_SESSION["user"]["id"]));

?>