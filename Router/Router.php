<?php
namespace Router;
use Controllers\TaskListController;
use Controllers\AuthentificatorController;

class Router{

    public function run() {

        if (isset($_SERVER['REQUEST_METHOD'])) {
            
           if (isset($_GET['url'])) {

                //get route
                $uri = $_SERVER['REQUEST_URI'];
                $uri = explode('/',$_GET['url']);
                // compter le nombre d'élément dans l'URL
                    $elementByUrl = count($uri);
                
                    $method = $_SERVER['REQUEST_METHOD'];

                //check if the routes contains /api/ in first parameter
                if ($uri[0] != "todolist") {
                    http_response_code(405);
                    echo json_encode(["message" => "URL must start with todolist"]);

                }

                //save POST parameters in $_data
                $data = json_decode(file_get_contents('php://input'), true);
   
                //call controllers by request method
                if($method == 'GET'){
                   
                  
                     return $this->getGets($uri, $elementByUrl, $data);
              
                
                }elseif($method == 'POST'){

                    return $this->getPosts($uri, $elementByUrl, $data);
                   
                }elseif($method == 'PUT'){

                    return $this->getPuts($uri, $elementByUrl, $data);

                }elseif($method =='DELETE'){
                     
                     return $this->getDeletes($uri, $elementByUrl, $data);

                    
                }else{
                    // si non la méthode passée n'est pas autorisée
                    // on declenche erreur
                    http_response_code(405);
                    echo json_encode(["message" => "Pas de méthode correspond a votre demande"]);

                }
              
                $objFeedController = new $nomClass();
                // $ = $method;
                $objFeedController->{$strMethodName}($id);
                
                    }
        }else{
            http_response_code(405);
            echo json_encode(["message" => "La requette manque des elements"]);

        }
         
}
    // fonction pour renvoyer des resultats des requettes de type GET
    private function getGets($url, $elementByUrli, $datas){
        
        if($elementByUrli == 2 && $url['1'] == "taskList"){

            //la on va afficher tous les tasklist
            return TaskListController::getInstance()->getTaskList();

        }elseif($elementByUrli == 3 && $url['1'] == "taskList" && ctype_digit($url[2])){
            //on va chercher un tasklist specifique
        
            return TaskListController::getInstance()->getTaskListById($url[2]);

        }elseif($elementByUrli == 4 &&  $url['1'] == "taskList" && ctype_digit($url[2]) && $url[3]=='tasks')
        {
            // ici on appel getTasksByList,on va afficher tasks d'un tasklist donné
        return TaskListController::getInstance()->getTasksByList($url[2]);
        }else{
            http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);

            }
    }
    // fonction pour renvoyer des resultats des requettes de type POST
    public function getPosts($url, $elementByUrli, $datas){
     
        if($datas)
        {
            extract($datas);
          
            
           if($elementByUrli == 2 && $url['1'] == "user")
            {
                //  ici on appel la fonction register
                return AuthentificatorController::getInstance()->register($email, $password);
                
            }elseif($elementByUrli == 2 && $url['1'] == "login")
            {     
                  
                return AuthentificatorController::getInstance()->login($email, $password);
         
            }
            elseif($elementByUrli == 2 && $url['1'] == "taskList")
                {
                    return TaskListController::getInstance()->createTaskList($title);
                    
                }elseif($elementByUrli == 4 && $url['1'] == "taskList" && ctype_digit($url[2]) && $url[3]=='task')
                {
                    return TaskListController::getInstance()->createTask($datas);

                }
                else{
                    http_response_code(501);
                    echo json_encode(["message" => " No routes matches or missing argument"]);
                }
    }else{
        http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);
    }
        
    }
    // fonction pour renvoyer des resultats des requettes de type PUT
    public function getPuts($url, $elementByUrli, $datas){
        if($datas){
            extract($datas);

        // pour URL /todolist/task/{id}
        if($elementByUrli == 3 && $url['1'] == "task" && ctype_digit($url[2]))
        {

            return TaskListController::getInstance()->updateTask($datas, $url['2']);
    // pour URL todolist/taskList/{id}
        }elseif($elementByUrli == 3 && $url['1'] == "taskList" && ctype_digit($url[2]))
        {
            return TaskListController::getInstance()->updateTaskList($url[2],$title);
        }else
        {
            http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);
        }
        }else
        {
            http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);
        }
        
        }
    // fonction pour renvoyer des resultats des requettes de type DELETE
    public function getDeletes($url, $elementByUrli, $datas)
    {
        if($elementByUrli == 3 && $url['1'] == "task" && ctype_digit($url[2]))
        {

            return TaskListController::getInstance()->deleteTask($url['2']);

        }elseif($elementByUrli == 3 && $url['1'] == "taskList" && ctype_digit($url[2]))
        {
            return TaskListController::getInstance()->deleteTaskList($url['2']);
        }else{
            http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);
        }
    }
}
