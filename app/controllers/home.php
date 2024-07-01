<?php

class Home extends Controller{

    
    public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->model('user');
        $this->model('ad');
        $user = null;

        if(isset($_SESSION['email']) && !empty($_SESSION['email'])) {
            $user = User::where('email', $_SESSION['email'])->first();
        }
        $oglasi= Ad::where('premium', 1)->get();
        // Return the view with the user data
        return $this->view('home/index', array('user' => $user,'oglasi' => $oglasi));
    }


    public function test(){
        echo "test";
    }
}