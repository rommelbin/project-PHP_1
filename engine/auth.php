<?php
function sessionWork() {
    session_start();
    $allow = false;
    if (isset($_GET['logout'])) { // Выход из аккаунта
        setcookie('hash', '', time() - 3600, '/');
        session_destroy();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
    if (is_auth()) { // Проверка, авторизован ли уже пользователь
        $allow = true;
        $_SESSION['user'] = get_user();
    }

    if (isset($_POST['ok'])) { // Возникает при введение данных в форму
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        if (auth($login, $pass)) { // Если указаны оба параметра, то мы проводим аутентификацию.
            if (isset($_POST['save'])) {
                $hash = uniqid(rand(), true);
                $db = getDb();
                $id = $_SESSION['id'];
                $sql = "UPDATE `users` SET `hash` = '{$hash}' WHERE `users`.`id` = {$id}";
                $result = mysqli_query($db, $sql);
                setcookie("hash", $hash, time() + 3600, '/');
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die("Не верно логин-пароль");
        }

    }
    return $allow;
}

function get_user() // Забираем пользователя, если аутентификация пройдена
{
    return $_SESSION['login'];
}

function auth($login, $pass)
{
    $login = checkFormData($login);
    $row = getOneResult("SELECT * FROM users WHERE login = '{$login}'");
    if(isset($row)) {
        if (password_verify($pass, $row['pass'])) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $row['id'];
            return true;
        }
    }
    return false;
}
function is_auth()
{
    //TODO оптимизируйте if, и учтите что пользователь уже может быть авторизован по сессии
    if (isset($_COOKIE["hash"])) {
        $hash = $_COOKIE["hash"];
        $row = getOneResult("SELECT * FROM `users` WHERE `hash`='{$hash}'");
        $user = $row['login'];
        if (!empty($user)) {
            $_SESSION['login'] = $user;
            $_SESSION['id'] = $row['id'];
        }
    }
    return isset($_SESSION['login']);
}

function createAcc() {

}