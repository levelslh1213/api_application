<?php

/**
 * @param $class
 */

function autoload($class){
    $diretorioBase = DIR_APP . DS;
    $class = $diretorioBase . 'Classes' . DS . str_replace(search: '\\', replace: DS, $class) . '.php';
    if(file_exists($class) && !id_dir($class)){
        include $class
    }
}

spl_autoload_register(autoload_function 'autoload');