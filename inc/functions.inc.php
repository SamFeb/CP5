<?php
/*
* Renvoie l'écart en années entre deux dates passées en paramétres
* @param string $date1 une chaine contenant une date (ex: '1999-07-13')
* @param string $date2 une autre chaine contenant une date (ex:''12/31/2001)
* @ return int âge en nombre d'années
*/

function age(string $date1, string $date2):int
{
    //Test savoir si $date1 contient bien une date
    //Donne vrai si $date1 est une date ou faux si il ne l'est pas 
    if((bool) strtotime($date1) && (bool) strtotime($date2)){
        $d1=strtotime($date1);
        $d2=strtotime($date2);
        //Structure qui s'assure d'avoir tjr une valeur positif
        if($d1>$d2){
            $gap=$d1-$d2;
        }elseif($d2>$d1) {
            $gap=$d2-$d1;
        }else {
            $gap = 0;
        }
        //Renvoie entier le plus bas de $gap
        return floor($gap / 60/ 60 / 24 / 365.25);
    } else {
        //Déclenche une erreur avec un msg
        trigger_error("L'un ou les deux paramétres n'est pas une date.",E_USER_ERROR);
        return false;
    };
}
?>