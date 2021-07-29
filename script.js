
var btnValidate = document.querySelector("#register form");


btnValidate.addEventListener("submit", function(evt){
    let pass1 = document.getElementById("pass1").value;
    let pass2 = document.getElementById("pass2").value;
    if(pass1 != pass2){
        evt.preventDefault(); //arréte les evenements (stop la lecture des fichiers)
        alert("Les mots de passe ne correspondent pas !")
    }
});