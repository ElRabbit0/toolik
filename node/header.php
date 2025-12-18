<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    session_start();
    require('vars.php');
    if ($_SESSION['iSlogin'] != true) {
        header('location: /pages/account-login.php');
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet">
    <title><?php if (isset($_SESSION['page'])) {
        echo $_SESSION['page'];
    } else {
        echo 'Страница';
    } ?></title>
    <?php
    if (isset($_SESSION['page']) && $_SESSION['page'] == 'Главная') {
        echo '<link rel="stylesheet" href="../styles/index.css">';
    }
    ?>
</head>

<body>
    <header id="real-header">
        <div id="header-logo" onclick="window.location.href='/index.php'">
            Toolик
        </div>
        <div id="header-menu">
            <button class="menu-button" onclick="window.location.href='../no.php'">
                Лента
            </button>
            <button class="menu-button" onclick="window.location.href='../no.php'">
                Чаты
            </button>
            <button class="menu-button" onclick="window.location.href='../pages/tools.php'">
                Инструменты
            </button>
            <button class="menu-button" onclick="window.location.href='../no.php'">
                Игры
            </button>
        </div>
        <div id="header-account" onclick="window.location.href='/pages/account.php'">
            <div id="account-name">
                <?php
                if (isset($_SESSION['nickname']) && $_SESSION['nickname'] != '') {
                    echo "<p id='nickname'>" . $_SESSION['nickname'] . '</p>';
                    echo "<p id='login'>" . $_SESSION['login'] . '</p>';
                } else {
                    echo "<p id='not-nickname'>" . $_SESSION['login'] . '</p>';
                }
                ?>
            </div>
            <div id="account-icon">
                <?php
                if ($_SESSION['icon'] != '' && $_SESSION['icon'] != ' ') {
                    echo '<img class="user-icon" src="' . $targetDirIcon . $_SESSION['icon'] . '" alt="">';
                } else {
                    echo '<img src="../img/icon.png" alt="">';
                }
                ?>
            </div>
        </div>
        <div id="header-button">

        </div>
    </header>
    <div id="page">