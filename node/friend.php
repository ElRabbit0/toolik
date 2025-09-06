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
        <div class="del-friend">
            <form action="/pages/logout.php" method="post" id="quit-form">
                <button class="func-button" type="submit" name="run_script " id="quit-button"
                    value="<?php $friendId ?>">Удалить</button>
            </form>
        </div>
    </div>
</div>