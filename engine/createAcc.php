<?php
function createUser()
{
    $login = checkFormData($_POST['login']);
    $email = checkFormData($_POST['email']);
    if (checkUser($login, $email)) {
        // Хэширует пароль
        $pass = password_hash(checkFormData($_POST['pass']), PASSWORD_BCRYPT);
        $hash = uniqid(rand(), true);
        $result = executeSql("INSERT INTO users (login, pass, hash, email) values ('{$login}', '{$pass}', '{$hash}', '{$email}')");
        executeSql("INSERT INTO roles (user_login, user_role) values ('{$login}', 'user')");
        return 'Регистрация прошла успешно!';
    } else {
        return 'Произошла ошибка';
    }
}
function checkUser($login, $email) // Проверка юзера, есть ли такая почта в базе данных и есть ли такой логин
{
    $login_from_db = getOneResult("SELECT login FROM users where login='{$login}'");
    $email_from_db = getOneResult("SELECT email FROM users where email='{$email}'");
    if (!$login_from_db && !$email_from_db) {
        return true;
    } else {
        return false;
    }
}
