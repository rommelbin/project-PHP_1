<?php
function getCatalog()
{
    return getAssocResult("SELECT id, name, price, description, item_img FROM items");
}

function getOneItem($id)
{
    return getOneResult("SELECT id, name, price, description, item_img, consistOf , manufacturer from items where id = {$id} ");
}

function createItem($file_name) { // Создание товара, постарался сделать безопасно
    $name = checkFormData($_POST['name']);
    $description = checkFormData($_POST['description']);
    $consistOf = checkFormData($_POST['consistOf']);
    $price = checkFormData($_POST['price']);
    $manufacturer = checkFormData($_POST['manufacturer']);
    executeSql("INSERT INTO items (name, price, description, item_img, consistOf, manufacturer) values ('{$name}', '{$price}', '{$description}', '{$file_name}', '{$consistOf}', '{$manufacturer}')");
}
