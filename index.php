<?php 
use Validator\RequestValidator;
use Util\RotasUtil;

require_once 'paramns.php';

try {
    $requestValidator = new RequestValidator(RotasUtil::getRotas());
    $retorno = $requestValidator->processarRequest();
} catch (Exception $exception) {
    echo $exception->getMessage();
}


