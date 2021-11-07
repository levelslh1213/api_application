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
            $consultaToken = 'SELECT id FROM ' . self::TABELA . ' WHERE token= :token AND status = :status';
            $stmt = $this->getPostgres()->getDb()->prepare($consultaToken);
            $stmt->bindValue(':token', $token);
            $stmt->bindValue(':status', ConstantesGenericasUtil::SIM);
            $stmt->execute();
            if($stmt->rowCount() !=1){
                header('HTTP/1.1 401 Unauthorized');
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_NAO_AUTORIZADO);
            }
            /**
             * Na aplicação final será criado o método de adicionar o host e ao adicionar o host teremos um 
             * token específico para ele e vamos validar o token e o host
             */
            }else {
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_VAZIO);
            }

    }
    public function generateToken($request, $idInserido){
        $token = md5($request['host']);
        if($this->authorizeToken($token, $idInserido) > 0){
            return $token;
        }
        else{
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_GENERICO);
        }
    }

    private function authorizeToken($token, $idInserido){
        $consulta = 'INSERT INTO ' . self::TABELA . '(token, status, id_host) values (:token, :status, :id_host)';
        $this->getPostgres()->getDb()->beginTransaction();
        $stmt = $this->getPostgres()->getDb()->prepare($consulta);
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':status', ConstantesGenericasUtil::SIM);
        $stmt->bindValue(':id_host', $idInserido);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $this->getPostgres()->getDb()->commit();
            $idInserido = $this->getPostgres()->getDb()->lastInsertId();
            return $idInserido;
        }
        else{
            $this->getPostgres()->getDb()->rollback();
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_GENERICO);
        }
    }

    public function deleteToken($idHost){
        $tokenId = $this->getTokenId($idHost);
        return $this->postgres->delete(self::TABELA, $tokenId['id']);
    }

    private function getTokenId($idHost){
        if ($idHost) {
            $consulta = 'SELECT id FROM ' . self::TABELA . ' WHERE id_host = :id';
            $stmt = $this->getPostgres()->getDb()->prepare($consulta);
            $stmt->bindParam(':id', $idHost);
            $stmt->execute();
            $totalRegistros = $stmt->rowCount();
            if ($totalRegistros === 1) {
                return $stmt->fetch($this->getPostgres()->getDb()::FETCH_ASSOC);
            }
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_SEM_RETORNO);
        }

        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_ID_OBRIGATORIO);
    }
}
