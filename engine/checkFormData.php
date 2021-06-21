<?php
function checkFormData($data) {  // Проверка форм
    return mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($data)));
}