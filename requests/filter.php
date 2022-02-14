<?php
    require_once "utils.php";

    function parse(array $query = null): ?array {
        $params = null;

        foreach ($query as $key => $value) {
            switch ($key) {
                // кейсы на случай дальнейшей доработки условий.
                case "priority":
                    $value = $_GET[$key] == "all" 
                    ? null
                    : $_GET[$key];
                    break;
                case "is_complete":
                    $value = $_GET[$key] == "all"
                    ? null
                    : $_GET[$key];
                    break;
                case "description":
                    $value = $_GET[$key] == ""
                    ? null
                    : $_GET[$key];
                    break;
                default:
                    $value = $_GET[$key] == ""
                    ? null
                    : $_GET[$key];
                    break;
            }
            $params[$key] = $value;
        }

        return $params;
    }

    function search(SQLite3 $db, array $params = []): ?array {
        $found = [];

        $query = "SELECT * FROM tasks";

        if (!isArrayEmpty($params)){
            $query .= " WHERE";
            foreach ($params as $param => $paramValue) {
                if (!is_null($paramValue)) {
                    $query .= " {$param} = \"{$paramValue}\" AND";
                }
            }
            $query = substr($query, 0, -4);
        }

        $result = $db->query($query);
        if ($result) {
            while ($row = $result->fetchArray()) {
                $found[] = $row;
            }
        }

        return $found;
    }
?>