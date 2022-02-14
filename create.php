<?php
    require_once "requests/form.php";
    $db = new SQLite3("tasks.db");
    $is_executed = false;
    $error = null;

    if (count($_POST) > 0) {
        $params = parse($_POST);
        $is_executed = applyTask($db, $params);

        $_POST = array();
    }
?>

<!doctype html>
<html lang="ru">

<?php require_once "./partials/header.php" ?>

<body>
    <!-- Блок для var_dump() -->
    <!-- <pre> <?php var_dump($params) ?> </pre> -->

    <?php require_once "./partials/menu.php" ?>

    <!-- Блок для сообщения -->
    <?php if ($is_executed): ?>
        <?php require_once "partials/notification.php"; displayMessage($error); ?>
    <?php endif; ?>

    <h1>Добавить задачу</h1>
    <?php require_once "partials/form.php"; createTask(); ?>

    
</body>

</html>