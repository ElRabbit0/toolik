<?php
session_start();
$_SESSION['page'] = 'Главная';
?>
<?php
require_once('./node/header.php');
$version = "Beta 1.0";
?>
<h1>ДОБРО ПОЖАЛОВАТЬ!</h1>
<div id="information">
    <p>Это рабочий сайт <b>El_Rabbito</b>.
        На данный момент сайт находится в разработке.
        Версия сайта <b><?php echo $version ?></b>.
        Жопа.
    </p>
</div>
<?php
require_once('./node/footer.php');
?>