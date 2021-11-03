<?php

namespace Repository;

use DB\Pgsql;

class TokensAutorizadosRepository
{
    
    private object $postgres;
    public const TABELA = "TOKENS_AUTORIZADOS";

    public function __construct(){
        $this->postgres = new Pgsql();
    }

    public function validarToken($token){

    }

    public function getPostgres(){
        return $this->postgres;
    }

}
