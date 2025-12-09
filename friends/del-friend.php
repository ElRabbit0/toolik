<?php
session_start();
require('../node/vars.php');
$username = $_SESSION['login'];
$id = $_POST['id'];
$position = $_POST['position'];
$todayDate = date('Y-m-d');

$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);

$hasFriend = $mysql->query("SELECT COUNT(*) FROM `f-$username-friends` WHERE `friend_id` = '$id';");
$hasFriend = $hasFriend->fetch_array();
$hasFriend = $hasFriend[0];

$friendLog = $mysql->query("SELECT `login` FROM `users` WHERE `id` = '$id';");
$friendLog = $friendLog->fetch_array();
$friendLog = $friendLog[0];

$userId = $mysql->query("SELECT `id` FROM `users` WHERE `login` = '$username';");
$userId = $userId->fetch_array();
$userId = $userId[0];

$status;

if ($hasFriend) {
    $status = $mysql->query("SELECT `friend_stat` FROM `f-$username-friends` WHERE `friend_id` = '$id';");
    $status = $status->fetch_array();
    $status = $status[0];
    switch ($status) {
        case 'subscriber':
            if ($position == "subs") {
                $mysql->query("DELETE FROM `f-$username-friends` WHERE `friend_id` = '$id';");
                $mysql->query("DELETE FROM `f-$friendLog-friends` WHERE `friend_id` = '$userId';");
                $mysql->close();
            } else {
                $mysql->query("UPDATE `f-$username-friends` SET `friend_stat` = 'friend' WHERE `friend_id` = '$id';");
                $mysql->query("UPDATE `f-$friendLog-friends` SET `friend_stat` = 'friend' WHERE `friend_id` = '$userId';");
                $mysql->close();
            }
            break;
        case 'following':
            $mysql->query("DELETE FROM `f-$username-friends` WHERE `friend_id` = '$id';");
            $mysql->query("DELETE FROM `f-$friendLog-friends` WHERE `friend_id` = '$userId';");
            $mysql->close();
            break;
        case 'friend':
            $mysql->query("UPDATE `f-$username-friends` SET `friend_stat` = 'subscriber' WHERE `friend_id` = '$id';");
            $mysql->query("UPDATE `f-$friendLog-friends` SET `friend_stat` = 'following' WHERE `friend_id` = '$userId';");
            $mysql->close();
            break;
        case 'bestfriend':
            $mysql->query("UPDATE `f-$username-friends` SET `friend_stat` = 'subscriber' WHERE `friend_id` = '$id';");
            $mysql->query("UPDATE `f-$friendLog-friends` SET `friend_stat` = 'following' WHERE `friend_id` = '$userId';");
            $mysql->close();
            break;
        case 'partner':
            $mysql->query("UPDATE `f-$username-friends` SET `friend_stat` = 'subscriber' WHERE `friend_id` = '$id';");
            $mysql->query("UPDATE `f-$friendLog-friends` SET `friend_stat` = 'following' WHERE `friend_id` = '$userId';");
            $mysql->close();
            break;
        default:
            echo 'Error: Penis';
            $mysql->close();
            break;
    }
} else {
    if ($position == "subs") {
        $mysql->query("INSERT INTO `f-$username-friends` (`id`, `friend_id`, `friend_stat`,`add_date`) VALUES (NULL, '$id', 'subscriber','$todayDate');");
        $mysql->query("INSERT INTO `f-$friendLog-friends` (`id`, `friend_id`, `friend_stat`,`add_date`) VALUES (NULL, '$userId', 'following','$todayDate');");
        $mysql->close();
    }
}

?>