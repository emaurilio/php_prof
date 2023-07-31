<?php

namespace app\controllers;

class user {
    public function show($params){
        if(!isset($params['user'])){
            return redirect('/');               
            };

        $user = findBy('user','id',$params['user']);

        var_dump($user);
        die();

        }

}