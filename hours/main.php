<?php
session_start();
$_SESSION['page'] = 'Подсчёт часов';
require_once('../node/header.php');
?>
<?php
require('./render.php');
$today = date("Y-m-d");
$_SESSION['message'];
?>
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

<?php
if ($_SESSION['error'] != '' || $_SESSION['new_date'] != '') {
    echo "<script>hideForm()</script>";
}
$_SESSION['error'] = '';
$_SESSION['message'] = '';
$_SESSION['new_date'] = '';
$mysql->close();
require_once('../node/footer.php');
?>