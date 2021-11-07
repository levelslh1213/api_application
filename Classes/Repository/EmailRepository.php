<?php

namespace Repository;

use DB\Pgsql;
use Util\ConstantesGenericasUtil;
use InvalidArgumentException;
use Repository\TokensAutorizadosRepository;

class EmailRepository
{
    private object $postgres;
    private object $TokensAutorizadosRepository;
    public const TABELA = "emails";

    public function getPostgres(){
        return $this->postgres;
    }

    public function __construct(){
        $this->postgres = new Pgsql();
    }


}
