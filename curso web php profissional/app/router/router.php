<?php

function exactMatchUri($uri,$routes){

    return (array_key_exists($uri,$routes)) ? [$uri => $routes[$uri]] : [];
}

function regularExpress($uri,$routes){
    
    return array_filter(array_keys($routes),
    function($value) use($uri){
        $regex = str_replace('/','\/',ltrim($value,'/'));
        $resultado = preg_match($regex,ltrim($uri,'/'),$matched);
        return preg_match("/^$regex$/",ltrim($uri,'/'));
    },
);

}

function params($uri,$matchedUri){
    if(!empty($matchedUri)){
        $matchedToGetParams = array_values($matchedUri)[0];
        return array_diff(
            $uri,
            explode('/',ltrim($matchedToGetParams,'/'))
        );
    }

    return [];

};
    
function formatParams($uri,$params){

    $paramsData = [];
    foreach($params as $index => $param){
        $paramsData[$uri[$index - 1]] = $param;
    }
    return $paramsData;
 
}

function router(){

    $uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

    $routes = require 'routes.php';
    
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    var_dump($_SERVER['REQUEST_METHOD']);

    $matchedUri = exactMatchUri($uri,$routes[$requestMethod]);

    $params = [];

    if(empty($matchedUri)){
        $matchedUri = regularExpress($uri,$routes[$requestMethod]);
        $uri = explode('/',ltrim($uri,'/'));
        $params = params($uri,$matchedUri);
        $params = formatParams($uri,$params);
    };

    if(!empty($matchedUri)){
       return controller($matchedUri,$params);
    }
    return $matchedUri;

    throw new Exception('Algo deu errado');
}