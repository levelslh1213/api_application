<?php
namespace Validator;

use Util\ConstantesGenericasUtil;
use Util\JsonUtil;
use InvalidArgumentException;
use Repository\TokensAutorizadosRepository;

class RequestValidator
{
    private array $request;
    private array $dadosRequest = [];
    private object $TokensAutorizadosRepository;

    private const GET = 'GET';
    private const DELETE = 'DELETE';

    public function __construct($request)
    {
        $this->request = $request;
        $this->TokensAutorizadosRepository = new TokensAutorizadosRepository();
    }

    /**
     * @return string
     */
    public function processarRequest(){
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
        
        if(in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_REQUEST, true)){
            $retorno = $this->direcionarRequest();
        }

        return $retorno;
    }
    
    private function direcionarRequest(){
        if($this->request['metodo'] !== self::GET && $this->request['metodo'] !== self::DELETE){
            $this->dadosRequest = JsonUtil::tratarCorpoRequisicaoJson();
        }
        //na API final criar uma classe para validar os tokens e validar os hosts, também tratar o Json e destinos
        $this->TokensAutorizadosRepository->validarToken(getallheaders()['Authorization']);
    }
}
