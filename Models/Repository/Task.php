<?php
namespace Models\Repository;
class Task {
    private $id;
    private $tasklist_id;
    private $description;
    private $status;
    

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
     * Get the value of tasklist_id
     */ 
    public function getTasklist_id()
    {
        return $this->tasklist_id;
    }

    /**
     * Set the value of tasklist_id
     *
     * @return  self
     */ 
    public function setTasklist_id($tasklist_id)
    {
        $this->tasklist_id = $tasklist_id;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}