<?php
function prepareVariables($page, $allow, $action = '')
{
    $params = [
        'allow' => $allow,
        // Проверяет роль, если роль не совпадает с правами на страницу, то далее на той странице делается редирект
        // Роль пользователя всегда задаётся User при регистрации, а админку и модерку пока можно выдать в ручную через бд.
        'role' => checkRole(),
        'acc' => getTotalQuantity() // Общее количество
    ];
    switch ($page) {

        case 'index':
            break;

        case 'catalog':
            $params['catalog'] = getCatalog();
            if (isset($_POST['item_id']) && isset($_COOKIE['PHPSESSID'])) {
                addToCart();
                header('Location: /catalog');
                die;
            }
            // Загрузка файлов
            if (isset($_POST['create_item'])) {
                if (isset($_FILES['file'])) {
                    $check = can_upload($_FILES['file']);
                    if ($check === true) {
                        $img_name = make_upload_img_items($_FILES['file']);
                        createItem($img_name);
                    }
                }
                header('Location: /catalog');
                die;
            }
            break;

        case 'gallerey':
            $params['photos'] = getPhotos();
            if (isset($_FILES['file'])) {
                $check = can_upload($_FILES['file']);
                if ($check === true) {
                    $name = make_upload($_FILES['file']);
                    addPhoto($_FILES['file'], $name);
                    header('Location: /gallerey');
                    die;
                } else {
                    echo $check;
                }
            }
            break;

        case 'news':
            $params['news'] = getNews();
            break;

        case 'newsone':
            $id = (int)$_GET['id'];
            $params['news'] = getOneNews($id);
            break;

        case 'picture_one':
            $id = (int)$_GET['id'];
            views($id);
            $params['photo'] = getOnePhoto($id);
            break;
        case 'calc_1':
            $params['arg1'] = '';
            $params['operation'] = 'sum';
            $params['arg2'] = '';
            $params['result'] = '';
            if (isset($_POST['arg1']) && isset($_POST['arg2'])) { // проверяем вписаны ли аргументы
                if (!is_numeric($_POST['arg1']) || !is_numeric($_POST['arg2'])) { // проверяем числа ли это
                    $params['error_message'] = 'Вы передали не число'; // закидываем сообщение ошибки, если не число
                    break;
                }
                // Добавляем переменные для их сохранения после того, как страница была обновления
                $params['arg1'] = $_POST['arg1'];
                $params['arg2'] = $_POST['arg2'];
                $params['operation'] = $_POST['operation'];
                // Получаем данные из db
                $params['result'] = getCalc($_POST['arg1'], $_POST['arg2'], $_POST['operation']);
            }
            break;
        case 'calc_2':
            // В этом калькуляторе почти то же самое
            $params['arg1'] = '';
            $params['operation'] = 'sum';
            $params['arg2'] = '';
            $params['result'] = '';
            if (isset($_POST['arg1']) && isset($_POST['arg2'])) {
                if (!is_numeric($_POST['arg1']) || !is_numeric($_POST['arg2'])) {
                    $params['error_message'] = 'Вы передали не число';
                    break;
                }
                $params['arg1'] = $_POST['arg1'];
                $params['arg2'] = $_POST['arg2'];
                // CheckOperation Нужен, чтобы определить на какую кнопку было нажато
                $params['operation'] = checkOperation($_POST);
                $params['result'] = getCalc($_POST['arg1'], $_POST['arg2'], $params['operation']);
            }
            break;
        case 'itemone':
            $id = (int)$_GET['id'];
            $params['item'] = getOneItem($id); // Получаем item из БД
            $params['operation'] = 'add'; // Устанавливаем переменную для пути внутри кнопки
            $id_review = ''; // нужен для update, delete, review
            if (isset($_GET['id_review'])) {
                $id_review = $_GET['id_review'];
            }
            if (isset($_POST['item_id']) && isset($_COOKIE['PHPSESSID'])) addToCart();
            doFeedBackAction($action, $id_review);
            $params['reviews'] = getReviews($id); // Получаем из базы данных все отзывы по айдишнику товара


            if ($action) {
                if ($action == 'edit') { // переходное действие, для того, чтобы получить данные ревью обратно в форму для дальнейшего обновления
                    $params['operation'] = 'update'; // Соответственно, если мы уже попали на edit, то нам нужно поменять кнопку формы, для того, чтобы у нас не добавлялось, а обновлялось
                    $params['update_review'] = getOneReview($id_review); // Этот элемент нужен, чтобы получить обратно в форму данные ревью, которые хотим изменить
                }
                if ($action != 'edit') {  // Мы не ставим header на edit, потому что нам нужно, чтобы мы видели эти данные
                    header('Location: /itemone/?id=' . $id);
                    die;
                }

            }
            break;

        case 'cart':
            $params['cart'] = getCart();
            if (isset($_POST['add'])) {
                if (isset($_POST['item_id']) && isset($_COOKIE['PHPSESSID'])) addToCart();
                header('Location: /cart');
                die;
            } else if (isset($_POST['delete'])) {
                if (isset($_POST['item_id']) && isset($_COOKIE['PHPSESSID'])) deleteFromCart();
                header('Location: /cart');
                die;
            }
            if (isset($_POST['make_order'])) {
                print_r($_POST);
            }

            break;
        // Отдельная страница с регистрацией
        case 'createAcc':
            $params['registration'] = '';
            if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['email'])) {
                $params['registration'] = createUser();
            }
            break;
        // Пример админки, но пустая
        case 'admin_page':
            if ($params['role'] === 'admin') {
            } else {
                header('Location: /');
                die;
            }
            break;
        case 'moderator_page':
            if ($params['role'] === 'admin' || $params['role'] === 'moderator') {
            } else {
                header('Location: /');
                die;
            }
            break;
        case 'orders':
            $params['order'] = getCart();
            $params['total_quantity'] = getTotalQuantity();
            $cart = getCart();
            $params['total_price'] = getTotalPrice($cart);

            if (isset($_POST['number'])) {
                if(is_numeric($_POST['number'])) {
                    $num = (int) $_POST['number'];
                    make_an_order($num);
                    header('Location: /my_order');
                    die;
                } else {
                    die('Введите число');
                }
            }
            break;
        case 'my_order':
            $params['orders'] = getMyOrders();
            if (!$allow) {
                header('Location: /');
                die;
            }
            break;
        case 'all_orders':
            if ($params['role'] === 'admin' || $params['role'] === 'moderator') {
                if(isset($_POST['sort'])) {
                    $sort = checkFormData($_POST['sort']);
                    $params['option'] = $sort;
                    $params['orders'] = get_all_orders($sort);
                } else {
                    $params['orders'] = get_all_orders();
                    $params['option'] = '';
                }
                if(isset($option_change)) {
                } else {
                    $params['option_change'] = 'all';
                }
            } else {
                header('Location: /');
                die;
            }
            break;
        case 'moderate_order':
            if(isset($_GET['order_id'])) {
                $order_id = (int) $_GET['order_id'];
                $params['status'] = checkFormData($_GET['status']);
                $params['order_id'] = $order_id;
                $params['one_order'] = get_one_order_for_moderate($order_id);
                if(isset($_POST['status'])) {
                    $status = checkFormData($_POST['status']);
                    update_order($status, $order_id);
                    header('Location: /all_orders');
                };
            } else {
                header('Location: /');
                die;
            }
            break;
    }
    return $params;
}
