<?php 
session_start();
    //var_dump($_POST);
    //récupérer les données
    // if (isset($_POST['prenom'])) {
    //$prenom = $_POST['prenom'];
    // }
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';  //<thomas> -> &lt;thomas&gt;
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
    $taille = isset($_POST['taille']) ? floatval($_POST['taille']) : 0.0;
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    //Initialiser le tableau $erreurs
    $erreurs = [];
    //valider les données
    //valider $prenom : caractères valides : a-zA-Z et les caractères accentués
        // if(empty($prenom)){
        //ajouter un message d'erreur dans le tableau $erreurs
        //   $erreurs["prenom"] = "le prénom est obligatoire";
        // }
    if(preg_match("/^[A-Za-zÀ-ú]{1,}$/", $prenom) === 0){
      //ajouter un message d'erreur dans le tableau $erreurs
        $erreurs["prenom"] = "le prénom n'est pas valide";
    }
    //valider $age : $age >= 12 <= 130
    if($age < 12 || $age > 130 ){
      //ajouter un message d'erreur dans le tableau $erreurs
        $erreurs["age"] = "l'age n'est pas valide";
    }
    //valider $taille : $taille >= 0.50 <= 2.50
    if($taille < 0.50 || $taille > 2.50){
      //ajouter un message d'erreur dans le tableau $erreurs
        $erreurs["taille"] = "la taille n'est pas valide";
    }
    //valider $genre : $genre  [Homme, Femme]
    if($genre != "Homme" && $genre != "Femme"){
      //ajouter un message d'erreur dans le tableau $erreurs
        $erreurs["genre"] = "le genre n'est pas valide";
    }
    //3.protection contre l'attaque XSS
    $prenom = htmlspecialchars($prenom);
    $age = htmlspecialchars($age);
    $taille = htmlspecialchars($taille);
    $genre = htmlspecialchars($genre);
    //4.si echec de validation,
    //rediriger vers la page de formulaire avec des messages d'erreur et les données saisies
    if (count($erreurs) > 0) {//si le tableau $erreurs n'est pas vide
        $_SESSION["membre-add-form-donnees"]["prenom"] = $prenom;
        $_SESSION["membre-add-form-donnees"]["age"] = $age;
        $_SESSION["membre-add-form-donnees"]["taille"] = $taille;
        $_SESSION["membre-add-form-donnees"]["genre"] = $genre;
        $_SESSION["membre-add-form-erreurs"] = $erreurs;
        header("location: membre-add-form.php");//redirection avec le code HTTP 302
        exit;
    }

    //**5.sinon,
        //*5.1 on stocke les données dans la BDD
            include('inc/constants.inc.php');
            //echo HOST;
        //* Création de la connexion à une BDD
        
            try{
                $dsn = 'mysql:host=' . HOST . ';dbname=' . DATA . ';port=' . PORT;
                $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
                $pdo = new PDO($dsn,USER,PASS,$options);
                //*On donne des paramétres nommées que l'on remplacera par une valeur
                //?Requete préparé pour eviter les injections sql (requete écrite en sql)
                $sql = "insert into membre (prenom,age,taille,genre) values(:prenom,:age, :taille, :genre)";
                //Créer valeur $pdoStatement dans laquelle on stocke la valeur de retour
                $pdoStatement = $pdo->prepare($sql);
                //Dans le tableau :Pour chaque paramétre dérfini plus haut on lui donne une valeur
                $pdoStatement->execute(
                    array(
                        ":prenom" => $prenom,
                        ":age"=>$age,
                        ":taille"=>$taille,
                        ":genre"=>$genre
                    )
                );
                //Affichage du message confirmation ajout
                echo '<div class="jumbotron"> Membre ajouté '.$prenom.' a été ajouté !
                </div>';
            } catch(Exception $ex){
                //Met msg erreur dans un cle de session 
                $_SESSION["membre-add-form-erreur-sql"] =  $ex->getMessage();;
                header("location: membre-add-form.php");//redirection avec le code HTTP 302
                exit;
            }

        //redirection vers la page d'accueil
?>