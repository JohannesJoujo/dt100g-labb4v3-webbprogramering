<?php
require_once "comment.php";
error_reporting(E_ALL);


if (isset($_REQUEST['submit'])) {
    $newcomment= new comment($_REQUEST['namn'],$_REQUEST['meddelande']);
    $newcomment->addcomment($newcomment);
}