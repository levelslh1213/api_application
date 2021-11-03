<?php

namespace Util;

use JsonException as JsonExceptionAlias;

class JsonUtil
{
    public static function tratarCorpoRequisicaoJson(){
        try {
            $postJson = json_decode(file_get_contents('php://input'), true); //diretório que armazena os arquivos das requisições
        } catch (JsonExceptionAlias $exception) {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERR0_JSON_VAZIO);
        }
        if(is_array($postJson) && count($postJson > 0)){
            return $postJson;
        }
    }
}
