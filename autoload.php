<?php
/**
 * Created by PhpStorm.
 * User: artem.tsepkov
 * Date: 2019-04-25
 * Time: 17:04
 */

function my_autoloader($class) {
    include str_replace('\\','/',$class) . '.php';
}

spl_autoload_register('my_autoloader');