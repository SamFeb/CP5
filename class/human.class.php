<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once('animal.class.php');

class Human extends Animal {
    //Attribut privé
    private $fname;

    //Constructeur
    public function __construct(string $newFname, string $newName, string $newDob, float $newWeight, bool $newFemale){
        //Assigne la valeur des paramètres aux attributs de la fille
        $this->setFname($newFname);
        //Assigne la valeur des params aux attributs de la mère
        $this->name=$newName;
        $this->setDob($newDob);
        $this->setWeight($newWeight);
        $this->setFemale($newFemale);
        // Incrémente le nombre d'instance de la classe mère
        parent::$nb++;
    }

    //Accesseurs/Mutateurs

    public function getFname(){
        return $this->fname;
    }

    public function setWeight(float $newWeight){
        if ($newWeight < .5 || $newWeight > 650){
            throw new Exception(__CLASS__ . ' : Le poids doit être compris entre 200g et 1t !');
        }else{
        $this->weight = $newWeight;
        }
    }

    public function setFname(string $newFname){
        $this->fname = $newFname;
    }

    //Destructeur
    public function __destruct()
    {
        //Décrémente le nb d'instances de la classe mère
        parent::$nb--;
    }
}