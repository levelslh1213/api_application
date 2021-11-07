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
        $request['server_name'] = $_SERVER['SERVER_NAME'];
        $request['server_port'] = $_SERVER['SERVER_PORT'];

        return $request;

    }
    public static function getUrls(){
        $uri = str_replace('/' . DIR_PROJETO,'', $_SERVER['REQUEST_URI']);
        return explode('/', trim($uri, '/'));
    }
}
