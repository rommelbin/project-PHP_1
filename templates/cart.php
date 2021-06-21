 <br> Корзина товаров:
 <?php foreach($cart as $key => $good): ?>
     <h1> <?=$good['name']?> </h1>
     <?=$good['price']?>&#8381. <br>
     <img src="/img/catalog_img/<?=$good['item_img']?>" alt="" style="width:50px; height: 46px;">
     <strong>Количество:</strong> <?=$good['quantity']?>
     <form action="" method="post">
         <input type="hidden" name="item_id" value="<?=$good['id']?>">
         <input type="submit" name="add" value="Добавить">
         <input type="submit" name="delete" value="Удалить">
     </form>
     <hr>
 <?php endforeach;?>

 <br>
 <br>
 <strong> Общее количество товаров: </strong> <?=$acc?>
 <br>
 <?php if($cart && $allow): ?>
 <a href="/orders"><button>Оформить заказ</button></a>
<?php endif?>