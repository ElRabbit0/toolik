<?php
session_start();
$_SESSION['new_date'] = $_POST['add'];
header('location: /hours/main.php');
?>