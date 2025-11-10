<?php
session_start();
require('../node/vars.php');
$username = $_SESSION['login'];
$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
$friendList = $mysql->query("SELECT * FROM `f-$username-friends` WHERE `friend_stat` = 'partner';");
$friendList = $friendList->fetch_all();
$additionList = $mysql->query("SELECT * FROM `f-$username-friends` WHERE `friend_stat` = 'bestfriend';");
$additionList = $additionList->fetch_all();
$friendList = array_merge($friendList, $additionList);
$additionList = $mysql->query("SELECT * FROM `f-$username-friends` WHERE `friend_stat` = 'friend';");
$additionList = $additionList->fetch_all();
$friendList = array_merge($friendList, $additionList);
if (count($friendList) != 0) {
    for ($i = 0; $i < count($friendList); $i++) {
        if (isset($friendList[$i])) {
            $friendDate = $friendList[$i][3];
            $friendDate = new DateTime($friendDate);
            $friendDate = $friendDate->format('d.m.Y');
            $friendId = $friendList[$i][0];
            $friendStat = $friendList[$i][2];
            switch ($friendStat) {
                case 'friend':
                    $friendStat = 'друг';
                    break;
                case 'bestfriend':
                    $friendStat = 'лучший друг';
                    break;
                case 'partner':
                    $friendStat = 'в отношениях';
                    break;
            }
            $friendIdUsers = $friendList[$i][1];
            $friendIcon = $mysql->query("SELECT `icon` FROM `users` WHERE `id` = '$friendIdUsers';");
            $friendIcon = $friendIcon->fetch_assoc();
            $friendIcon = $friendIcon['icon'];
            $friendNickname = $mysql->query("SELECT `nickname` FROM `users` WHERE `id` = '$friendIdUsers';");
            $friendNickname = $friendNickname->fetch_assoc();
            $friendNickname = $friendNickname['nickname'];

            require('../node/friend-in-list.php');
        }
    }
} else {
    echo '<div class="friend">
                        <h1>Тут пусто :(</h1>
                    </div>';
}

$mysql->close();
?>