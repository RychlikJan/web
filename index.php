<?php
/**
 * Created by PhpStorm.
 * User: Jan Rychlik
 * Date: 11.01.2018
 * Time: 18:16
 */
session_start();
include("views/menu.php");
require_once("models/db.php");
require_once ("models/phpWrapper.mod.class.php");
require_once 'twig-master/lib/Twig/Autoloader.php';

$wrapper = new wrapper();
$menu = new menu();
$db = new db();
$stranka = @$_REQUEST["page"];
//nacteni stranky home, pokud je spusteni
if($stranka == ""){
    $stranka = "home";
}
// urceni, jakou stranku nacist
switch ($stranka) {
    case "home": $filename = 'controllers/homeController.php'; break;
    case "login": $filename = 'controllers/userController.php'; break;
    case "editace": $filename= 'controllers/newsController.php'; break;
    case "page": $filename= 'controllers/newsController.php'; break;
    case "kontakt": $filename= 'views/contact.php'; break;
    default: $filename = 'views/404.php';//404
        break;
}

$menu->getMenu();
$content = $wrapper ->phpWrapperFromFile($filename);
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('sablon');
$twig = new Twig_Environment($loader); // takhle je to bez cache
$template = $twig->loadTemplate('sablon.html');
$template_params = array();
$template_params["content"] = $content;
echo $template->render($template_params);

?>