<?php
    $db = new SQLite3("tasks.db");

    // $tasks = $db->query("SELECT * FROM tasks WHERE priority = {$priority}")->fetchArray()
    if (count($_GET) > 0) {
        $description = $_GET["description"] == ""
        ? null 
        : $_GET["description"];

        $priority = $_GET["priority"] == "all"
        ? null
        : $_GET["priority"];

        $is_complete = $_GET["is_complete"] == "all"
        ? null
        : $_GET["is_complete"];

        $query = "SELECT * FROM tasks";
        
        if ($description || $is_complete || $priority) {
            $query = $query . " WHERE";
            if ($is_complete) $query = $query . " is_complete = \"{$is_complete}\" AND";
            if ($description) $query = $query . " description = \"{$description}\" AND";
            if ($priority) $query = $query . " priority = \"{$priority}\"";

            if (str_ends_with($query, "AND"))
                $query = substr($query, 0, -4);
        }

        $tasks = [];
        $result = $db->query($query);
        if ($result) {
            while ($row = $result->fetchArray()) {
                $tasks[] = $row;
            }
        }
    }
    else {
        $tasks = [];
        $result = $db->query("SELECT * FROM tasks");
        if ($result) {
            while ($row = $result->fetchArray()) {
                $tasks[] = $row;
            }
        }
    }
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo List</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h1 {
            text-align: center;
        }

        nav {
            background: #666;
            text-align: center;
            margin-bottom: 24px;
        }

        nav li {
            display: inline-block;
            margin: 8px;
        }

        nav li a {
            color: white;
        }

        .task {
            background: #eee;
            width: 500px;
            margin: 8px auto 8px;
            padding: 16px;
        }

        .task .actions {
            background: #d9d9d9;
            text-align: right;
        }

        .task .actions {
            margin: 0 0 8px 0;
            padding: 4px;
        }

        .task .actions li {
            display: inline-block;
            margin: 0 4px;
        }

        .task .actions li a {
            font-size: 12px;
        }

        .message {
            width: 500px;
            padding: 16px;
            margin: 0 auto 16px auto;
            background: #ddddff;
        }

        form {
            background: #eee;
            width: 500px;
            margin: 0 auto 24px auto;
            padding: 16px;
            border: 1px solid #e6e6e6;
        }

        form label {
            display: inline-block;
            width: 200px;
        }

        form button {
            margin-top: 16px;
            padding: 8px 16px;
            background: blue;
            color: white;
            border: none;
        }

        form .validate-error {
            background: red;
            color: white;
            font-size: 10px;
        }

        form .actions {
            text-align: center;
        }

        pre {
            background: #ddd;
            padding: 8px;
            font-family: monospace;
        }
    </style>
</head>

<body>
    <!-- Блок для var_dump -->
    <!-- <pre> <?php ?> </pre> -->

    <nav>
        <li><a href="/index.php">Все задачи</a></li>
        <li><a href="/create.php">Добавить</a></li>
    </nav>

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
            <?php foreach ($tasks as $task): ?>
                <div class="task">
                    <ul class="actions">
                        <li><a href="">Редактировать</a></li>
                        <li><a href="">Удалить</a></li>
                    </ul>
                    Описание: <?= $task["description"]?> <br>
                    Приоритет: <?= $task["priority"] ?> <br>
                    Выполнение: <font color = <?= $task["is_complete"] == "1" ? "#FC0000" : "#3cff00"?>> <?= $task["is_complete"] == "1" ? "Не сделано" : "Сделано"?> </font> <br>
                </div>
            <?php endforeach; ?>
    <?php else: ?>
        <!-- Если задач не найдено -->
        <h1>Задач не найдено</h1>
    <?php endif; ?>
</body>

</html>