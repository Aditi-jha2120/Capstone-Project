<?php 
session_start();
include_once("classes/user.php");

if($_GET["logout_user"]){

    session_destroy();
    header("Location: index.php");
    die();

}