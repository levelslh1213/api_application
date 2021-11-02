<?php

namespace Util;

class RotasUtil
{
    public static function getRotas(){
        $urls = self::getUrls();

        $request = [];
        $request['rota'] = strtoupper($urls[0]);
        $request['recurso'] = $urls[1] ?? null;
        $request['id'] = $urls[2] ?? null;
        $request['metodo'] = $_SERVER['REQUEST_METHOD'];

        return $request;

    }
    public static function getUrls(){
        /*
        *echo '<pre>';
        *var_dump($_SERVER);
        */

        $uri = str_replace('/' . DIR_PROJETO,'', $_SERVER['REQUEST_URI']);
        return explode('/', trim($uri, '/'));


        //VARIÁVEL GLOBAL $_SERVER QUE GUARDA INFORMAÇÕES SOBRE A REQUISIÇÃO QUE ESTÁ SENDO MONTADA
        //UTILIZAR ELA PARA FAZER A VALIDAÇÃO DE HOST
    }
}
