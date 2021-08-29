<?php
namespace Models;
use Models\Repository\TaskList;

class TaskListModel extends PdoModel
{
    public $title;
    public $id;
    public $data;
    private static $instance = null;
    // methode static pour instancier lobjet
    public static function getInstance() {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new TaskListModel();
        return self::$instance;
    }
    public function selectAll(){
        $pdostatement = self::pdo()->query("SELECT * FROM tasklist");
    
        return $pdostatement->fetchAll(\PDO::FETCH_CLASS, "Models\Repository\TaskList");
    }

    public function selectById(int $id){
        $pdostatement = self::pdo()->prepare("SELECT * FROM tasklist WHERE id = :id");
        $pdostatement->bindParam(":id",$id);
        $pdostatement->execute();
        if( $pdostatement ){
            return $pdostatement->fetchAll(\PDO::FETCH_CLASS, "Models\Repository\TaskList");
        } else {
            return false;
        }
    }

    public function insertInto($data)
    {
    $texteRequete = "INSERT INTO tasklist (title) VALUES (:title)";
    $pdostatement = self::pdo()->prepare($texteRequete);
    $title = $data->getTitle();
    
    $pdostatement->bindParam(":title",$title);
    return $pdostatement->execute();
    }

    public function update($id,$title){
       
        $texteRequete = "UPDATE tasklist 
                        SET title = :title
                        WHERE id = :id";
        $pdostatement = self::pdo()->prepare($texteRequete);
 
        $pdostatement->bindParam(":title", $title);
        $pdostatement->bindParam(":id", $id);
        return $pdostatement->execute();
    }

    public function delete($id)
    {
       //$id = $data->getId();
       $request =  self::pdo()->prepare("DELETE FROM tasklist WHERE id = :id");
       $request->bindParam(":id",$id);
       $success = $request->execute();
       return $success;
      
    }

}
?>