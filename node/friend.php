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
                <span>Статус: </span>
                <p style="display: inline">
                    <?php
                    echo $friendStat;
                    ?>
                </p>
            </div>
            <div class="date-in">
                <span>Начало дружбы: </span><?php
                echo $friendDate;
                ?>
            </div>
        </div>
        <div class="buttons-friend">
            <div class="add-form">
                <button class="func-button black-button edit-button" name="<?php echo $friendStatValue; ?>"
                    value="<?php echo $friendIdUsers ?>">Изменить</button>
            </div>
            <div class="del-form">
                <button class="func-button del-friend-button notcancel-button" name="account"
                    value="<?php echo $friendIdUsers ?>">Удалить</button>
            </div>
        </div>
    </div>
</div>