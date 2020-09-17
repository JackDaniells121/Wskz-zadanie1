<?php
class DB2{
    private $conn;  //connection
    private $servername = "localhost";
    private $username = "dbuser1";
    private $password = "1234";
    private $myDB   = "wskz";

    public function __construct(){
        $this->Connect();
    }
    
    public function Connect(){
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->myDB", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function GetUser($table_name,$where=null){
        $sql="SELECT * FROM $table_name ";
        if($where)
            $sql.="WHERE $where";
    
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(); 
        $result = $stmt->fetch();
        
        return($result);
    }
    public function Insert($table_name, $values){
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $values['DateCreated']=date('Y-m-d');
        $values['Id']=uniqid();
    
        $sql = "INSERT INTO $table_name (".implode(',',array_keys($values)).") VALUES (:";
        $sql.=implode(',:',array_keys($values)).")";
    
        $stmt = $this->conn->prepare($sql);
        $ar=[];
    
        foreach($values as $key=>$v){
                
            $stmt->bindParam(":$key", $ar[$key]);
            
            $ar[$key]=$v; 
        }
        $stmt->execute();
        return true;
    }
    public function Update($table_name, $id, $values){
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $values['DateModified']=date('Y-m-d');
        $vals='';
        $i=0;
        foreach($values as $key=>$v){       
            if($i!=0)
                $vals .=",";
    
            $vals .=" $key='".$v."'";
            $i++; 
        }
        $sql = "UPDATE $table_name SET $vals WHERE Id='$id'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
    public function Delete($table_name, $id){
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "DELETE FROM $table_name WHERE Id='";
        
        if(is_array($id))
            $sql.=implode("' OR Id='",$id)."'";    
        else
            $sql.=$id."'";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

}