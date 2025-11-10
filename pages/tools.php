<?php
session_start();
$_SESSION['page'] = 'Инструменты';
require_once('../node/header.php');
?>
<h1>Все инструменты:</h1>
<div id="information">
    <button class="func-button" onclick="window.location.href='/hours/main.php'">
        Часы
    </button>
    <button class="func-button" onclick="window.location.href='../no.php'">
        Одежда
    </button>
    <button class="func-button" onclick="window.location.href='../no.php'">
        Списки
    </button>
    <button class="func-button" onclick="window.location.href='../no.php'">
        Планировщик
    </button>
    <button class="func-button" onclick="window.location.href='../no.php'">
        События
    </button>
</div>
<?php
require_once('../node/footer.php');
?>