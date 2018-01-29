<?php
include_once("/models/db.php");
include_once("/views/openNews.php");

$db = new db();
$home = new NewsView();
$home->getHomePage($db->findAllNews());

$db->close();
unset($db);

?>