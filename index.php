<?php 
use Validator\RequestValidator;
use Util\ConstantesGenericasUtil;
use Util\JsonUtil;
use Util\RotasUtil;

require_once 'paramns.php';

try {
    $requestValidator = new RequestValidator(RotasUtil::getRotas());
    $retorno = $requestValidator->processarRequest();

    $JsonProcessing = new JsonUtil();
    $JsonProcessing->processarArrayRetorno($retorno);
    
} catch (Exception $exception) {
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    echo json_encode([
        ConstantesGenericasUtil::TIPO => ConstantesGenericasUtil::TIPO_ERRO,
        ConstantesGenericasUtil::RESPOSTA => utf8_encode($exception->getMessage())
    ]);
}


