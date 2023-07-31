<?php

function all($table){
    try{
        $connect = connect('Users',$fields = '*');

        $query = $connect->query("select {$fields} from Users ");

        return $query->fetchAll();

    }catch(PDOException $e){
        var_dump($e->getMessage());
    }
}

function findBy($table,$field,$value,$fields = '*'){

    try{
    $connect = connect();
    $prepare = $connect->prepare("select {$fields} from Users where {$field} = :{$field}");
    $prepare->execute([
        $field => $value
    ]);

    }catch(PDOException $e){
        var_dump($e->getMessage());
    }
}
