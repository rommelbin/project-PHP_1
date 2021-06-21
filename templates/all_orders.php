<form action="" method="post">
    <select name="sort">
        <option value="all" <?php if ($option === 'all'): echo 'selected'; endif; ?>>Все</option>
        <option value="check" <?php if ($option === 'check'): echo 'selected'; endif; ?>>На проверке</option>
        <option value="confirm" <?php if ($option === 'confirm'): echo 'selected'; endif; ?>>Подтверждённые</option>
        <option value="way" <?php if ($option === 'way'): echo 'selected'; endif; ?>>В пути</option>
        <option value="impossible" <?php if ($option === 'impossible'): echo 'selected'; endif; ?>>Отменённые</option>
    </select>
    <input type="submit" value="Выбрать">
</form>

<?php foreach ($orders as $key => $val): ?>
    <div class="order_moderating">
        <div class="orderer">Заказчик:
            <div class="underline-bold"><?= $val['user_login'] ?></div>
        </div>
        <div class="id_order">ID Заказа:
            <div class="underline-bold"><?= $val['id'] ?></div>
        </div>
        <div class="status">Статус заказа:
            <div class="status-order underline-bold"><?= $val['status'] ?></div>
        </div>
        <div class="num">Номер заказчика:
            <div class="underline-bold"><?= $val['num'] ?></div>
        </div>
        <div class="date">
            <div class="underline-bold">Оформлен в:</div> <?= $val['created_at'] ?></div>
        <div class="date">
            <div class="underline-bold">Обновлён в:</div> <?= $val['updated_at'] ?></div>
        <br>
        <a href="/moderate_order/?order_id=<?= $val['id'] ?>&status=<?=$val['status']?>">
            <button>Подробнее</button>
        </a>
    </div>

<? endforeach; ?>

