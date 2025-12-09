<?php
session_start();
require('../node/vars.php');
$username = $_SESSION['login'];
$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
$subList = $mysql->query("SELECT `friend_id` FROM `f-$username-friends` WHERE `friend_stat` = 'subscriber';");
$subList = $subList->fetch_all();
if (count($subList) != 0) {
    for ($i = 0; $i < count($subList); $i++) {
        if (isset($subList[$i])) {
            $id = $subList[$i][0];
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
                            <div class='add-form'>
                                <button class='func-button add-friend-button notcancel-button' name='add'
                                    value='$id'>Добавить</button> 
                            </div>
                            <div class='del-form'>
                                <button class='func-button del-friend-button notcancel-button'
                                    value='$id' name='subs'>Отклонить</button> 
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