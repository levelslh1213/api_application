<?php

namespace Util;

class RotasUtil
{
    public static function getRotas(){
        //echo '1';
        $urls = self::getUrls();
        //echo '4';
        $request = [];
        $request['rota'] = strtoupper($urls[0]);
        $request['recurso'] = $urls[1] ?? null;
        $request['id'] = $urls[2] ?? null;
        $request['metodo'] = $_SERVER['REQUEST_METHOD'];
        //echo '5';
        return $request;

    }
    public static function getUrls(){
        //echo '2';
        /*
        *echo '<pre>';
        *var_dump($_SERVER);
        */

        $uri = str_replace('/' . DIR_PROJETO,'', $_SERVER['REQUEST_URI']);
        //echo '3';
        return explode('/', trim($uri, '/'));
        /**
         * explode -> quebra uma string através de um caracter específico
         * trim -> tira os espaços e substitui por outro caracter
         */

        //VARIÁVEL GLOBAL $_SERVER QUE GUARDA INFORMAÇÕES SOBRE A REQUISIÇÃO QUE ESTÁ SENDO MONTADA
        //UTILIZAR ELA PARA FAZER A VALIDAÇÃO DE HOST
    }
}
