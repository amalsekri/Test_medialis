<?php
namespace Models;
use PDO;
use Models\Repository\User;

class UserModel extends PdoModel{
    public $id;
    public $email;
    public $password;
   
    private static $instance = null;
    // methode static pour instancier lobjet
    public static function getInstance() {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new UserModel();
        return self::$instance;
    }
   

    public function selectByEmail($email){
       
         $pdostatement = self::pdo()->prepare("SELECT * FROM user WHERE email = :email");
         $pdostatement->bindParam(":email",$email);
         $pdostatement->execute();
         if( $pdostatement ){
             return $pdostatement->fetchAll(PDO::FETCH_CLASS, User::class);
         } else {
             return false;
         }
    }

    public function insertInto($user)
    {
        $texteRequete = "INSERT INTO user (email, password) VALUES (:email, :password)";
    
        $pdostatement = self::pdo()->prepare($texteRequete);
        $password = $user->getPassword();
        $email = $user->getEmail();    
        $pdostatement->bindParam(":email",$email);
        $password = password_hash($this->password, PASSWORD_BCRYPT);
        $pdostatement->bindParam(":password",$password);
        $result = $pdostatement->execute();
        return $result;
     
     
    }
    public function update($user)
    {
        # code...
        $pdostatement = $pdo->prepare("SELECT * FROM user WHERE id = :id");
        $pdostatement->bindValue(":id", $id);
        $resultat = $pdostatement->execute();
        if( $resultat && $pdostatement->rowCount() == 1 ){
            $abonne = $pdostatement->fetch(\PDO::FETCH_ASSOC);
            return $abonne;
        }
    }

    public function delete($user)
    {
        # code...
    }

    public function selectByPseudo($email)
    {
        $pdostatement = self::pdo()->query("SELECT * FROM user WHERE email = \"$email\"");
        if( $pdostatement ){
            $pdostatement->setFetchMode(PDO::FETCH_CLASS, User::class);
            return $pdostatement->fetch();
        } else {
            return false;
        }
    }
    
}