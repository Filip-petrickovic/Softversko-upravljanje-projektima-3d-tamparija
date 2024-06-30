<?php

class Home extends Controller{

    public function index(){
        $user = $this->model('user');
        $user->name= "john";
        return $this->view('home/index', array('user'=>$user));
    }

    public function test(){
        echo "test";
    }
}