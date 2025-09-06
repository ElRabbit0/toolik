<div class="node">
    <p class="node-header"><b>День:</b> <?php echo $date ?></p>
    <div class="info">
        <?php
        if ($isSet) {

            echo "<p><b>Начало:</b> $start <b class='line'>|</b></p>";
            echo "<p><b> Конец:</b> $stop</p>";
            echo "<p class='hours'><b>Часов:</b> $hours ч</p>";
            require 'delete-button.php';
        } else {
            echo "<p class='not'><b>:(</b></p>";
            echo "<p class='not'><b>Неизвестно</b></p>";
            require 'add-button.php';
        }
        ?>
    </div>
</div>