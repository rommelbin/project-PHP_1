<div>
    <img src="/img/catalog_img/<?= $item['item_img'] ?>" alt="<? $item['name'] ?>" style="width:350px; height:350px;">
    <br>
    <b> Название: </b><?= $item['name'] ?>. <br>
    <b>Стоимость:</b> <?= $item['price'] ?>&#8381.
    <br>
    <b>Описание:</b>
    <?= $item['description'] ?>.
    <br>
    <b>Состав:</b>
    <?= $item['consistOf'] ?>.
    <br>
    <b>Производитель:</b>
    "<?= $item['manufacturer'] ?>" <br> <br>
    <form action="" method="post">
        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
        <input type="submit" value="Купить">
    </form>
</div>
<h1>Отзывы:</h1>

<?php if ($reviews):
    foreach ($reviews as $review):?>

        <div><?= $review['name'] ?>:
            <?php if($role === 'admin' || $role === 'moderator'): ?>
            <a href="/itemone/delete/?id=<?= $item['id'] ?>&id_review=<?= $review['id'] ?>"
               style="text-decoration:none;">X</a>
            <a href="/itemone/edit/?id=<?= $item['id'] ?>&id_review=<?= $review['id'] ?>">Изменить</a>
            <?php endif;?>
        </div>
        <div>"<?= $review['review'] ?>"</div>
        <hr>
    <?php endforeach; else: ?>
    <h4>Отзывов нет</h4>
<?php endif ?>
<div>
    <form action="/itemone/<?=$operation?>/?id=<?= $item['id'] ?>" method="post">
        <h1>Оставить отзыв</h1>
        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
        <?php if (isset($update_review['name']) && isset($update_review['review'])): ?>
            <input type="hidden" name="id_review" value="<?= $update_review['id'] ?>">
            <input type="text" name="name" value="<?= $update_review['name'] ?>" placeholder="Ваше имя"> <br> <br>
            <input type="text" name="review" value="<?= $update_review['review'] ?>" placeholder="Ваш отзыв"> <br> <br>
        <?php else: ?>
            <input type="text" name="name" value="" placeholder="Ваше имя"> <br> <br>
            <input type="text" name="review" value="" placeholder="Ваш отзыв"> <br> <br>
        <?php endif; ?>
        <input type="submit" value="Оставить отзыв">
    </form>

</div>