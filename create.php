<?php
    $db = new SQLite3("tasks.db");
    $is_executed = false;

    if (count($_POST) > 0) {
        $description = $_POST["description"] == ""
        ? null 
        : $_POST["description"];

        $priority = $_POST["priority"];

        $is_complete = (string)random_int(1, 2);

        $stmt = $db->prepare("INSERT INTO tasks(description, priority, is_complete) VALUES (:desc, :priority, :completion)");
        $stmt->bindParam(":desc", $description);
        $stmt->bindParam(":priority", $priority);
        $stmt->bindParam(":completion", $is_complete);
        $is_executed = $stmt->execute();

        $_POST = array();
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
    <!-- Блок для var_dump() -->
    <!-- <pre> <?php ?> </pre> -->

    <nav>
        <li><a href="/index.php">Все задачи</a></li>
        <li><a href="/create.php">Добавить</a></li>
    </nav>

    <!-- Блок для сообщения -->
    <?php if ($is_executed): ?>
        <div class="message">
            Задача добавлена успешно! (для наглядности выполнение/не выполнение для задач случайное)
        </div>
    <?php endif; ?>

    <h1>Добавить задачу</h1>

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
</body>

</html>