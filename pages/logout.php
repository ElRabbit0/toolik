<?php
session_start();
$_SESSION['iSlogin'] = false;
header('location: ../index.php');
?>