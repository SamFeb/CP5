/**
 * Fonction appelée lorsqu'on change de langue dans la liste : AJAX
 */

document.getElementById("lang").addEventListener('change',function(){
        //step 1 : instanciation
    let xhr = new XMLHttpRequest;
    // step 2 ouverture requête AJAX
    xhr.open('GET','ajax-result.php?lang=' + this.value,true);
    //step 3 envoie de la requête AJAX
    xhr.send();
    //step 4 : attend le retour du serveur
    xhr.addEventListener('readystatechange',function(){
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            document.getElementById('pays').innerHTML=xhr.responseText;
        }
        });
    }
);