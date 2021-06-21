<?php if($allow === false): ?>
    Вы не вошли в аккаунт. Пожалуйста, сделайте это
<?php else:?>
<br>
<form enctype="multipart/form-data" method="post" action="">
    <p><input type="file" name="file">
        <input type="submit" value="Отправить"></p>
</form>
<br>
Моя галерея:<br>
<?php foreach ($photos as $key): ?>
<div>
    <a href="/picture_one/?id=<?=$key['id']?>"> <img src="/img/small/<?=$key['name']?>" alt=""></a>
</div>
    <br>
<?php endforeach; ?>
<?php endif?>
