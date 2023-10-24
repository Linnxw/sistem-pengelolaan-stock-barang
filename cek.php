<?php
session_start();
if(!isset($_SESSION["login"]) && !isset($_SESSION["user"])){
  header("Location:login.php");
}
?>