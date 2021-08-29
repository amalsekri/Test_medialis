<?php

namespace Controllers;

use Models\TaskListModel;
use Models\Repository\TaskList;
use Models\TaskModel;
use Models\Repository\Task;

class TaskListController extends BaseController
{
    private $id;
    public $title;
    public $data;
    private static $instance = null;
    // methode static pour instancier lobjet
    public static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new TaskListController();
        return self::$instance;
    }

    // fonction pour recupérer toutes les listes de taches
    public function index()
    {
        $taskLists = TaskListModel::getInstance()->selectAll();
        //dd($taskLists);
        if (!empty($tasklists)) {
            // On initialise un tableau associatif, on a besoin de mettre les données renvoyer par l'API dans un tableau, parce que elles seront cacheable et on va l'envoyer en json
            $tableauProduits = [];
            $tableauProduits['taskList'] = [];

            // On parcourt les produits

            extract($tasklists);
            foreach ($tasklists as $elt) {


                $prod = [
                    "id" => $elt->getId(),
                    "title" => $elt->getTitle(),

                ];
                // on push le produit fetcher dans notre tableau $tableauProduits
                $tableauProduits['taskList'][] = $prod;
            }
            http_response_code(200);
            echo json_encode($tableauProduits);
        }
    }
    public function getTaskList()
    {

        $tasklists = TaskListModel::getInstance()->selectAll();
     
        if (!empty($tasklists)) {
            // On initialise un tableau associatif, on a besoin de mettre les données renvoyer par l'API dans un tableau, parce que elles seront cacheable et on va l'envoyer en json
            $tableauProduits = [];
            $tableauProduits['taskLists'] = [];

            // On parcourt les produits

            extract($tasklists);
            foreach ($tasklists as $elt) {


                $prod = [
                    "id" => $elt->getId(),
                    "title" => $elt->getTitle(),

                ];
                // on push le produit fetcher dans notre tableau $tableauProduits
                $tableauProduits['taskLists'][] = $prod;
            }
            http_response_code(200);
            echo json_encode($tableauProduits);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            // echo json_encode(["message" => "La modification a été effectuée"]);;
            if (!empty($donnees->id) && !empty($donnees->title)) {
                // Ici on a reçu les données
                // On hydrate notre objet
                $tasklistModel->id = $donnees->id;
                $tasklistModel->title = $donnees->title;


                if ($tasklistModel->insertInto($donnees)) {
                    // Ici la modification a fonctionné
                    // On envoie un code 200
                    http_response_code(200);
                    echo json_encode(["message" => "La modification a été effectuée"]);
                } else {
                    // Ici la création n'a pas fonctionné
                    // On envoie un code 503
                    http_response_code(503);
                    echo json_encode(["message" => "La modification n'a pas été effectuée"]);
                }
            }
        }
    }
    // renvoie un tasklist par id
    public function getTaskListById($id)
    {
        $oneTaskList = TaskListModel::getInstance()->selectById($id);
        if (!empty($oneTaskList)) {
            // On initialise un tableau associatif, on a besoin de mettre les données renvoyer par l'API dans un tableau, parce que elles seront cacheable et on va l'envoyer en json
            $tableauProduits = [];
            $tableauProduits['taskList'] = [];

            // On parcourt les produits
            foreach ($oneTaskList as $elt) {
                $prod = [
                    "id" => $elt->getId(),
                    "title" => $elt->getTitle(),
                ];
                // on push le produit fetcher dans notre tableau $tableauProduits
                $tableauProduits['taskList'][] = $prod;
            }
            http_response_code(200);
            echo json_encode($tableauProduits);
        }
    }
    // fonction pour créer une nouvelle liste
    public function createTaskList($title)
    {

        $taskList = new TaskList();
        $taskList->setTitle($title);
  
        $request = TaskListModel::getInstance()->insertInto($taskList);

        if ($request) {
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);
        }
    }
    // fonction creation d'un task
    public function createTask($data)
    {
        extract($data);
        $task = new Task();
        $task->setTaskList_id($tasklist_id);
        $task->setDescription($description);
        $task->setStatus($status);
        $request = TaskModel::getInstance()->insertInto($task);

        if ($request) {
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);
        }
    }
    // fonction pour modifier une liste
    public function updateTaskList($id, $title)
    {

        $taskList = TaskListModel::getInstance()->selectById($id);

        if ($taskList) {
            $data = TaskListModel::getInstance()->update($id, $title);
         
            if ($data) {
                http_response_code(201);
                echo json_encode(["message" => "La modification a été effectué"]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "La modification n'a pas été effectué"]);
            }
        } else {
            http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);
        }
    }
    public function updateTask($data, $id)
    {
       
        $task = TaskModel::getInstance()->selectById($id);
        var_dump($task);
        

        if ($task) {
            $data = TaskModel::getInstance()->update($data, $id);
            var_dump($data);
            if ($data) {
                http_response_code(201);
                echo json_encode(["message" => "La modification a été effectué"]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "La modification n'a pas été effectué"]);
            }
        } else {
            http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);
        }
    }
    public function getTask()
    {
    }
    // fonction pour supprimer une liste tasklist
    public function deleteTaskList($id)
    {

        $taskList = TaskListModel::getInstance()->selectById($id);


        if ($taskList) {
            $taskListDeleted = TaskListModel::getInstance()->delete($id);

            if ($taskListDeleted) {
                http_response_code(201);
                echo json_encode(["message" => "La supression a été effectué"]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "La supression n'a pas été effectué"]);
            }
        } else {
            http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);
        }
    }

    public function getTaskById()
    {
    }
    // renvoi les tasks d'un tasklist specifique
    public function getTasksByList($taskListId)
    {
        $AllTasksByList = TaskModel::getInstance()->getTasksByIdList($taskListId);
       
        if (!empty($AllTasksByList)) {
            // On initialise un tableau associatif, on a besoin de mettre les données renvoyer par l'API dans un tableau, parce que elles seront cacheable et on va l'envoyer en json
            $tableauProduits = [];
            $tableauProduits['allTasksByList'] = [];

            foreach ($AllTasksByList as $elt) {

                $prod = [
                    "id" => $elt->getId(),
                    "tasklist_id" => $elt->getTaskList_id(),
                    "description" => $elt->getDescription(),
                    "status" => $elt->getStatus(),

                ];
                // on push le produit fetcher dans notre tableau $tableauProduits
                $tableauProduits['allTasksByList'][] = $prod;
            }
            http_response_code(200);
            echo json_encode($tableauProduits);
        }
    } //fin getTasksByList

    public function deleteTask($id)
    {

        $task = TaskModel::getInstance()->selectById($id);


        if ($task) {
            $taskDeleted = TaskModel::getInstance()->delete($id);

            if ($taskDeleted) {
                http_response_code(201);
                echo json_encode(["message" => "La supression a été effectué"]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "La supression n'a pas été effectué"]);
            }
        } else {
            http_response_code(501);
            echo json_encode(["message" => " No routes matches or missing argument"]);
        }
    }
}
