<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" 
    crossorigin="anonymous">
    <script src="script.js" defer></script>
    <title>Document</title>
</head>

<body class="container">
    <?php
        //Calcule l'écart en jours entre le 4/01/2021 et aujd
    $start='2021-01-04';
    $date1=strtotime('now');//date du jour
    $date2=strtotime($start);//convertir string en number
    $gap= floor(($date1-$date2) / 60 / 60 / 24);//Diviser par autant de sec,min et h
    ?>

    <div class="jumbotron">
        <h1 class="display-4">Espace Abonnés</h1>
        <p class="lead">Cet espace est réservé aux abonné.e.s du CDA de Compiégne.
        Il est en place depuis <?php echo $gap; ?> jours.
        Il compte aujourd'hui XXX abonné.e.s.</p>
        <hr class="my-3">
        <p>Cliquez sur le bouton si dessous pour vous identifier :</p>

        <button class="btn-success" id="btnRegister" data-toggle="modal" 
        data-target="#register">S'inscrire</button>

        <button class="btn-success" id="btnLogin" data-toggle="modal" 
        data-target="#login">Se connecter</button>
    </div>

    <!--//**Supra : Lien d'ajout d'un formulaire pour créer un nouveau membre*/-->
    <div class="text-center">
    <a href="membre-add-form.php" class="btn btn-primary">Ajouter un membre</a>
    </div>
    

    <section id="team" class="d-flex flex-wrap" > 
    <div class="card m-3" style="width:15rem;">
        <img src="pics/boys.jpg" alt="" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Lak</h5></h5>
                <p><strong>Age : </strong>40 ans </p>
                <p><strong>Taille : </strong> 1.70 </p>
            </div>
    </div>
    <?php
        //Imports
        include_once("inc/team.inc.php");
        include_once("inc/functions.inc.php");

        $pattern = 
            '<div class="card m-3" style="width:15rem;">
            <img src="pics/%s.jpg" alt="" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">%s</h5>
                    <p><strong>Age : </strong>%d ans </p>
                    <p><strong>Taille : </strong> %gm </p>
                </div>
            </div>';
        $html = '';
        //Parcourt le tableau TEAM
        foreach ($team as $member) {
            $html .= sprintf($pattern, ($member["female"] ? "girls": "boys"), $member["fname"], age($member["dob"],date("Y-m-d")),
            $member["size"]);
        }

        echo $html;
        ?>
    </section>

    <!-- Modal -->
<div class="modal fade" id="login" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="login.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mail">Identifiant</label>
                        <input type="email" class="form-control" id="mail" name="mail" required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Mot de passe</label>
                        <input type="password" class="form-control" id="pass" name="pass" pattern="[A-Za-z0-9_$#]{8,}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <input type="submit" value="Se connecter" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="register" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Inscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="register.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" pattern="[A-Za-z0-9\u00c0-\u00f]{5,20}" required>
                </div>
                    <div class="form-group">
                        <label for="mail">Courriel</label>
                        <input type="email" class="form-control" id="mail" name="mail" required>
                    </div>
                    <div class="form-group">
                        <label for="pass1">Mot de passe</label>
                        <input type="password" class="form-control" id="pass1" name="pass1" pattern="[A-Za-z0-9_$#]{8,}" required>
                    </div>
                    <div class="form-group">
                        <label for="pass2">Vérification du mot de passe</label>
                        <input type="password" class="form-control" id="pass2" name="pass2" pattern="[A-Za-z0-9_$#]{8,}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <input type="submit" id="btnValidate" value="S'inscrire" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" 
    crossorigin="anonymous"></script>
</body>
</html>