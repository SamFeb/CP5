<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once('../class/animal.class.php');
include_once('../class/human.class.php');

echo'<h2>Instantiation : ANIMAL </h2>';

$pet1 = new Animal;
$pet1 -> name = 'Milou';
//$milou -> dob = '1925-05-03';
//$milou -> weight = 6.54;
//$milou -> female = false;
var_dump ($pet1);
echo '<p>Nb d\'instances : ' .Animal::countInstances();

echo'<h2>Encapsultaion : getter et setters</h2>';
$pet1 -> setDob('1925-05-03');
$pet1 -> setWeight(6.54);
$pet1 -> setFemale('non');
var_dump ($pet1);
echo '<p>Nb d\'instances : ' .Animal::countInstances();


echo'<h2>Constructeur</h2>';
$pet2 = new Animal ('Garfield', 'chat', '1966-12-24', 7.8, false);
var_dump($pet2);
echo '<p>Nb d\'instances : ' .Animal::countInstances();

echo '<h2>Constantes de classe</h2>';
$pet3 = new Animal('Grominet', 'chat', '1954-02-08', 6.25, false);
var_dump($pet3);
echo '<p>' . $pet3->speak();
echo '<p>Nb d\'instances : ' .Animal::countInstances();

echo '<h2>Méthode GET AGE </h2>';
echo '<p>Age de Milou : ' . $pet1->getAge();
echo '<p>Age de Garfield : ' . $pet2->getAge();
echo '<p>Age de Grosminet : ' . $pet3->getAge();

echo '<h2>Méthode EAT</h2>';
$pet4 = new Animal('Jerry','souris','2015-05-10', .35, false);
$pet5 = new Animal('Tom','chat','2010-11-05', 4.65, false);
echo '<p>Nb d\'instances : ' .Animal::countInstances();
echo '<br>';
echo '<br>';
var_dump($pet5);
$pet5->eat($pet4);
var_dump($pet5);

unset($pet5);
echo '<p>Nb d\'instances : ' .Animal::countInstances();

echo '<h2>Instanciation : HUMAN </h2>';
$man1 = new Human('Gaston','Lagaffe','1957-05-06', 75.22, false);
var_dump($man1);
echo '<p>Nb d\'instances : ' .Animal::countInstances();