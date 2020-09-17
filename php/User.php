<?php
require 'Database.php';
require 'PageController.php';

class User{
    private $db;
    private $page;
    private $salt = 'salt12345';
    // private $login;
    // private $password;
    // private $name;
    // private $surname;
    // private $gender;

    public function __construct(){
        $this->db = new DB2();
        $this->page = new PageController();
    }

    public function Hash($pass){
        return md5($pass.$this->salt);
    }

    public function findUser($name,$pass=null){
        if($pass==null)
            $where = "Login='".$name."'";
        else
            $where = "Login='".$name."' AND Password='".$this->Hash($pass)."'";
    
       return $this->db->GetUser('User',$where);    
    }

    public function Login($postArray){
        if($postArray['Login'] && $postArray['Password']){

            $this->user=$this->findUser($postArray['Login'],$postArray['Password']);    
            
            if($this->user){
                               
                $_SESSION['logged']=true;

                $_SESSION['User']= $this->user;

                $this->page->Redirect('../index.php');
            }else{
                $this->page->Redirect('../login.php?error=1');
            }
        }else
            return false;
    }

    public function New($postArray){
        
        if($postArray['Login'] && $postArray['Password']){
            
            $this->user = $this->findUser($postArray['Login']);
            if($this->user)
                $this->page->Redirect('../register.php?error=2');
            else{
                unset($postArray['registerNewUser']);

                $postArray['Password'] = $this->Hash($postArray['Password']);
                $result = $this->db->Insert('User',$postArray);
                
                if($result){
                    $this->page->Redirect('../login.php');
                }
            }
        }
    }

}

session_start();

$user = new User();

if(!empty($_POST['registerNewUser'])){
    $user->New($_POST);
}
if(!empty($_POST['loginUser'])){
    $user->Login($_POST);
}


//------session logout 
//- not working dont know why?
if(isset($_GET['logout']) && $_GET['logout']==1)
{
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
}
