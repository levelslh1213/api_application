<?php
ini_set('display_errors', 1);
ini_set('display_startup_ errors', 1);
error_reporting(E_ERROR);

echo '2';
define('HOST', 'localhost');
define('PORT', '5432');
define('BANCO', 'api_application');
define('USER', 'postgres');
define('PASSWORD', 'orion');
echo '3';

define('DS', DIRECTORY_SEPARATOR);
define('DIR_APP',__DIR__);
define('DIR_PROJETO', 'api_application');

if(file_exists('autoload.php')){
    include 'autoload.php';
}
else{
    die('Erro ao carregar o autoload!');
}