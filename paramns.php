<?php

define(DS, DIRECTORY_SEPARATOR);
define(DIR_APP, __DIR__);

if(file_exists('autoload.php')){
    include 'autoload.php';
}
else{
    die('Erro ao carregar o autoload!');
}