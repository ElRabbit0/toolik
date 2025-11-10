<?php
session_start();
require('../node/vars.php');
$username = $_SESSION['login'];
$id = $_POST['id'];
echo $id;
?>