# Test_medialis
| Method              | URL          | Reponse |
| :--------------- |:---------------:| -----:|
|GET:Affiché taskList |   /todolist/taskList      | {"taskLists":[{"id":"1","title":"boulot"},{"id":"2","title":"Personnel"}]} |
| GET:Affiché taskList par id  | /todolist/taskList/{id}             |  {"taskList":[{"id":"1","title":"boulot"}]} |
| GET:Affiché tasks par taskList  | /todolist/taskList/{id}/tasks          |  {"allTasksByList":[{"id":"1","tasklist_id":"1","description":"Faire le test technique","status":"en cours"},{"id":"2","tasklist_id":"1","description":"test pour ajout task","status":"finish"}]}   |
| POST:Créer un user| /todolist/user|     |
| POST:créer un token| /todolist/login            |  |
| POST:créer un taskList |/todolist/taskList           |  |
| POST:créer un task |/todolist/taskList/{id}/task          |  
| DELETE:supprimer un taskList| /todolist/taskList/{id}   |
| DELETE:supprimer un task| /todolist/task/{id}   |
| PUT:Update un taskList|  /todolist/taskList/{id}    |
 PUT:Update un task|  /todolist/task/{id}    |
 
 # L'utilisation de l'API
 ### Télécharger le dossier
 ### Installer la base de données
 ### Exécuter les URLS dans le tableau ci-dessus
 
# Temps passé
### 5 jours avec de 2 à 3h par jour
#### samedi et dimanche environ 6h par jour
### Ce qui fait environ 27h

