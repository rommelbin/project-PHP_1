<?php if ($allow): ?>
    <div class="welcome">
        <span>Добро пожаловать <?= $_SESSION['user'] ?></span>  <a href="?logout" class="exit"> [Выход]</a>
    </div>
<?php else: ?>
    <div class="auth">
        <form action="" method="post">
            <div class="login"><input type="text" name="login" placeholder="Ваш логин"></div>
            <div class="password"><input type="password" name="pass" placeholder="Ваш пароль"></div>
            Save? <input type='checkbox' name='save'><br>
            <input type="submit" name="ok">
            <a href="/createAcc">Создать аккаунт?</a>
        </form>

    </div>
<?php endif; ?>