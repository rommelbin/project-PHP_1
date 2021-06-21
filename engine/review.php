<?php
function getReviews($id)
{
    return getAssocResult("SELECT id, name, review FROM reviews where item_id={$id}");
}

function doFeedBackAction($action, $id_review = '')
{
    if ($action == 'add') {
        // Избегаем sql-инъекций. Так же можно было сделать через переборку массива $file
        $review = checkFormData($_POST['review']);
        $name = checkFormData($_POST['name']);
        $item_id = checkFormData($_POST['item_id']);
    } else if ($action == 'update') {
        $review = checkFormData($_POST['review']);
        $name = checkFormData($_POST['name']);
    }
    $id_review = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($id_review)));
    switch ($action) {
        case 'add':
            executeSql("INSERT INTO reviews (review, name, item_id) values ('$review', '$name', $item_id)");
            break;
        case 'delete':
            executeSql("DELETE from reviews where id={$id_review}");
            break;
        case 'update':
            executeSql("UPDATE reviews SET name = '$name', review='$review' where id={$_POST['id_review']}");
            break;
        case 'edit':
            break;

    }

}

function getOneReview($id_review)
{
    return getOneResult("SELECT id, name, review FROM reviews where id={$id_review} ");
}