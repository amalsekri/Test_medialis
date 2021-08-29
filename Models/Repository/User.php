<?php
namespace Models\Repository;
use PDO;

class User {
    private $id;
    private $email;
    private $password;
    
    public function serialize() {
        return array(
                'id' => $this->Id,
                'email' => $this->email
            );
    }
    public function unserialize($pdoResults) {
        $this->setId($pdoResults['id']);
      
        $this->setEmail($pdoResults['email']);
        $this->setPassword($pdoResults['password']);
    }

    public function setTaskList($id, $email, $password)
    {
        $this->setId($id);

        $this->setEmail($email);
        $this->setPassword($password);
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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}