<?php
session_start();

require_once '../classes/carousel.class.php';
$carousel = new carousel(10, $_GET['preload'], $_GET['direction']);
$position = $carousel->getPosition();

echo "<img style=\"border: 1px solid black; margin: 0px 2px;\" src=\"images/" . $position . ".jpg\" />";
?>