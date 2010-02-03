<?php
session_start();

require_once '../classes/glider.class.php';
$glider = new glider($_GET['preload'], $_GET['direction']);
$position = $glider->getPosition();
echo $position;
?>