<?php

namespace Repository;

use DB\Pgsql;
use Util\ConstantesGenericasUtil;
use InvalidArgumentException;

class UsuariosRepository
{
    
    private object $postgres;
    public const TABELA = "usuarios";

    public function getPostgres(){
        return $this->postgres;
    }

    public function __construct(){
        $this->postgres = new Pgsql();
    }
    


}
