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
    echo json_encode([
        ConstantesGenericasUtil::TIPO => ConstantesGenericasUtil::TIPO_ERRO,
        ConstantesGenericasUtil::RESPOSTA => utf8_encode($exception->getMessage())
    ]);
}


