<?php
require('../node/vars.php');
$indexToDel = $_POST['del'];
echo $indexToDel;
$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
$mysql->query("DELETE FROM `0_hours` WHERE `id` = '$indexToDel';");
header("Location:/hours/main.php");
$mysql->close();
exit;
?>