<?php
error_reporting(0);
session_start();
$_SESSION['login']="bla";
if(!isset($_SESSION['login'])){
  header("location:login.php");

}
else {
  header("location:production/home.php");
}


?>