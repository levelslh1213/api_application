<?php

namespace Service;

use InvalidArgumentException;
use Util\ConstantesGenericasUtil;
use Repository\EmailRepository;

class EmailService
{
    private const RECURSOS_POST = ['PostSendEmails'];

    private array $request;
    private array $dadosRequest;

    private object $EmailRepository;

    public function __construct($request = [], $dadosRequest){
        $this->request = $request;
        $this->dadosRequest = $dadosRequest;
        $this->EmailRepository = new EmailRepository();
    }

    public function validarPost(){
        $return = null;
        $recurso = $this->request['recurso'];
        
        if(in_array($recurso, self::RECURSOS_POST, true)){
            $return = $this->$recurso();
        }
        else{
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if($return == null){
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }
        return $return;
    }

    private function PostSendEmails(){
        $htmlCode = $this->dadosRequest['html'];
        $destinos = explode('/', trim($this->dadosRequest['destinos'], '/'));

        echo 'Chegou aqui!';
        echo '<pre>';
        var_dump($htmlCode);
        var_dump($destinos);
        exit;
    }
}
