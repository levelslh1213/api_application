<?php

namespace Service;

use Repository\UsuariosRepository;
use InvalidArgumentException;
use Util\ConstantesGenericasUtil;

class UsuariosService
{
    private const TABELA = 'usuarios';
    private const RECURSOS_GET = ['listar'];

    private array $dados;

    private object $UsuariosRepository;

    public function __construct($dados = []){
        $this->dados = $dados;
        $this->UsuariosRepository = new UsuariosRepository();
    }

    public function validarGet(){
        $return = null;
        $recurso = $this->dados['recurso'];
        if(in_array($recurso, self::RECURSOS_GET, true)){
            $return = $this->dados['id'] > 0 ? $this->getOneByKey() : $this->$recurso();
        }
        else{
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if($return == null){
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }
        return $return;
    }

    private function getOneByKey(){
        return $this->UsuariosRepository->getPostgres()->getOneByKey(self::TABELA, $this->dados['id']);
    }

    private function listar(){
        return $this->UsuariosRepository->getPostgres()->getAll(self::TABELA);
    }
}
