<!DOCTYPE html>
<html lang="ru">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/account-login.css">
    <title>Login</title>
</head>

<body>
    <?php
    session_start();
    $_SESSION['message'];
    if (isset($_SESSION['iSlogin']) && $_SESSION['iSlogin'] == true) {
        header('location: ../index.php');
        exit();
    }
    ?>
    <h1 class="main-header">Toolик</h1>
    <div class="contain" id="login">
        <h2>Войти</h2>
        <form action="databaseGet.php" method="get">
            <div class="input-box">
                <input minlength="2" maxlength="20" type="text" name="username" id="username" required placeholder=""
                    value="<?php if (isset($_SESSION['login']))
                        echo $_SESSION['login'] ?>">
                    <label for="username">Имя пользователя</label>
                </div>
                <div class="input-box">
                    <input minlength="8" type="password" name="password" id="password" required placeholder="">
                    <label for="password">Пароль</label>
                </div>
                <div class="error" id="error-login"><?php if (isset($_SESSION['error-login']))
                        echo $_SESSION['error-login'] ?></div>
                <button type="submit" class="func-button">Войти</button>
            </form>
            <label class="label-click" for="">У вас нет аккаунта? <button class="js-button" id="log-but">Создайте
                    его!</button></label>
        </div>
        <div class="contain" id="create">
            <h2>Создаём вас:</h2>
            <form action="create-account.php" method="post">
                <div class="input-box">
                    <input minlength="2" maxlength="20" type="text" name="username" id="username" required placeholder="">
                    <label for="username">Имя пользователя</label>
                </div>
                <div class="input-box">
                    <input minlength="8" type="password" name="new-password" id="new-password" required placeholder="">
                    <label for="new-password">Пароль</label>
                </div>
                <div class="input-box">
                    <input minlength="8" type="password" name="ret-password" id="ret-password" required placeholder="">
                    <label for="ret-password">Повторите пароль</label>
                </div>
                <div class="info">
                    <p>Имя должно быть длиной от 2 до 20 символов</p>
                    <p>Пароль должен быть минимум 8 символов</p>
                    <p>Имя и пароль не должны содержать пробелов</p>
                </div>
                <div class="error" id="error-create"><?php if (isset($_SESSION['error-login']))
                        echo $_SESSION['error-login'] ?></div>
                <div id="message">
                <?php if ($_SESSION['message'] != '' && isset($_SESSION['message']))
                        echo $_SESSION['message'] ?>
                </div>
                <button type="submit" class="func-button">Создать</button>
            </form>
            <label class="label-click" for="">У вас есть аккаунт? <button class="js-button" id="create-but">Так
                    войдите!</button></label>
        </div>
        <script src="../js-scripts/form-swap-help.js"></script>
        <?php
                    $_SESSION['error-login'] = '';
                    $_SESSION['login'] = '';
                    $_SESSION['page'] = 'login-create';
                    $_SESSION['message'] = '';
                    ?>
</body>

</html>