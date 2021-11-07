<?php

namespace Service;

use InvalidArgumentException;
use Util\ConstantesGenericasUtil;
use Repository\HostRepository;

class HostService
{
    private const TABELA = 'host';
    private const RECURSOS_POST = ['PostAddHost'];

    private array $request;
    public $dadosRequest = [];

    private object $HostRepository;

    public function __construct($request = [], $dadosRequest = []){
        $this->request = $request;
        $this->dadosRequest = $dadosRequest;
        $this->HostRepository = new HostRepository();
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

    private function PostAddHost(){
        return $this->HostRepository->insertHost($this->request);
    }
}
