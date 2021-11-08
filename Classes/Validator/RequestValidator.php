<?php
namespace Validator;

use Util\ConstantesGenericasUtil;
use Util\JsonUtil;
use InvalidArgumentException;
use Repository\TokensAutorizadosRepository;
use Repository\HostRepository;
use Service\UsuariosService;
use Service\HostService;
use Service\EmailService;

class RequestValidator
{
    private array $request;
    private $dadosRequest;
    private object $TokensAutorizadosRepository;
    private object $HostRepository;

    private const GET = 'GET';
    private const DELETE = 'DELETE';
    private const HOST = 'HOST';
    private const EMAIL = 'EMAIL';

    public function __construct($request)
    {
        $this->request = $request;
        $this->TokensAutorizadosRepository = new TokensAutorizadosRepository();
        $this->HostRepository = new HostRepository();
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
        if($this->request['recurso'] != 'PostAddHost'){
            $this->HostRepository->validateHost($this->request['host']);
            $this->TokensAutorizadosRepository->validarToken(getallheaders()['Authorization']);
        }
        $metodo =$this->request['metodo'];
        return $this->$metodo();
    }

    private function get(){
        $return = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
        if(in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_GET, true)){
            switch($this->request['rota']){
                case self::HOST:
                    $HostService = new HostService($this->request);
                    $return = $HostService->validarGet();
                break;
                default:
                    throw InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $return;
    }

    public function post(){
        $return = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
        
        if(in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_POST, true)){
            switch($this->request['rota']){
                case self::HOST:
                    $HostService = new HostService($this->request);
                    $return = $HostService->validarPost();
                break;
                case self::EMAIL:
                    $EmailService = new EmailService($this->request, $this->dadosRequest);
                    $return = $EmailService->validarPost();
                break;
                default:
                    throw InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $return;
    }

    private function delete(){
        $return = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);
        if(in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_DELETE, true)){
            switch($this->request['rota']){
                case self::HOST:
                    $HostService = new HostService($this->request);
                    $return = $HostService->validarDelete();
                break;
                default:
                    throw InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $return;
    }

}
