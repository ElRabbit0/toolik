<!DOCTYPE html>
<html lang="ru">

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="shortcut icon" href="../img/pages-icon.png" />
    <script src="../js-scripts/fr-ajax-helper.js" type="module"></script>
    <script src="../js-scripts/fr-ajax-delete.js" type="module"></script>
    <script src="../js-scripts/acc-ajax-delet.js" type="module"></script>
    <script src="../js-scripts/acc-ajax-edit.js" type="module" defer></script>
    <?php
    session_start();
    $_SESSION['page'] = 'Account';
    require('../node/vars.php');
    ?>
    <title><?php echo $_SESSION['page'] ?></title>
</head>

<body>
    <?php
    clearstatcache();
    $username = $_SESSION['login'];
    $mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
    $res = $mysql->query("SELECT `registr` FROM `users` WHERE `login` = '$username'");
    $dateRegistr = $res->fetch_assoc();
    $mysql->close();
    $dateRegistr = $dateRegistr['registr'];
    $dateRegistr = new DateTime($dateRegistr);
    $dateRegistr = $dateRegistr->format('d.m.Y');
    ?>
    <button title="Назад" class="func-button back black-button" onclick="window.history.back();">
        ↩ </button>
    <div id="page-account">
        <div class="info-acc">
            <div class="info-icon">
                <div id="colhoz">
                    <div class="icon-div">
                        <?php
                        if ($_SESSION['icon'] != '' && $_SESSION['icon'] != ' ') {
                            echo '<img class="user-icon" src="' . $targetDirIcon . $_SESSION['icon'] . '" alt="">';
                        } else {
                            echo '<img src="../img/icon.png" alt="">';
                        }
                        ?>
                    </div>
                    <button class="func-button black-button" id="icon-button">Изменить</button>
                </div>
                <form action="../pages/account-setting.php" enctype="multipart/form-data" method="post" id="icon-form">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                    <input type="file" name="file" id="input__file" required>
                    <label for="input__file" id="inp">Выберите файл</label>
                    <button class="func-button" type="submit" name="form" value="icon">Добавить</button>
                </form>
            </div>
            <div class="info-name">
                <h1 id="your-nickname"><?php
                if (isset($_SESSION['nickname']) && $_SESSION['nickname'] != '') {
                    echo $_SESSION['nickname'];
                } else {
                    echo 'Имени нет';
                }
                ?></h1>
                <button class="func-button black-button" id="name-button">Изменить</button>
                <form action="../pages/account-setting.php" method="post" id="nickname-form">
                    <input type="text" name="newnickname" id="nickname" placeholder="Твоё новое имя" required>
                    <button class="func-button" type="submit" name="form" value="nickname">Добавить</button>
                </form>
                <h2><?php echo $username ?></h2>
            </div>
            <div class="info-stat">
                <p><b>Дата регистрации:</b></p>
                <p><?php echo $dateRegistr ?></p>
            </div>
        </div>
        <div class="edit-pass">
            <button class="func-button black-button" id="edit-pass-button">Изменить пароль</button>
            <form action="../pages/account-setting.php" method="post" id="password-form">
                <div class="input-box">
                    <label for="old-password">Введите ваш старый пароль</label>
                    <input minlength="8" type="text" name="old-password" id="old-password" required placeholder=""
                        required>
                </div>
                <div class="input-box">
                    <label for="new-password">Новый пароль</label>
                    <input minlength="8" type="text" name="new-password" id="new-password" required placeholder=""
                        required>
                </div>
                <div class="input-box">
                    <label for="ret-password">Повторите новый пароль</label>
                    <input minlength="8" type="text" name="ret-password" id="ret-password" required placeholder=""
                        required>
                </div>
                <button class="func-button" type="submit" name="form" value="pwd">Изменить</button>
            </form>
            <div id="error">
                <?php
                if (isset($_SESSION['error']) && $_SESSION['error'] != '' && $_SESSION['error'] != ' ') {
                    echo $_SESSION['error'];
                }
                ?>
            </div>
            <div id="message">
                <?php
                if ($_SESSION['message'] != '' && $_SESSION['message'] != ' ') {
                    echo $_SESSION['message'];
                }
                ?>
            </div>
        </div>
        <div class="friend-div">
            <h1>Ваши друзья</h1>

            <div class="more-button">
                <button class="func-button black-button"
                    onclick="window.location.href='../friends/main.php'">Больше</button>
            </div>
        </div>
        <div id="quit">
            <form action="/pages/logout.php" method="post" id="quit-form">
                <button class="func-button" type="submit" name="run_script " id="quit-button">Выйти</button>
            </form>
        </div>
    </div>
    <script src="../js-scripts/account.js"></script>
    <?php
    $_SESSION['message'] = '';
    $_SESSION['error'] = '';
    ?>
</body>

</html>