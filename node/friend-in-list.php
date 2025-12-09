<div class="friend-node">
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
                value="<?php echo $friendIdUsers ?>">Статус</button> <!-- Поменять -->
        </form>
        <div class="del-form">
            <button class="func-button del-friend-button notcancel-button" value="<?php echo $friendIdUsers ?>"
                name="list">Удалить</button>
        </div>
    </div>
</div>