<?php
session_start();
if(!isset($_SESSION['login'])){
    echo "not set";
}
else if(isset($_SESSION['login'])){
    echo "set, ".$_SESSION['login'];
}
?>