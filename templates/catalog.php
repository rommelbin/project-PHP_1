<h2>Каталог</h2>
<?php foreach ($catalog as $item): ?>
    <div>
        <img src="img/catalog_img/<?= $item['item_img'] ?>" alt="<?=$item['name'] ?>"
             style="width:156px; height:106px;">
        <br>
        <b><?= $item['name'] ?></b> Стоимость: <?= $item['price'] ?>&#8381.
        <br>
        <b>Описание:</b>
        <?= $item['description'] ?>
        <br>
        <form action="" method="post">
            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
            <input type="submit" value="Купить">
        </form>
        <a href="/itemone/?id=<?= $item['id'] ?>">
            <button>Подробнее</button>
        </a>
        <hr>
    </div>
<?php endforeach; ?>

<?php if ($role == 'admin' || $role == 'moderator'): ?>
    <form action="" method="post" enctype="multipart/form-data">
        <br> <input type="text" placeholder="name" name="name" required>
        <br> <input type="text" placeholder="price" name="price" required>
        <br> <input type="text" placeholder="description" name="description" required>
        <br> <input type="text" placeholder="consistOf" name="consistOf" required>
        <br> <input type="text" placeholder="manufacturer" name="manufacturer" required>
        <br><input type="file" name="file">
        <br> <input type="submit" value="Создать товар" name='create_item'>
    </form>
<?php endif; ?>