<?php
session_start();
require('../node/vars.php');
$username = $_SESSION['login'];
$id = $_POST['id'];
$todayDate = date('Y-m-d');

$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);

$hasSub = $mysql->query("SELECT COUNT(*) FROM `f-$username-friends` WHERE `friend_id` = '$id';");
$hasSub = $hasSub->fetch_array();
$hasSub = $hasSub[0];

$friendLog = $mysql->query("SELECT `login` FROM `users` WHERE `id` = '$id';");
$friendLog = $friendLog->fetch_array();
$friendLog = $friendLog[0];

$userId = $mysql->query("SELECT `id` FROM `users` WHERE `login` = '$username';");
$userId = $userId->fetch_array();
$userId = $userId[0];
$status;
if ($hasSub) {
    $status = $mysql->query("SELECT `friend_stat` FROM `f-$username-friends` WHERE `friend_id` = '$id';");
    $status = $status->fetch_array();
    $status = $status[0];
    switch ($status) {
        case 'subscriber':
            $mysql->query("UPDATE `f-$username-friends` SET `friend_stat` = 'friend' WHERE `friend_id` = '$id';");
            $mysql->query("UPDATE `f-$friendLog-friends` SET `friend_stat` = 'friend' WHERE `friend_id` = '$userId';");
            break;
        case 'following':
            $mysql->query("DELETE FROM `f-$username-friends` WHERE `friend_id` = '$id';");
            $mysql->query("DELETE FROM `f-$friendLog-friends` WHERE `friend_id` = '$userId';");
            break;
        case 'friend':
            $mysql->query("UPDATE `f-$username-friends` SET `friend_stat` = 'subscriber' WHERE `friend_id` = '$id';");
            $mysql->query("UPDATE `f-$friendLog-friends` SET `friend_stat` = 'following' WHERE `friend_id` = '$userId';");
            break;
        default:
            echo 'Error: Penis';
            break;
    }
} else {
    $mysql->query("INSERT INTO `f-$username-friends` (`id`, `friend_id`, `friend_stat`,`add_date`) VALUES (NULL, '$id', 'following','$todayDate');");
    $mysql->query("INSERT INTO `f-$friendLog-friends` (`id`, `friend_id`, `friend_stat`,`add_date`) VALUES (NULL, '$userId', 'subscriber','$todayDate');");
}
$mysql->close();
?>