<?php 
    function displayTask(array $task = []) {
?>

<div class="task">
    <ul class="actions">
        <li><a href="">Редактировать</a></li>
        <li><a href="">Удалить</a></li>
    </ul>
    Описание: <?= $task["description"]?> <br>
    Приоритет: <?= $task["priority"] ?> <br>
    Выполнение: <font color = <?= $task["is_complete"] == "1" ? "#FC0000" : "#3cff00"?>> <?= $task["is_complete"] == "1" ? "Не сделано" : "Сделано"?> </font> <br>
</div>

<?php } ?>