<?php
session_start();
require('../node/vars.php');
$username = $_SESSION['login'];
$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
$folList = $mysql->query("SELECT `friend_id` FROM `f-$username-friends` WHERE `friend_stat` = 'following';");
$folList = $folList->fetch_all();
if (count($folList) != 0) {
    for ($i = 0; $i < count($folList); $i++) {
        if (isset($folList[$i])) {
            $id = $folList[$i][0];
            $friendIcon = $mysql->query("SELECT `icon` FROM `users` WHERE `id` = '$id';");
            $friendIcon = $friendIcon->fetch_assoc();
            $friendIcon = $friendIcon['icon'];
            $friendNickname = $mysql->query("SELECT `nickname` FROM `users` WHERE `id` = '$id';");
            $friendNickname = $friendNickname->fetch_assoc();
            $friendNickname = $friendNickname['nickname'];
            if ($friendIcon != '' && $friendIcon != ' ') {
                $img = '<img class="user-icon" src="' . $targetDirIcon . $friendIcon . '" alt="">';
            } else {
                $img = '<img class="not-icon" src="../img/icon.png" alt="">';
            }
            echo "<div class='has'>
                        <div class='account-icon'>
                            $img
                        </div>
                        <div class='account-nickname'>
                            <div class='nickname-in'>
                                $friendNickname
                            </div>
                        </div>
                        <div class='buttons-friend'>
                            <div class='del-form'>
                                <button class='func-button del-friend-button notcancel-button'
                                    value='$id' name='fol'>Отписаться</button> 
                            </div>
                        </div>
                    </div>";
        }
    }
} else {
    echo 'No';
}
$mysql->close();
?>