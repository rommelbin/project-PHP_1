<?php

function getPhotos()
{
    return getAssocResult("SELECT * FROM info_img order by views desc");
}

function getOnePhoto($id)
{
    return getOneResult("SELECT * FROM info_img WHERE id = {$id}");
}

function views($id)
{
    executeSql("UPDATE info_img SET views = views + 1 where id = {$id}");
}

function addPhoto($file, $img_name)
{
    extract($file);

    executeSql("INSERT INTO info_img (name, sizeOf, views) values ('{$img_name}',{$size}, 0)");
}

