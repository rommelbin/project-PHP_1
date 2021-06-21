<?php foreach ($one_order as $key => $val): ?>
    <div class="order_moderating border_black width_small">
        <div class="item padding10 ">Товар:
            <div class="underline-bold"><?= $val['name'] ?></div>
        </div>
        <div class="quantity padding10">Количество:
            <div class="underline-bold"><?= $val['quantity'] ?></div>
        </div>
        <div class="price padding10"> Цена
            <div class="underline-bold"><?= $val['price'] ?></div>
        </div>
    </div>
<?php endforeach; ?>
<form action="" method="post">
    <h2>Сменить статус заказа</h2>
    <select name="status">
        <option value="check" <?php if ($status === 'check'): echo 'selected'; endif ?>> На проверке
        </option>
        <option value="confirm" <?php if ($status === 'confirm'): echo 'selected'; endif ?>>Подтверждённые</option>
        <option value="way" <?php if ($status === 'way'): echo 'selected'; endif ?>>В пути</option>
        <option value="impossible" <?php if ($status === 'impossible'): echo 'selected'; endif ?>>Отменённые</option>
    </select>
    <input type="hidden" name="order_id" value="<?= $order_id ?>">
    <input type="submit" value="Сменить">
</form>