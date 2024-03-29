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
        $request['host'] = $_SERVER['HTTP_HOST'];

        return $request;

    }
    public static function getUrls(){
        $uri = str_replace('/' . DIR_PROJETO,'', $_SERVER['REQUEST_URI']);
        return explode('/', trim($uri, '/'));
    }
}
