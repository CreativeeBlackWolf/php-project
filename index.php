<?php
    $db = new SQLite3("tasks.db");
    require_once "requests/filter.php";
    if (count($_GET) > 0) {
        $params = parse($_GET);
        $tasks = search($db, $params);
    }
    else {
        $tasks = search($db);
    }
?>

<?php require_once "./partials/header.php"?>

<body>
    <!-- Блок для var_dump -->
    <!-- <pre> <?php ?> </pre> -->

    <?php require_once "./partials/menu.php"?>

    <form method="get" action="">
        <label>Описание задачи</label>
        <input type="text" name="description" value="<?php echo($_GET['description'] ?? null) ?>" >
        <label>Приоритет</label>
        <?php $priority = $_GET["priority"] ?? null ?>
        <select name="priority">
            <option <?=$priority == "all" ? "selected" : ""?> value=all>Все</option>
            <option <?=$priority == "1" ? "selected" : ""?> value=1>Низкий</option>
            <option <?=$priority == "2" ? "selected" : ""?> value=2>Обычный</option>
            <option <?=$priority == "3" ? "selected" : ""?> value=3>Высший</option>
        </select>
        <br>
        <label>Выполнение задачи</label>
        <?php $is_complete = $_GET["is_complete"] ?? null ?>
        <select name="is_complete">
            <option <?=$is_complete == "all" ? "selected" : ""?> value="all">Всё</option>
            <option <?=$is_complete == "2" ? "selected" : ""?> value=2>Сделано</option>
            <option <?=$is_complete == "1" ? "selected" : ""?> value=1>Не сделано</option>
        </select>
        <br>
        <div class="actions">
            <button type="submit">Искать</button>
        </div>
    </form>

    <!-- Для отображения списка задач -->
    <?php if ($tasks): ?>
        <h1>Задачи</h1>
            <?php 
                require_once "partials/task.php"; 
                foreach ($tasks as $task) { 
                    displayTask($task); 
                }
            ?>

    <?php else: ?>
        <!-- Если задач не найдено -->
        <h1>Задач не найдено</h1>
    <?php endif; ?>
</body>

</html>