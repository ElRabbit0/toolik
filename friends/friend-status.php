<?php
session_start();
require('../node/vars.php');
$username = $_SESSION['login'];
$id = $_POST['id'];
$status = $_POST['status'];
$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
$friendList = $mysql->query("SELECT * FROM `f-$username-friends` WHERE `friend_stat` = 'partner' LIMIT 1;");
$friendList = $friendList->fetch_all();
if ($status == 'partner') {
    if (count($friendList) == 0) {
        $mysql->query("UPDATE `f-$username-friends` SET `friend_stat` = '$status' WHERE `friend_id` = '$id';");
    }
} else {
    $mysql->query("UPDATE `f-$username-friends` SET `friend_stat` = '$status' WHERE `friend_id` = '$id';");
}
$mysql->close();
echo 'All Good';
?>