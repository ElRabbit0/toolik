<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    session_start();
    require('../node/vars.php');

    $mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
    $mysql->close();
    // friend, bestfriend, partner, subscriber, following
// систему приглашений и сверстай страницу
// test
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/friends.css">
    <title>Document</title>

</head>

<body>
    <div id="func-but-panel">
        <button title="Назад" onclick="window.history.back();">↩</button>
        <div id="line-panel"></div><button id="go-main-but" title="На главную"
            onclick="window.location.href='/index.php'">🗲</button>
    </div>
    <div id="page">
        <header id="page-header">
            <button class="page-header-button" id="friend-but">Мои друзья</button>
            <div id="line-header"></div><button class="page-header-button" id="request-but">Заявки</button>
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
                <form action="" id="search-form-real">
                    <input type="text" name="search-name" placeholder="Введите имя пользователя..."><button
                        type="submit" value="search-form" title="Поиск">🔍️</button>
                </form>
                <div id="search-list">
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
                            <form action="/pages/logout.php" method="post" class="add-form">
                                <button class="func-button add-friend-button" type="submit" name="add"
                                    value="">Добавить</button> <!-- Поменять -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="h-open" id="subscriber-list-open">Поступающие заявки</h1>
            <div id="subscriber-list">
                <span class="exit" id="subscriber_list_exit">X</span>
                <div id="subscriber-list-div">
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
                            <form action="/pages/logout.php" method="post" class="add-form">
                                <button class="func-button add-friend-button" type="submit" name="add"
                                    value="">Добавить</button> <!-- Поменять -->
                            </form>
                            <form action="/pages/logout.php" method="post" class="del-form">
                                <button class="func-button del-friend-button" type="submit" name="no"
                                    value="">Отклонить</button> <!-- Поменять -->
                            </form>
                        </div>
                    </div>
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