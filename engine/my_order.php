<?php
function getMyOrders() {
    return getAssocResult("SELECT id, user_login, status, num, created_at, updated_at FROM orders where user_login = '{$_SESSION['login']}'");
}
