<div class="friend">
    <div class="has">
        <div class="account-icon">
            <?php
            if ($friendIcon != '' && $friendIcon != ' ') {
                echo '<img class="user-icon" src="' . $targetDirIcon . $friendIcon . '" alt="">';
            } else {
                echo '<img class="not-icon" src="../img/icon.png" alt="">';
            }
            ?>
        </div>
        <div class="account-nickname">
            <div class="nickname-in">
                <?php
                echo $friendNickname;
                ?>
            </div>
            <div class="status-in">
                <span>Статус: </span><?php
                echo $friendStat;
                ?>
            </div>
            <div class="date-in">
                <span>Начало дружбы: </span><?php
                echo $friendDate;
                ?>
            </div>
        </div>
        <div class="buttons-friend">
            <form action="/pages/logout.php" method="post" class="add-form">
                <button class="func-button black-button" type="submit" name="status"
                    value="<?php $friendId ?>">Статус</button> <!-- Поменять -->
            </form>
            <form action="/pages/logout.php" method="post" class="del-form">
                <button class="func-button del-friend-button" type="submit" name="run_script "
                    value="<?php $friendId ?>">Удалить</button>
            </form>
        </div>
    </div>
</div>