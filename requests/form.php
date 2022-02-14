<?php 
    function parse(array $query = null): ?array {
        $params = null;

        foreach ($query as $key => $value) {
            switch ($key) {
                default:
                    $value = $_POST[$key];
                    break;
            }
            $params[$key] = $value;
        }

        return $params;
    }

    function applyTask(SQLite3 $db, array $params = []): bool {
        $query = "INSERT INTO tasks (description, priority, is_complete) VALUES (:description, :priority, \"1\")";
        $statement = $db -> prepare($query);
        foreach ($params as $param => $value) {
            $statement -> bindValue(":".$param, $value);
        }
        return (bool)$statement -> execute();
    }

?>