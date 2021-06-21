<?php
    $scanned_directory = array_diff(scandir(ENGINE_DIR), array('..', '.'));
    foreach ($scanned_directory as $key => $file) {
            include_once ENGINE_DIR . $file;
    }
