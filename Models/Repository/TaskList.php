<?php
namespace Models\Repository;
use PDO;

class TaskList {
    private $id;
    public $title;
    public function serialize() {
        return array(
                'id' => $this->Id,
                'title' => $this->title
            );
    }
    public function unserialize($pdoResults) {
        $this->setId($pdoResults['id']);
      
        $this->setTitle($pdoResults['title']);
    }

    public function setTaskList($listId, $title)
    {
        $this->setId($id);

        $this->setTitle($title);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}


?>