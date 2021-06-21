<?php
function get_all_orders($sort = 'all')
{
    $sql = '';

        switch ($sort) {
            case 'all':
                $sql = '';
                break;
            case 'confirm':
                $sql = "where status = 'confirm'";
                break;
            case 'way':
                $sql = "where status = 'way'";
                break;
            case 'impossible':
                $sql = "where status = 'impossible'";
                break;
            case 'check':
                $sql = "where status = 'check'";
                break;
        }
//    $result = getAssocResult("SELECT * FROM orders where status = 'check'");
//    return getAssocResult("select i.name, o.session_id, o.user_login, bi.quantity from basket_items bi join orders o on bi.user_id = o.user_id and bi.session_id = o.session_id join items i on i.id = bi.item_id;");
    return getAssocResult("SELECT id, user_login, status, num, created_at, updated_at FROM orders " . $sql . ' order by created_at ');
}

function get_one_order_for_moderate($order_id) {
    return getAssocResult("select name, bi.quantity, i.price from items i join basket_items bi on bi.item_id = i.id join orders o on bi.user_id = o.user_id and o.id = '{$order_id}' and bi.session_id = o.session_id;");

}
function update_order ($status, $order_id) {
    executeSql("UPDATE orders SET status = '{$status}' where id = '{$order_id}'");
}