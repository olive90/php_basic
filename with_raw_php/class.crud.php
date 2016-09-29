<?php

class CRUD{
    private $host      = HOST;
    private $user      = USER;
    private $pass      = PASSWORD;
    private $dbname    = DATABASE;
    private $stmt;
 
    private $dbh;
    private $error;
 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }        
    
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }
	
    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
	
	
    public function execute(){
        return $this->stmt->execute();
    }
	
	
    public function resultList(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
	
    public static function get_results($query){
            $db = new CRUD;
            $db->query($query);
            $db->execute();
        return $db->resultList();
    }
	public function get_row($query){
		$db = new CRUD;
		$db->query($query);
		$db->execute();
        return $db->single();
    }
	
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }


    public function rowCount(){
        return $this->stmt->rowCount();
    }


    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }


    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }


    public function endTransaction(){
        return $this->dbh->commit();
    }

    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }


    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

    public function showData($table){

         $sql="SELECT * FROM $table";
         $q = $this->dbh->query($sql) or die("failed!");
         while($r = $q->fetch(PDO::FETCH_ASSOC)){
         $data[]=$r;
         }
         return $data;
     }

    public function deleteData($id,$table){

         $sql="DELETE FROM $table WHERE id=:id";
         $q = $this->dbh->prepare($sql);
         $q->execute(array(':id'=>$id));
         return true;

 }



}
