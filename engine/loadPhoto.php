<?php

const PATH_TO_IMAGES = 'img';

function can_upload($file)
{
    if ($file['name'] === '')
        return 'Вы не выбрали файл';
    if ($file['size'] === 0)
        return 'Файл слишком большого размера';
    $getMimeType = explode('.', $file['name']);
    $mime = strtolower(end($getMimeType));
    $whileList = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
    if (!in_array($mime, $whileList))
        return 'Недопустимый формат файла';
    return true;
}

function make_upload($file)
{
    $name = mt_rand(0, 10000) . $file['name'];
    copy($file['tmp_name'], PATH_TO_IMAGES . '/big/' . $name);
    img_resize(PATH_TO_IMAGES . "/big/{$name}", PATH_TO_IMAGES . "/small/{$name}", '156', '106');
    return $name;
}
function make_upload_img_items($file) {
    $name = mt_rand(0, 10000) . $file['name'];
    copy($file['tmp_name'], PATH_TO_IMAGES . '/catalog_img/' . $name);
    return $name;
}