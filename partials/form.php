<?php
    function createTask(array $errors = null, array $task = null) {

?>

<form method="POST" action="">
    <label>Описание задачи</label>
    <input type="text" name="description" placeholder="Что вы хотите сделать?" required>
    <!-- Блок для отображения ошибки -->
    <!-- <div class="validate-error">Текст ошибки</div> -->
    <br>
    <label>Приоритет</label>
    <?php $priority = $_POST["priority"] ?? null ?>
    <select name="priority">
        <option <?=$priority == "1" ? "selected" : ""?> value=1>Низкий</option>
        <option <?=$priority == "2" ? "selected" : ""?> value=2>Обычный</option>
        <option <?=$priority == "3" ? "selected" : ""?> value=3>Высший</option>
    </select>
    <br>
    <div class="actions">
        <button type="submit">Отправить</button>
    </div>
</form>

<?php } ?>