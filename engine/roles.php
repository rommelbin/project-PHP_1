<?php
// Проверка роли пользователя.
function checkRole()
{
    if (is_auth()) {
        $row = getOneResult("SELECT user_login, user_role FROM roles where user_login='{$_SESSION['login']}'");
        return $row['user_role'];
    }
}