<?php

/**
 * 
 * TODO : � compl�ter
 * 
 * Auteur : Santiago Escobar Toro
 * Date : 12.11.2024
 * Description : Methods for interacting with the database
 */


 class Database {


    // Variable de classe
    private $connector;

    /**
     * TODO: � compl�ter
     */
    public function __construct(){

        // TODO: Se connecter via PDO et utilise la variable de classe $connector
        try
        {
            $this->connector = new PDO('mysql:host=localhost:6033;dbname=db_nicknames;charset=utf8' , 'root', 'root');
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * TODO: � compl�ter
     */
    private function querySimpleExecute($query){

        // TODO: permet de pr�parer et d�ex�cuter une requ�te de type simple (sans where)
        return $this->connector->query($query);
    }

    /**
     * TODO: � compl�ter
     */
    private function queryPrepareExecute($query, $binds){
        
        // TODO: permet de pr�parer, de binder et d�ex�cuter une requ�te (select avec where ou insert, update et delete)
        // Utilisation de prepare, bindValue et execute
        $req = $this->connector->prepare('SELECT * FROM Table WHERE id = :varId AND input = :varInput');
        $req->bindValue('varId', $binds['id'], PDO::PARAM_INT);
        $req->bindValue('varInput', $binds['input'], PDO::PARAM_STR);
        $req->execute();

    }

    /**
     * TODO: � compl�ter
     */
    private function formatData($req){
        //
        // TODO: traiter les donn�es pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
        //

        // Traitement, transformer le résultat en tableau associatif
        return $req->fetchALL(PDO::FETCH_ASSOC);

    }

    /**
     * TODO: � compl�ter
     */
    private function unsetData($req){

        // TODO: vider le jeu d�enregistrement
        $req->closeCursor();
        unset($connector);
    }

    /**
     * TODO: � compl�ter
     */
    public function getAllTeachers(){
        //
        // R�cup�re la liste de tous les enseignants de la BD
        //

        // Avoir la requête sql
        $query = "SELECT * FROM t_teacher;";

        // Appeler la m�thode pour executer la requ�te
        $req = $this->connector->query($query);

        // TODO: appeler la m�thode pour avoir le r�sultat sous forme de tableau
        $teachers = $this->formatData($req);
        
        // TODO: retour tous les enseignants
        return $teachers;
    }

    /**
     * TODO: � compl�ter
     */
    public function getOneTeacher($id){
        //
        // TODO: r�cup�re la liste des informations pour 1 enseignant
        //

        // TODO: avoir la requ�te sql pour 1 enseignant (utilisation de l'id)
        $query = "SELECT * FROM t_teacher WHERE idTeacher = :idTeacher;";
        
        // TODO: appeler la m�thode pour executer la requ�te
        $req = $this->connector->prepare($query);
        $req-> bindValue('idTeacher', $id, PDO::PARAM_STR);
        $req->execute();

        // TODO: appeler la m�thode pour avoir le r�sultat sous forme de tableau
        $teachers = $this->formatData($req);

        // TODO: retour l'enseignant
        return $teachers[0];
        
    }


    // + tous les autres m�thodes dont vous aurez besoin pour la suite (insertTeacher ... etc)

    public function insertTeacher($data){
    //
    // Insert of a teacher in t_teacher
    //

    // Request to insert
    $query = "INSERT INTO t_teacher (idTeacher, teafirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection)";
    $query .= 'VALUES (DEFAULT, :firtsName, :name, :genre, :nickName, :origin, :section);';

    
    // To execute the request
    $req = $this->connector->prepare($query);
    $req->bindValue('firtsName', $data['firstName'], PDO::PARAM_STR);
    $req->bindValue('name', $data['name'], PDO::PARAM_STR);
    $req->bindValue('genre', $data['genre'], PDO::PARAM_STR);
    $req->bindValue('nickName', $data['nickName'], PDO::PARAM_STR);
    $req->bindValue('origin', $data['origin'], PDO::PARAM_STR);
    $req->bindValue('section', $data['section'], PDO::PARAM_STR);
    $req->execute();
    }


    public function getAllSections(){
        //
        // R�cup�re la liste de tous les section 
        //

        // Avoir la requête sql
        $query = "SELECT * FROM t_section;";

        // Appeler la m�thode pour executer la requ�te
        $req = $this->connector->query($query);

        // TODO: appeler la m�thode pour avoir le r�sultat sous forme de tableau
        $sections = $this->formatData($req);
        
        // TODO: retour tous les enseignants
        return $sections;
    }

    public function delTeacher($idTeacher)
    {
        //
        // Delete teacher with his id
        //

        // Sql Request
        $query = "DELETE FROM t_teacher WHERE idTeacher = :idTeacher;";

        // Execute 
        $req = $this->connector->prepare($query);
        $req->bindValue('idTeacher', $idTeacher, PDO::PARAM_STR);
        $req->execute();
    }

    public function editTeacher($data)
    {
        //
        // Delete teacher with his id
        //

        // Sql Request
        $query = "UPDATE t_teacher";
        $query .= " SET teaFirstname = :firstName, teaName = :name, teaGender = :genre, teaNickname = :nickName, teaOrigine = :origin, fkSection = :section";
        $query .= " WHERE idTeacher = :idTeacher;"; // post to have all values of form

        var_dump($query);

        // Execute 
        $req = $this->connector->prepare($query);
        $req->bindValue('firstName', $data['firstName'], PDO::PARAM_STR);
        $req->bindValue('name', $data['name'], PDO::PARAM_STR);
        $req->bindValue('genre', $data['genre'], PDO::PARAM_STR);
        $req->bindValue('nickName', $data['nickName'], PDO::PARAM_STR);
        $req->bindValue('origin', $data['origin'], PDO::PARAM_STR);
        $req->bindValue('section', $data['section'], PDO::PARAM_STR);
        $req->bindValue('idTeacher', $data['idTeacher'], PDO::PARAM_STR);
        $req->execute();
    }

    public function getOneSection($idSection)
    {
        //
        // Get one section with ID
        //

        // Sql Request
        $query = "SELECT * FROM t_section WHERE idSection = :idSection";

        // Execute 
        $req = $this->connector->prepare($query);
        $req->bindValue('idSection', $idSection, PDO::PARAM_STR);
        $req->execute();

        // Data in table form
        $sections = $this->formatData($req);

        return $sections[0];
    }

    public function loginAttemp($data)
    {
        //
        // To validate login attemp
        //

        // Sql Request
        $query = "SELECT * FROM t_login WHERE logUser = :logUser AND logPass = :logPass";

        // Execute 
        $req = $this->connector->prepare($query);
        $req->bindValue('logUser', $data['user'], PDO::PARAM_STR);
        $req->bindValue('logPass', $data['password'], PDO::PARAM_STR);
        $req->execute();

        // Data in table form
        $users = $this->formatData($req);

        if (count($users) === 1) {
            // utilisateur trouvé en base de données
            return $users[0];
        }

        return false;
    }

 }


?>