<?php
if(isset($_SESSION["lastlogin"])){
    echo "<h1>Admin Last Visit : " . $_SESSION["lastlogin"];
}else{
    echo "<h1>Welcome First Time Admin!!!</h1>";
}
?>