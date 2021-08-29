<?php
namespace Models;
use PDO;
use Models\Repository\Task;

class TaskModel extends PdoModel{
    public $id;
    public $tasklist_id;
    public $description;
    public $status;
    private static $instance = null;
    // methode static pour instancier lobjet
    public static function getInstance() {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new TaskModel();
        return self::$instance;
    }
    public function selectAll(){
        $pdostatement = self::pdo()->query("SELECT * FROM task");
        return $pdostatement->fetchAll(\PDO::FETCH_CLASS, Task::class);
    }
    // methode pour récupérer les tasks by tasklist_id
    public function selectByIdList(int $id){
        $pdostatement = self::pdo()->query("SELECT * FROM task WHERE tasklist_id = $tasklist_id");
        if( $pdostatement ){
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Task::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }

    public function selectById(int $id){
        $pdostatement = self::pdo()->query("SELECT * FROM task WHERE id = $id");
        if( $pdostatement ){
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, Task::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }
    public function getTasksByIdList($taskListId)
    {
        $pdostatement = self::pdo()->query("SELECT * FROM task WHERE tasklist_id = $taskListId");
      
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, Task::class);
    
    }
    public function insertInto($data)
    {
        $tasklist_id = $data->getTasklist_id();
        $description = $data->getDescription();
        $status = $data->getStatus();
       $texteRequete = "INSERT INTO task (tasklist_id, description, status) VALUES (:tasklist_id, :description, :status)";
       $pdostatement = self::pdo()->prepare($texteRequete);
       $pdostatement->bindParam(":tasklist_id", $tasklist_id);
       $pdostatement->bindParam(":description", $description);
       $pdostatement->bindParam(":status", $status);
       return $pdostatement->execute();
    }

    public function update($data, $id){
        $tasklist_id = $this->tasklist_id;
        $description = $this->description;
        $status = $this->status;
        $texteRequete = "UPDATE task 
                         SET tasklist_id = :tasklist_id, description = :description, status = :status
                         WHERE id = :id";
        $pdostatement = self::pdo()->prepare($texteRequete);
        $pdostatement->bindParam(":tasklist_id", $tasklist_id);
        $pdostatement->bindParam(":description", $description);
        $pdostatement->bindParam(":status", $status);
        $pdostatement->bindValue(":id", $id);
        return $pdostatement->execute();
    }

    public function delete($id)
    {
       //$id = $data->getId();
       $request =  self::pdo()->prepare("DELETE FROM task WHERE id = :id");
       $request->bindParam(":id",$id);
       $success = $request->execute();
       return $success;
      
    }
}