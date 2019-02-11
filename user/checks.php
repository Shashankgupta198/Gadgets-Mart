<?php
if(!isset($_SESSION["aname"])){
    header("location:../login.php");
    die();
}