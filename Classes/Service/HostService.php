<?php

namespace Service;

use InvalidArgumentException;
use Util\ConstantesGenericasUtil;
use Repository\HostRepository;

class HostService
{
    private const TABELA = 'hosts';
    private const RECURSOS_POST = ['PostAddHost'];
    private const RECURSOS_DELETE = ['DeleteHost'];

    private array $request;

    private object $HostRepository;

    public function __construct($request = []){
        $this->request = $request;
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
    
    public function validarDelete(){
        $return = null;
        $recurso = $this->request['recurso'];
        if(in_array($recurso, self::RECURSOS_DELETE, true)){
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

    private function DeleteHost(){
        $this->HostRepository->getTokensAutorizadosRepository()->deleteToken($this->request['id']);
        $return = $this->HostRepository->getPostgres()->delete(self::TABELA, $this->request['id']);
        return $return;
    }
}
