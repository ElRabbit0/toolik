<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    session_start();
    require('../node/vars.php');
    if ($_SESSION['iSlogin'] != true) {
        header('location: /pages/account-login.php');
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/friends.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet">
    <title>Подсчёт часов</title>
    <?php
    require('./render.php');
    $today = date("Y-m-d");
    $_SESSION['message'];
    ?>
</head>

<body>
    <div id="func-but-panel">
        <button title="Назад" onclick="window.history.back();">↩</button>
        <div id="line-panel"></div><button id="go-main-but" title="На главную"
            onclick="window.location.href='/index.php'">🗲</button>
    </div>
    <div id="page">
        <h1 class="main-H1">Часы</h1>
        <div class="sec-form">
            <button id="js-key" class="func-button">Добавить часы</button>
            <form action="add-hours.php" method="post" id="hour-form">
                <label for="day">День: <input type="date" name="day" id="day" value="<?php
                if (isset($_SESSION['new_date']) && $_SESSION['new_date'] != '') {
                    echo $_SESSION['new_date'];
                } else {
                    echo $today;
                }
                ?>"></label>
                <label for="start">Начало работы: <input required type="time" name="start" id="start"></label>
                <label for="stop">Конец работы: <input required type="time" name="stop" id="stop"></label>
                <button type="submit" class="func-button" id="save-hour">Сохранить</button>
            </form>
            <div id="error">
                <?php
                if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
                    echo "Ошибка: " . $_SESSION['error'];
                }
                ?>
            </div>
            <div id="message">
                <?php
                if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
                    echo $_SESSION['message'];
                }
                ?>
            </div>
        </div>
        <div class="show">
            <h2>Мои часы в этом месяце</h2>
            <div class="first">
                <h3>За первую половину месяца</h3>
                <div class="list">
                    <?php render($thisMouthFirst) ?>
                </div>
            </div>
            <div class="second">
                <h3>За вторую половину месяца</h3>
                <div class="list">
                    <?php render($thisMouthSecond) ?>
                </div>
            </div>
        </div>
        <div class="show">
            <h2>Мои часы в прошлом месяце</h2>
            <div class="first">
                <h3>За первую половину месяца</h3>
                <div class="list">
                    <?php render($lastMouthFirst) ?>
                </div>
            </div>
            <div class="second">
                <h3>За вторую половину месяца</h3>
                <div class="list">
                    <?php render($lastMouthSecond) ?>
                </div>
            </div>
        </div>
        <script src="../js-scripts/form-hide.js"></script>
    </div>
    <script src="../js-scripts/mobile-header.js"></script>
    <script src="../js-scripts/header-in-footer.js"></script>
</body>

</html>
<?php
if ((isset($_SESSION['error']) && $_SESSION['error'] != '') || (isset($_SESSION['new_date']) && $_SESSION['new_date'] != '')) {
    echo "<script>hideForm()</script>";
}
$_SESSION['error'] = '';
$_SESSION['message'] = '';
$_SESSION['new_date'] = '';
$mysql->close();
require_once('../node/footer.php');
?>