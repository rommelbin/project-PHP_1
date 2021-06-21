<?php if ($allow): ?>

    <div class="orders-header">Ваш заказ:</div>

    <div class="orders-main">
    <?php foreach ($order as $key => $val): ?>
        <div class="order">
            <div class="name_orders"><?= $val['name'] ?></div>
            <div class="price">Цена: <?= $val['price'] ?></div>
            <img src="/img/catalog_img/<?= $val['item_img'] ?>" alt="" class="img_orders">
            <div class="quantity">Количество: <?= $val['quantity'] ?></div>
        </div>
    <?php endforeach; ?>
    <?if ($order): ?>
        <div class="total_price">Стоимость всех товаров: <?=$total_price ?></div>
        </div>
        <form action="" method="post">

            <input type="text" placeholder="Ваш номер телефона" name="number">
            <br>
            <input type="submit" value="Подтвердить заказ">
            <br>
        </form>
    <?php endif ?>
<?php else: ?>

</span>
Чтобы сделать заказ, вам нужно войти в аккаунт или зарегистироваться
<span style="font-size:30px; font-weight: bold">
    <br>
    <br>
<?php endif ?>
