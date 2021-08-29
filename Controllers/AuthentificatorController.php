<?php
namespace Controllers;
use Models\UserModel;
use Models\Repository\User;

use \Firebase\JWT\JWT;

class AuthentificatorController extends BaseController{

    private static $instance = null;
    public $email;
    public $password;
    // methode static pour instancier lobjet
    public static function getInstance() {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new AuthentificatorController();
        return self::$instance;
    }
    // fonction pour créer un user
    public function register($email, $password)
    {
        if (!empty($email) && !empty($password) )
       {
            if( filter_var($email, FILTER_VALIDATE_EMAIL)){
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
   
                $request = UserModel::getInstance()->insertInto($user);
                 
                 if($request){
                  
                     http_response_code(201);
                     echo json_encode(["message" => "User was successfully registere."]);
                 }else{
                     http_response_code(503);
                     echo json_encode(["message" => "Unable to register the user."]);  
                 }
                }else{
                    http_response_code(503);
                    echo json_encode(["message" => "Invalid Email"]);  
                }

            }else{
                http_response_code(503);
                    echo json_encode(["message" => "Email and Password does not be empty"]);  
            }
     

       
    // throw new Exception('bad format for username or password');


    }
    // fonction pour se connecter, verifier credentiel, creer JWT token
    public function login($email, $password)
    {
        $user = UserModel::getInstance()->selectByEmail($email);
        
        foreach ($user as $elt) {

            
            $prod = [
                "id" => $elt->getId(),
                "email" => $elt->getEmail(),
                "password" => $elt->getPassword()

            ];
            // on push le produit fetcher dans notre tableau $tableauProduits
           $password2 = $prod["password"];        }
        if($user){
        

            if(password_verify($password, $password2))
            {
                $secret_key = "YOUR_SECRET_KEY";
                $issuer_claim = "THE_ISSUER"; // this can be the servername
                $audience_claim = "THE_AUDIENCE";
                $issuedat_claim = time(); // issued at
                $notbefore_claim = $issuedat_claim + 10; //not before in seconds
                $expire_claim = $issuedat_claim + 60; // expire time in seconds
                $token = array(
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                        "id" => $prod['id'],
                        "email" => $prod['email']
                ));
        
                http_response_code(200);
        
                $jwt = JWT::encode($token, $secret_key);
                echo json_encode(
                    array(
                        "message" => "Successful login.",
                        "jwt" => $jwt,
                        "email" => $email,
                        "expireAt" => $expire_claim
                    ));
            }
            else{
        
                http_response_code(401);
                echo json_encode(array("message" => "Login failed.", "password" => $password));
            }
        }
        
    }

}