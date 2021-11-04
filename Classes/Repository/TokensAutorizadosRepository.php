<?php

namespace Repository;

use DB\Pgsql;
use Util\ConstantesGenericasUtil;
use InvalidArgumentException;

class TokensAutorizadosRepository
{
    
    private object $postgres;
    public const TABELA = "tokens_autorizados";

    public function getPostgres(){
        return $this->postgres;
    }

    public function __construct(){
        $this->postgres = new Pgsql();
    }

    public function validarToken($token){
        $token = str_replace([' ', 'Bearer'], '', $token);
        if($token){
            $consultaToken = 'SELECT id FROM ' . self::TABELA . 'WHERE token= :token AND status = :status';
            $stmt = $this->getPostgres()->getDb()->prepare($consultaToken);
            $stmt->bindValue(':token', $token);
            $stmt->bindValue(':status', ConstantesGenericasUtil::SIM);
            $stmt->execute();
            if($stmt->rowCount() !=1){
                header('HTTP/1.1 401 Unauthorized');
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_NAO_AUTORIZADO);
            }
            echo 'token autorizado';
            /**
             * Na aplicação final será criado o método de adicionar o host e ao adicionar o host teremos um 
             * token específico para ele e vamos validar o token e o host
             */
        }else {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_VAZIO);
        }

    }



}
