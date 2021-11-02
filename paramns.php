<?php
ini_set('display_errors', 1);
ini_set('display_startup_ errors', 1);
error_reporting(E_ERROR);

define(HOST, 'localhost:8080');
define(BANCO, 'api_application');
define(USER, 'sa');
define(PASSWORD, 'orion');

define(DS, DIRECTORY_SEPARATOR);
define(DIR_APP,__DIR__);

if(file_exists('autoload.php')){
    include 'autoload.php';
}
else{
    die('Erro ao carregar o autoload!');
}