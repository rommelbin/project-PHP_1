<?php foreach($orders as $key => $val): ?>
<div class="id_order"><b>ID ЗАКАЗА:</b> <?=$val['id']?></div>
<div class="status"><b>Status:</b><?=$val['status']?></div>
<div class="orderer"><b>Заказчик:</b><?=$val['user_login']?></div>
<div class="num_my_orders"><b>Номер телефона:</b> <?=$val['num']?></div>
<div class="date"><b>Оформлен в:</b> <?=$val['created_at']?></div>
<div class="date"><b>Обновлён в:</b> <?=$val['updated_at']?></div>
    <br>
<?php endforeach; ?>
