<!DOCTYPE html>
<html lang="ru">

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../js-scripts/fr-ajax-search.js" type="module"></script>
    <script src="../js-scripts/fr-ajax-add-friend.js" type="module"></script>
    <script src="../js-scripts/fr-ajax-subs.js" type="module"></script>
    <script src="../js-scripts/fr-ajax-friend-list.js" type="module"></script>
    <script src="../js-scripts/fr-ajax-helper.js" type="module"></script>
    <script src="../js-scripts/fr-ajax-fol.js" type="module"></script>
    <script src="../js-scripts/fr-ajax-edit.js" type="module"></script>
    <?php
    session_start();
    require('../node/vars.php');

    $mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
    $mysql->close();
    if ($_SESSION['iSlogin'] != true) {
        header('location: /pages/account-login.php');
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/friends.css">
    <link rel="shortcut icon" href="../img/pages-icon.png" />
    <title>Friends</title>

</head>

<body>
    <div id="func-but-panel">
        <button id="back-button" title="Назад" onclick="window.history.back();">↩</button>
        <div id="line-panel"></div><button id="go-main-but" title="На главную"
            onclick="window.location.href='/index.php'">🗲</button>
    </div>
    <div id="page">
        <header id="page-header">
            <button class="page-header-button" id="friend-but">Мои друзья</button>
            <div id="line-header"></div><button class="page-header-button" id="request-but">Другое</button>
        </header>
        <div class="page-container" id="friend-list-container">
            <h1>Ваши друзья</h1>
            <div id="friend-list">
                <?php
                require('./render-my-friend.php');
                ?>
            </div>
        </div>
        <div class="page-container" id="request-list-container">
            <h1 class="h-open" id="search-form-open">Найти друга</h1>
            <div id="search-form">
                <span class="exit" id="search_form_exit">X</span>
                <div id="search-form-real">
                    <input type="text" name="search-name" class="search-name"
                        placeholder="Введите имя пользователя или код...">
                    <button class="go-search" type="submit" value="search-form" title="Поиск">🔍️</button>
                </div>
                <div id="search-list">

                </div>
            </div>
            <h1 class="h-open" id="subscriber-list-open">Поступающие заявки</h1>
            <div id="subscriber-list">
                <span class="exit" id="subscriber_list_exit">X</span>
                <div id="subscriber-list-div">

                </div>
            </div>
            <h1 class="h-open" id="following-list-open">Отправленные заявки</h1>
            <div id="following-list">
                <span class="exit" id="following_list_exit">X</span>
                <div id="following-list-div">
                    <div class="has">
                        <div class="account-icon">
                            <img class="not-icon" src="../img/icon.png" alt="">
                        </div>
                        <div class="account-nickname">
                            <div class="nickname-in">
                                Nickname
                            </div>
                        </div>
                        <div class="buttons-friend">
                            <form action="/pages/logout.php" method="post" class="del-form">
                                <button class="func-button del-friend-button" type="submit" name="delete"
                                    value="">Отменить</button> <!-- Поменять -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js-scripts/main-friend.js"></script>
</body>

</html>