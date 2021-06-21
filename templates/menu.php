<div class="navbar">
    <a href="/">Главная</a>
    <a href="/catalog">Каталог</a>
    <a href="/gallerey">Галерея</a>
    <a href="/about">О нас</a>
    <a href="/news">Новости</a>
<!--    <a href="/calc_1">Кальк-1</a>-->
<!--    <a href="/calc_2">Кальк-2</a>-->
    <? if ($allow):?>
    <a href="/my_order">Мои заказы</a>
    <? endif;?>
    <a href="/cart">Корзина (<?=$acc ?>)</a>
    <?php if ($role == 'admin'): ?>
        <a href="/admin_page">Админка</a>
    <?php endif; ?>
    <?php if ($role == 'moderator' || $role == 'admin'): ?>
        <a href="/moderator_page">Модерка</a>
    <?php endif; ?>
</div>