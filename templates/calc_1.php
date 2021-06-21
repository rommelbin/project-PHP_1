<form action="" method="post">
    <input type="text" name="arg1" value="<?=$arg1?>">
    <select name="operation">
        <option value="sum" <?php if($operation === 'sum'): echo 'selected'; endif;?>>+</option>
        <option value="sub" <?php if($operation === 'sub'): echo 'selected'; endif;?>>-</option>
        <option value="mult"<?php if($operation === 'mult'): echo 'selected'; endif;?>>*</option>
        <option value="div" <?php if($operation === 'div'): echo 'selected'; endif;?>>/</option>
    </select>
    <input type="text" name="arg2" value="<?=$arg2?>">
    <input type="text" name="result" readonly value="<?=$result?>">
    <input type="submit" value="Вычислить">
    <br>
    <br>
    <?php if(isset($error_message)): ?>
        <?=$error_message?>
    <?php endif;?>

</form>