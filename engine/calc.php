<?php
function getCalc($arg1, $arg2, $operation) {
    switch($operation) {
        case 'sum':
            $result =  $arg1 + $arg2;
            break;
        case 'div':
            if($arg1 == 0 || $arg2 == 0): return 'Нельзя делить на ноль';
            else: $result = $arg1 / $arg2;
            endif;
            break;
        case 'sub':
            $result = $arg1 - $arg2;
            break;
        case 'mult':
            $result = $arg1 * $arg2;
            break;
    }
    return $result;
}

function checkOperation($operation) {
    if(isset($operation['sum'])) {
        $result =  "sum";
    } else if(isset($operation['sub'])) {
        $result = "sub";
    } else if(isset($operation['div'])) {
        $result = "div";
    } else if(isset($operation['mult'])) {
        $result = "mult";
    }
    return $result;
}