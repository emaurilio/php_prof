<?php

require 'bootstrap.php';


try{
    $data = router();

    if(!isset($data['data'])){
        throw new Exception('O indice data está faltando');
    }

    if(!isset($data['data']['title'])){
        throw new Exception('O indice title está faltando');
    }

    if(!isset($data['view'])){
        throw new Exception('O indice view está faltando');
    }

    if(!file_exists(ROOT.'/app/views/'.$data['view'].'.php')){
        throw new Exception("Está view {$data['view']} não existe");
    }

    $view = $data['view'].'.php';
    extract($data['data']);
    require '../app/views/master.php';

}catch(Exception $e){
    var_dump($e -> getMessage());
}
