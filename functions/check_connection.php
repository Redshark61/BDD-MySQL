<?php
session_start();
$_SESSION['update'] = false;
if  ((!isset($_SESSION['connected'])) || (!$_SESSION['connected'])){
    header('Location: index.php');
    exit();
}
