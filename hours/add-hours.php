<?php
session_start();
require('../node/vars.php');
$userLogin = $_SESSION['login'];
$start = new DateTime($_POST['start']);
$stop = new DateTime($_POST['stop']);
$day = $_POST['day'];
$hours = date_diff($stop, $start);
$okay = ($stop > $start);
$start = $start->format('H:i');
$stop = $stop->format('H:i');
$hours = $hours->format('%H');
$_SESSION['error'] = '';
$_SESSION['message'] = '';


$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);


function backToMain($text)
{
    if ($text != '') {
        $_SESSION['error'] = $text;
    }
    header('location: /hours/main.php');
}

$res = $mysql->query("SELECT * FROM `0_hours` WHERE `login` = '$userLogin' AND `day` = '$day'");
if ($res->num_rows < 1 && $hours > 0 && $okay == 1) {
    $mysql->query("INSERT INTO `0_hours` (`id`, `login`, `start`, `stop`, `day`, `hours`) VALUES (NULL, '$userLogin', '$start', '$stop', '$day', '$hours');");
    $_SESSION['message'] = 'Успешно!';
    backToMain('');
    $mysql->close();
} else if ($res->num_rows > 0) {
    backToMain('Запись за этот день уже есть');
} else if ($hours < 1) {
    backToMain('Ты не мог отработать ровно 24 часа...');
    $mysql->close();
} else if ($okay != 1) {
    backToMain('Что то по часам не сходится...');
    $mysql->close();
}
?>