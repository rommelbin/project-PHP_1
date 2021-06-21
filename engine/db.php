<?php

function getDb()
{
    static $db = null;
    if (is_null($db)) {
        $db = @mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect: " . mysqli_connect_error());
    }
    return $db;

}

function getAssocResult($sql)
{
    $result = @mysqli_query(getDb(), $sql) or die(mysqli_error(getDb()));
    $array_result = [];
    while ($row = $result->fetch_assoc()) {
        $array_result[] = $row;
    }

    return $array_result;
}

function getOneResult($sql)
{
    $result = @mysqli_query(getDb(), $sql) or die(mysqli_error(getDb())); // процедурный стиль.
    return $result->fetch_assoc();
}
function executeSql($sql)
{
    $result = @mysqli_real_query(getDb(), $sql) or die(mysqli_error(getDb()));
    return mysqli_affected_rows(getDb());
}


