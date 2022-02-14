<?php
    function displayMessage($error = null) {
?>
<div class="message">
    <?php if (is_null($error)): ?>
        Задача добавлена успешно!
    <?php else: ?>
        <?= $error ?>
    <?php endif; ?>
</div>

<?php } ?>