<?php
function addToCart() // Запросы насчёт авторизованных и не авторизованных пользователей.
{
    $session_id = session_id();
    if (is_auth()) {
        $quantity = getOneResult("SELECT quantity FROM basket_items where user_id = '{$_SESSION['id']}' and item_id = (select id from items where id = '{$_POST['item_id']}') and session_id = '{$session_id}'");
        if (!$quantity) {
            executeSql("INSERT INTO basket_items (item_id, user_id, session_id) values ('{$_POST['item_id']}', '{$_SESSION['id']}',  '{$session_id}')");
        } else {
            executeSql(
                "UPDATE basket_items SET quantity = quantity + 1 where user_id = (select id from users where login = '{$_SESSION['login']}') and item_id = (select id from items where id = '{$_POST['item_id']}')");
        }
    } else {
        $quantity = getOneResult("SELECT quantity FROM basket_items where user_id is null and session_id = '{$session_id}' and item_id = '{$_POST['item_id']}'");
        if (!$quantity) {
            executeSql("INSERT INTO basket_items (item_id, session_id, user_id) values ('{$_POST['item_id']}', '{$session_id}', NULL) ");
        } else {
            executeSql("UPDATE basket_items SET quantity = quantity + 1 where user_id is null and session_id = '{$session_id}' and item_id = '{$_POST['item_id']}'");
        }
    }
    getTotalQuantity();
}
function deleteFromCart()
{ // Удаление для этих пользователей из корзины.
    $session_id = session_id();
    if (is_auth()) {
        $quantity = getOneResult("SELECT quantity FROM basket_items where user_id = '{$_SESSION['id']}' and item_id = (select id from items where id = '{$_POST['item_id']}')");
        if ($quantity['quantity'] == 1) {
            executeSql("DELETE FROM basket_items where user_id = '{$_SESSION['id']}' and item_id = (select id from items where id = '{$_POST['item_id']}')");
        } else if ($quantity['quantity'] > 1) {
            executeSql(
                "UPDATE basket_items SET quantity = quantity - 1 where user_id = '{$_SESSION['id']}' and item_id = (select id from items where id = '{$_POST['item_id']}')");
        }
    } else {
        $quantity = getOneResult("SELECT quantity FROM basket_items where user_id is null and session_id = '{$session_id}' and item_id = '{$_POST['item_id']}'");
        if ($quantity['quantity'] == 1) {
            executeSql("DELETE FROM basket_items where user_id is null and session_id = '{$session_id}' and item_id = (select id from items where id = '{$_POST['item_id']}')");
        } else {
            executeSql("UPDATE basket_items SET quantity = quantity - 1 where user_id is null and session_id = '{$session_id}' and item_id = '{$_POST['item_id']}'");
        }
    }
}

function getCart()
{ // Получение всей корзины для одного пользователя
    $session_id = session_id();
    if (is_auth()) {
        return getAssocResult("select i.id, i.name, i.price, i.item_img, bi.quantity from items i join basket_items bi on bi.item_id = i.id and user_id = '{$_SESSION['id']}' and session_id = '{$session_id}'");
    } else {
        return getAssocResult("select i.id, i.name, i.price, i.item_img, bi.quantity from items i join basket_items bi on bi.item_id = i.id and user_id is null and session_id = '{$session_id}'");
    }

}

function getTotalQuantity()
{ // Для отображение в навбаре
    $session_id = session_id();
    if(is_auth()) {
        $str = "and user_id = '{$_SESSION['id']}'";
    } else {
        $str = 'and user_id is null';
    }
    $acc = getOneResult("SELECT sum(quantity) as quantity FROM basket_items where session_id = '{$session_id}'" .  $str);
    if(!$acc['quantity']) {
        $quantity = 0;
    } else {
        $quantity = $acc['quantity'];
    }
    return $quantity;
}

function getTotalPrice($cart)
{

    $acc = 0;
    foreach ($cart as $key => $val) {
        $acc += $val['price'] * $val['quantity'];
    }
    return $acc;
}