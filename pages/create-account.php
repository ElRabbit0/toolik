<?php
session_start();
require('../node/vars.php');
$_SESSION['login'] = '';
$_SESSION['nickname'] = '';
$username = $_POST["username"];
$_SESSION['error-login'] = '';
$password = md5($_POST["new-password"]);
$retpassword = md5($_POST["ret-password"]);
$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
$_SESSION['page'] = 'create';

function errorWrite($errorText)
{
    $_SESSION['error-login'] = $errorText;
    header('location: /pages/account-login.php');
    exit;
}

$res = $mysql->query("SELECT * FROM `users` WHERE `login` = '$username'");
if ($res->num_rows == 0) {
    if (2 <= strlen($username) && substr_count($username, " ") == 0 && strlen($username) <= 20 && strlen($password) >= 8 && $password == $retpassword) {
        echo "Okey" . '<br>';
        $todayDate = date('Y-m-d');
        $mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
        $mysql->query("INSERT INTO `users` (`id`, `login`, `password`,`nickname`, `icon`, `registr`) VALUES (NULL, '$username', '$password','', '','$todayDate');");
        $res = $mysql->query("SELECT `id` FROM `users` WHERE `login` = '$username'");
        $id = $res->fetch_assoc();
        $id = $id['id'];
        $mysql->query("UPDATE `users` SET `nickname` = 'user-$id' WHERE `login` = '$username';");
        createFriendTable();
        $_SESSION['message'] = '';
        $res = $mysql->query("SELECT * FROM `users` WHERE `login` = '$username'");
        $user = $res->fetch_assoc();
        $_SESSION['iSlogin'] = true;
        $_SESSION['login'] = $username;
        if (isset($user['nickname']) && $user['nickname'] != '') {
            $_SESSION['nickname'] = $user['nickname'];
        } else {
            $_SESSION['nickname'] = '';
        }
        if (isset($user['icon']) && $user['icon'] != '') {
            $_SESSION['icon'] = $user['icon'];
        } else {
            $_SESSION['icon'] = '';
        }
        $_SESSION['page'] = 'login';
        $mysql->close();
        header('location: ../index.php');
    } else if (2 > strlen($username) || strlen($username) > 20) {
        errorWrite('Имя пользователя неправильного размера');

    } else if (substr_count($username, " ") != 0) {
        errorWrite('Имя пользователя содержит пробелы');

    } else if (strlen($password) < 8) {
        errorWrite('Короткий пароль');

    } else if ($password != $retpassword) {
        errorWrite('Пароли не совпадают');

    }
} else {
    errorWrite('Пользователь с таким именем существует');

}

function createFriendTable()
{
    global $hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL, $username;
    $mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
    $mysql->query("CREATE TABLE IF NOT EXISTS `f-$username-friends`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    friend_id INT NOT NULL,
    friend_stat VARCHAR(20),
    add_date DATE
    )");
    $mysql->query("ALTER TABLE `f-$username-friends` ADD FOREIGN KEY (`friend_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;");
    $mysql->close();
}
?>