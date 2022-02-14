<?php

    function isArrayEmpty(array $array): bool {
        foreach ($array as $key => $value) {
            if(!empty($value) || $value != NULL || $value != "") {
                return false;
            }
        }
        return true;
    }

?>