<?php
session_start();
require('../node/vars.php');
$username = $_SESSION['login'];
$searchUser = $_POST['name'];
$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
$userList = $mysql->query("SELECT `id`,`nickname`,`icon` FROM `users` WHERE `login` != '$username' AND (`nickname` = '$searchUser' OR `id` = '$searchUser');");
$userList = $userList->fetch_all();

if (!isset($userList[0])) {
    $userList = $mysql->query("SELECT `id`,`nickname`,`icon` FROM `users` WHERE `login` != '$username' AND (SOUNDEX(nickname) = SOUNDEX('$searchUser') OR `id` = '$searchUser');");
    $userList = $userList->fetch_all();
}
if (isset($userList[0])) {
    $has = $mysql->query("SELECT `friend_id` FROM `f-$username-friends` ORDER BY `id` ASC;");
    $has = $has->fetch_all();
    $hasStat = $mysql->query("SELECT `friend_stat` FROM `f-$username-friends` ORDER BY `id` ASC;");
    $hasStat = $hasStat->fetch_all();
    $hasArray[0] = -1;
    $hasStatArray[0] = -1;
    for ($j = 0; $j < count($has); $j++) {
        $hasArray[$j] = $has[$j][0];
        $hasStatArray[$j] = $hasStat[$j][0];
    }
    for ($i = 0; $i < count($userList); $i++) {
        $id = $userList[$i][0];
        if (array_search($id, $hasArray) != false || $hasArray[0] == $id) {
            $idStat = array_search($id, $hasArray);
            if ($hasStatArray[$idStat] == 'following') {
                $userList[$i][3] = 'cancel-button';
            } else if ($hasStatArray[$idStat] != 'subscriber') {
                unset($userList[$i]);
                $userList = array_values($userList);
                $i = -1;
            }
        }
    }
}
if (isset($userList[0])) {
    for ($i = 0; $i < count($userList); $i++) {
        $id = $userList[$i][0];
        $nickname = $userList[$i][1];
        if (isset($userList[$i][2]) && $userList[$i][2] != '') {
            $img = "../user-icon/" . $userList[$i][2];
            $imgStyle = "user-icon";
        } else {
            $img = "../img/icon.png";
            $imgStyle = "not-icon";
        }
        if (isset($userList[$i][3]) && $userList[$i][3] != '') {
            $button = $userList[$i][3];
            $buttonText = "Отмена";
        } else {
            $button = "notcancel-button";
            $buttonText = "Добавить";
        }
        echo "<div class='has'>
                        <div class='account-icon'>
                            <img class='$imgStyle' src='$img'>
                        </div>
                        <div class='account-nickname'>
                            <div class='nickname-in'>
                                $nickname
                            </div>
                        </div>
                        <div class='buttons-friend'>
                            <div class='add-form'>
                                <button class='func-button add-friend-button $button' name='add'
                                    value='$id'>$buttonText</button> 
                            </div>
                        </div>
                    </div>";
    }
} else {
    echo "No";
}
$mysql->close();
?>