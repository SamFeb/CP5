<?php 
//récupération des valeurs saisies et application sécurité
foreach ($_POST as $key=>$val){
    $params[':'.$key] = (isset($_POST[$key]) && !empty($_POST[$key]))?
    htmlspecialchars($_POST[$key]): null;
}

//Crypte mail et mot de passe

$params [':mail'] = md5 (md5($params[':mail']) . strlen($params[':mail']));
$params [':pass'] = sh1 (md5($params[':mail']) . md5($params[':pass']));

var_dump($_POST);
var_dump($params);

include_once('inc/constants.inc.php');
try{
    // Connexion à la BDD(base de données)
    $cnn = new PDO('mysql:host='.HOST.';port=' . PORT .';dbname=' . DATA . ';charset=utf8',
    USER, PASS);
    // options
    $cnn -> setAttribute(PDO::ATTR_ERRMODE, PDO ::ERRMODE_EXCEPTION);
    $cnn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //Test si le mail n'existe pas déjà
    $sql = 'SELECT COUNT(*)  as nb FROM users WHERE mail=?'; //paramètre anonyme
    $qry = $cnn -> prepare($sql); //prépare la requête
    $sqy -> execute(array($params[':mail']));
    $row  = $qry -> fetch();
    var_dump($row);
    if($row['nb']==1){
        echo '<p>Cette adresse mail existe déja ! ';
        echo '<a href="index.php">Retour à l\'acceuil</a>';
    }else{
        $sql = 'INSERT INTO users (pseudo, mail, pass) VALUES (:pseudo, :mail, :pass)';
        $qry = $cnn -> prepare ($sql);
        $qry -> execute($params);
        unset ($cnn);//Déconnexion
        header('location:login.php?m=ccok');
    }
}catch(PDOExeption $err){
    $err -> getMessage;
}