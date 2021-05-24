<?php

spl_autoload_register(function ($class_name) {
    $classWhiteList = [
    'classes\AddressBook',
    'classes\Store'
];
if (!in_array($class_name, $classWhiteList)) {
    return;
}
    $class_name = str_replace('\\', '/', $class_name);
    require_once ("{$class_name}.php");
});
