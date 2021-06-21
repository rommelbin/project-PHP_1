<?php
error_reporting(-1);
include "../config/config.php";
$allow = sessionWork(); // Вызов функции сессии, для авторизации и аутентификации.
$url_array = explode('/', $_SERVER['REQUEST_URI']);
$action = '';
if ($url_array[1] == "") {
    $page = 'index';
} else {
    $page = $url_array[1];
}
if(isset($url_array[2])) {
    if($url_array[2] == 'add') {
    $action = 'add';
    } else if ($url_array[2] == 'delete') {
        $action = 'delete';
    } else if($url_array[2] == 'update') {
        $action = 'update';
    } else if($url_array[2] == 'edit') {
        $action = 'edit';
    }
}

$params = prepareVariables($page, $allow, $action);
if($page == 'createAcc') {
    $layout = 'createAcc';
    echo render($page, $params, $layout);
} else {
    echo render($page, $params);
}