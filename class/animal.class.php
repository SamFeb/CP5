<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
/**
 * Initiation à la POO en PHP
 * Classe Animal
 */
class Animal{
    // Attributs publics
    public $name;
    public $type;

    //Attributs private
    private $dob;
    private $weight;
    private $female;

    //Attributs privé statique
    protected static $nb = 0;

    //Constantes
    const TYPE_DOG='chien';
    const TYPE_CAT='chat';
    const TYPE_BIRD='oiseau';
    const TYPE_FISH='poison';
    const TYPE_FERRET='furet';

    // Constructeur
    public function __construct(string $newName='', string $newType='', string $newDob='1970-01-02', float $newWeight=.2, bool $newFemale=true){
        $this->name=$newName;
        $this -> type = $newType;
        $this->setDob($newDob);
        $this->setWeight($newWeight);
        $this->setFemale($newFemale);
        self::$nb++;// Incrémente le compteur d'instance
    }

    public function eat(Animal $prey){
        $this->setWeight($this->getWeight() + $prey ->getWeight());
    }

    public function getAge(){
        $dateToday = strtotime(date('Y-m-d'));
        $dateAnimal = strtotime($this->getDob());
        return floor (($dateToday-$dateAnimal)/60/60/24/365.25);
     } 

    // Accesseurs et mutateurs

    public function getDob(){
        return $this->dob;
    }
    public function setDob(string $newDob){
        //test si param est une date
        if((bool) strtotime($newDob)){
            $this->dob = $newDob;
        }else {
        throw new Exception(__CLASS__ . 'Le paramètre doit être une date !');
        }
    }
    
    public function getWeight(){
        return $this->weight;
    }
    public function setWeight(float $newWeight){
        //test si le poid est cohérent
        if ($newWeight < .2 || $newWeight > 1000){
            throw new Exception(__CLASS__ . ' : Le poids doit être compris entre 200g et 1t !');
        }else{
        $this->weight = $newWeight;
        }
    }
    
    public function getFemale(){
        return $this->female;
    }
    public function setFemale(bool $newFemale){
        $this->female = $newFemale;
    }

    //Méthode SPEAK : cri de l'animal selon sont type
    public function speak(){
        //Structure If Else ElseIf
        /*if($this->type==Animal::TYPE_DOG){
            return "waf waf";
        } elseif($this->==Animal::TYPE_CAT){
            return "miaou";
        } elseif($this->==Animal::TYPE_BIRD){
            return "poison";
        } elseif($this->==Animal::TYPE_BLUD){
            return "poison";
        } elseif($this->==Animal::TYPE_FERRET){
            return "LesFurets.com";
        } else {
            return "pffft";
        }*/

        switch ($this->type) {
            case Animal::TYPE_DOG:
                return "WafWaf";
                break;
            case Animal::TYPE_CAT:
                return "Miaou";
                break;
            case Animal::TYPE_BIRD:
                return "CuiCui";
                break;
            case Animal::TYPE_FISH:
                return "Blud";
                break;
            case Animal::TYPE_FERRET:
                return "LesFurets.com";
                break;
            default:
                return "pffft";
        }
    }

    //Méthode statique qui le nb d'instances de la classe en cours
    public static function countInstances(){
        return self::$nb;
    }

    //Destucteur
    public function __destruct(){
        self::$nb--;//décrémente le compteur d'indtances
        return $this-> name . 'est parti';
    }
}
