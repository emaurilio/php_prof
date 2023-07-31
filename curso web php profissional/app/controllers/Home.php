<?php

namespace app\controllers;

class Home
{
    public function index($params){

        $users = all('Users');
        return [
            'view' => 'home',
            'data' => ['title'=> 'Home','users' => $users]
        ];
    }
}   