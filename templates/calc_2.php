<form action="" method="post">
    <input type="text" name="arg1" value="<?=$arg1?>" placeholder="Введите первое число">
    <input type="text" name="arg2" value="<?=$arg2?>" placeholder="Введите второе число">
    <input type="text" name="result" readonly value="<?=$result?>" placeholder="Результат">
    <br>
    <br>
    <?php if(isset($error_message)): ?>
    <?=$error_message?><br>
    <?php endif;?>

    <input type="submit" value="Сложить" name="sum">
    <input type="submit" value="Вычесть" name="sub">
    <input type="submit" value="Разделить" name="div">
    <input type="submit" value="Умножить" name="mult">
</form>