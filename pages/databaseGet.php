<?php
session_start();
require('../node/vars.php');
$username = $_GET["username"];
$password = md5($_GET["password"]);

$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
$res = $mysql->query("SELECT * FROM `users` WHERE `login` = '$username'");
$user = $res->fetch_assoc();
$_SESSION['error-login'] = '';
$_SESSION['login'] = '';
$_SESSION['nickname'] = '';
$_SESSION['page'] = 'login';

function errorWrite($errorText)
{
    $_SESSION['error-login'] = $errorText;
    header('location: /pages/account-login.php');
    exit;
}

if ($res->num_rows > 0 && $user['password'] == $password) {
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
    header('location: ../index.php');
    $mysql->close();
    exit;
} else if ($res->num_rows < 1) {
    $mysql->close();
    errorWrite('Такого пользователя нет');
} else if ($res->num_rows > 0) {
    if ($user['password'] != $password) {
        $_SESSION['login'] = $_GET["username"];
        $mysql->close();
        errorWrite('Неверный пароль');
    }
}

?>