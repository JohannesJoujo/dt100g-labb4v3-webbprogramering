<?php
require_once "comment.php";
error_reporting(E_ALL);

if (isset($_POST["radera"])) {
    $delcomment= new comment("","");
    $delcomment->deleteComment($_POST["radera"]);
}



