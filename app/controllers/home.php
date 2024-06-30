<?php

class Home extends Controller{

    
    public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user = User::findOrFail(5);
        
        // Return the view with the user data
        return $this->view('home/index', array('user' => $user));
    }


    public function test(){
        echo "test";
    }
}