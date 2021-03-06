<?php
include_once('database.class.php');

/**
 * 
 * Classe fille Model qui hérite de la classe mère Database
 * Objectif : CRUD
 */

 final class Model extends Database
 {
    //Attributs privés de la classe
    private $db = null;
    private $table='';

    //Accesseurs/Mutateurs

    public function setTable(string $newTable)
    {
        $this->table=$newTable;
    }

    public function getTable():string
    {
        return $this->table;
    }

    //Constructeur

    public function __construct(string $newHost, string $newDbname, string $newUser, string $newPass, string $newTable)
    {
        //Assigne les valeurs des arguments aux attributs de la classe fille
        $this->setTable($newTable);
        //Assigne les valeurs des arguments aux attributs de la classe mère : connexion
        $this->db=new Database($newHost,$newDbname,$newUser,$newPass);
    }

        /**
     * Ajoute une nouvelle ligne dans la table (C de CRUD)
     * @param array $data - tableau de type POST contenant les valeurs à insérer dans la table
     * @return bool renvoie TRUE si insertion OK
     */

     public function create(array $data): bool
     {
        try {
            //Remplit le tableau de paramètres pour la requête
            foreach ($data as $key => $val) {
                $params[':'.$key]=htmlspecialchars($val);
            }
            //Prépare et exécute la requête
            $sql = 'INSERT INTO '.$this->getTable().'('.implode(',', array_keys($data)).') VALUES('.implode(',',array_keys($params)) . ')';
            $qry = $this->db->cnn->prepare($sql);
            return $qry->execute($params);
        } catch (PDOException $err) {
            throw new Exception(__CLASS__ . ' : ' . $err->getMessage());
        }
     }

    /**
     * Renvoie toutes les lignes de la table
     */
    public function readAll():array
    {
        $sql='SELECT * FROM ' .$this->getTable();
        return $this->db->getResult($sql);
    }

    /**
    * Renvoie une seule ligne de la table
    * @param string $pk - colonne clé primaire
    * @param string $id - valeur de la clé primaire
    * @return array
    */

    public function read(string $pk, string $id):array
    {
        $sql = 'SELECT * FROM ' .$this->getTable() . ' WHERE ' . $pk . '=?';
        $params = array($id);
        return $this->db->getResult($sql,$params);
    }

    /**
     * Modifie la table via la ligne et le tableau en paramètre
     * @param array $data - tableau associatif contenant les données à remplacer dans la table
     * @param string $pk  - clé primaire de la table 
     * @param string $id - valeur clé primaire
     * @param bool renvoie TRUE si modification OK
     */
    public function update(array $data, string $pk, string $id):bool{
        
        try {
            //Remplit le tableau de paramètre pour la requête
            foreach ($data as $key => $val) {
                $params[':' . $key] = htmlspecialchars($val);
                $assign[]= $key .'=:'.$key;
            }
            $params[':id']=$id;
            //Prépare et exécute la requếte SQL
            $sql = ' UPDATE ' .$this->getTable().' SET ' . implode(',', $assign).' WHERE '.$pk.'=:id';
            $qry = $this->db->cnn->prepare($sql);
            return $qry->execute($params);
        } catch (PDOException $err) {
            throw new Exception(__CLASS__ . ' : ' . $err->getMessage());
        }
    }

    /**
     * Supprime dans la table la ligne dont l'id est passée en paramètre
     * @param string $pk - colonne clé primaire
     * @param string $id - valeur clé primaire
     * @param bool renvoie TRUE si suppression OK
     */
    

    public function delete(array $data, string $pk, string $id):bool
    {
        try {
            $sql = 'DELETE FROM ' .$this->getTable() . ' WHERE ' . $pk . '=?';
            $params=array($id);
            $qry=$this->db->cnn->prepare($sql);
            return $qry->execute($params);
        } catch (PDOException $err) {
            throw new Exception(__CLASS__ . ' : ' . $err->getMessage());
        }
    }
}