<?php
function make_an_order($num)
{
    if (is_auth()) {
        $session_id = session_id();

        executeSql("INSERT INTO orders (session_id,num, user_login, status, user_id ) values ('{$session_id}', '{$num}', '{$_SESSION['login']}', 'check', '{$_SESSION['id']}')");
        session_regenerate_id();
    }
}
