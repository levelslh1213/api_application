<?php

namespace Repository;
use DB\Pgsql;
use Util\ConstantesGenericasUtil;
use InvalidArgumentException;
use Repository\TokensAutorizadosRepository;

class HostRepository
{
    private object $postgres;
    private object $TokensAutorizadosRepository;
    public const TABELA = "hosts";

    public function getPostgres(){
        return $this->postgres;
    }
    public function getTokensAutorizadosRepository(){
        return $this->TokensAutorizadosRepository;
    }

    public function __construct(){
        $this->postgres = new Pgsql();
        $this->TokensAutorizadosRepository = new TokensAutorizadosRepository();
    }

    public function validateHost($hostName){
        if($hostName){
            $consultaHost = 'SELECT *
                               FROM '. self::TABELA . 
                            ' WHERE HOST_NAME = :host 
                                AND STATUS = :status';
            $stmt = $this->getPostgres()->getDb()->prepare($consultaHost);
            $stmt->bindValue(':host', $hostName);
            $stmt->bindValue(':status', ConstantesGenericasUtil::SIM);
            $stmt->execute();
            if($stmt->rowCount() != 1){
                header('HTTP/1.1 401 Unauthorized');
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_HOST_NAO_AUTORIZADO);
            }
        }
    }

    public function insertHost($request){
        $consulta = 'INSERT INTO hosts(host_name, status) VALUES (:hostName, :status)';
        $this->getPostgres()->getDb()->beginTransaction();
        $stmt = $this->getPostgres()->getDb()->prepare($consulta);
        $stmt->bindValue(':hostName', $request['host']);
        $stmt->bindValue(':status', ConstantesGenericasUtil::SIM);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $this->getPostgres()->getDb()->commit();
            $idInserido = $this->getPostgres()->getDb()->lastInsertId();
            return ['id_inserido' => $idInserido, 'token' => $this->getNewtoken($request, $idInserido)];
        }
        else{
            $this->getPostgres()->getDb()->rollback();
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_INSERCAO);
        }
    }

    public function getNewToken($request, $idInserido){
        return $this->TokensAutorizadosRepository->generateToken($request, $idInserido);
    }
}
