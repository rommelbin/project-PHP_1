<?php


function render($page, $params = [], $layout = 'main')
{
        return renderTemplate(LAYOUTS_DIR . $layout, [
            'menu' => renderTemplate('menu', $params),
            'auth' => renderTemplate('auth', $params),
            'content' => renderTemplate($page, $params)
        ]);
}

function renderTemplate($page, $params = [])
{

    extract($params);

    ob_start();
    $fileName = TEMPLATES_DIR . $page . ".php";
    if (file_exists($fileName)) {
        include $fileName;
    }

    return ob_get_clean();
}
