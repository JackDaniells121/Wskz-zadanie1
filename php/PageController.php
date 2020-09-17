<?php

class PageController{

    public function __construct(){
        
    }
    public function RedirectIfNotLogged(){           
        $this->Redirect('login.php');
    }

    public function Redirect($location){
        ob_start();
        header('Location: '.$location); 
        ob_end_flush();
    }
    
}