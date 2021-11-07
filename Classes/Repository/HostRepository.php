<?php

namespace Repository;
use DB\Pgsql;
use Util\ConstantesGenericasUtil;
use InvalidArgumentException;

class HostRepository
{
    private object $postgres;
    public const TABELA = "hosts";

    public function getPostgres(){
        return $this->postgres;
    }

    public function __construct(){
        $this->postgres = new Pgsql();
    }

    public function validateHost($serverName, $serverPort){
        if($serverName){
            $consultaHost = 'SELECT *
                               FROM '. self::TABELA . 
                            ' WHERE HOST_NAME = :host 
                                AND HOST_PORT = :port 
                                AND STATUS = :status';
            $stmt = $this->getPostgres()->getDb()->prepare($consultaHost);
            $stmt->bindValue(':host', $serverName);
            $stmt->bindValue(':port', $serverPort);
            $stmt->bindValue(':status', ConstantesGenericasUtil::SIM);
            $stmt->execute();
            if($stmt->rowCount() != 1){
                header('HTTP/1.1 401 Unauthorized');
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_HOST_NAO_AUTORIZADO);
            }
        }
    }
}
