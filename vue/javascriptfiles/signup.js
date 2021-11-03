var validation=document.getElementById('register');
var pseudo=document.getElementById('pseudo');
var nom=document.getElementById('nom');
var prenom=document.getElementById('prenom');
var mail=document.getElementById('mail');
var mdp=document.getElementById('mdp');
var mdpConf=document.getElementById('mdpConf');
var form=document.getElementById('form');
pseudo.addEventListener('input',verifPseudo);
nom.addEventListener('input',verifNom);
prenom.addEventListener('input',verifPrenom);
mail.addEventListener('input',verifMail);
mdp.addEventListener('input',verifMdp);
mdpConf.addEventListener('input',verifConfMdp);
validation.addEventListener("click",verif);
function verif() {
    var ok;
    ok=verifPseudo()&& verifNom() && verifPrenom() && verifMdp()  && verifConfMdp();
    if(!ok){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Vérifier vos champs!',
        });
        //e.preventDefault();
        return false;
    }
    return true;
   /*
   else {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            /*if (result.isConfirmed) {
                Swal.fire('Saved!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
            form.submit();
        })
        //e.preventDefault();
    }
    */

}

function verifConfMdp() {
    const mdpConfValue=mdpConf.value.trim();
    const mdpValue=mdp.value.trim();
    if(!mdp.parentElement.classList.contains("error")){
        if(mdpConfValue!=mdpValue){
            setErrorFor(mdpConf,"Vérifier cette champ");
            return false;
        }
        else{
            setSuccessFor(mdpConf);
            return true;
        }
    }else{
        setErrorFor(mdpConf,"entrez un mot de passe valide");
        return false;
    }
}

function verifMail() {
    const regexMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const mailValue=mail.value.trim();
    if(mailValue=='')
        setErrorFor(mail,"Le mail ne doit pas être vide");
    else if(!mailValue.match(regexMail))
        setErrorFor(mail,"Mail invalid");
    else
        setSuccessFor(mail);
}

function verifMdp() {
    const regexMdp= /^(?=.*[0-9])(?=.*[!@#$%^&*:;])[a-zA-Z0-9!@#$%^&*:;]{6,16}$/;
    const mdpValue=mdp.value.trim();
    if(mdpValue==''){
        setErrorFor(mdp,"Le mot de pass ne doit pas être vide");
        return false;
    }
    else if(!mdpValue.match(regexMdp)){
        setErrorFor(mdp,"Mot de passe faible");
        return false;
    }
    else{
        setSuccessFor(mdp);
        return true;
    }

}
//Longeur entre 6 et 16 caractéres
// Au moins un chiffre
// Au moins un caractére spécial
function verifPrenom() {
    const prenomValue=prenom.value.trim();
    if(prenomValue=='')
        setErrorFor(prenom,"Le prénom ne doit pas être vide");
    else if(!isAlphabet(prenomValue))
        setErrorFor(prenom,"Prénom invalid");
    else
        setSuccessFor(prenom);
    return isAlphabet(prenomValue) && prenomValue!='';
}
function isAlphaNumeric(value){
    let regex =/^[0-9a-zA-Z_]+$/;
    return value.match(regex);
}
function isAlphabet(value){
    let regex =/^[a-zA-Z -çàéèù]+$/;
    return value.match(regex);
}
function verifNom() {
    const nomValue=nom.value.trim();
    if(nomValue=='')
        setErrorFor(nom,"Le nom ne doit pas être vide");
    else if(!isAlphabet(nomValue))
        setErrorFor(nom,"Nom invalid");
    else
        setSuccessFor(nom);
    return isAlphabet(nomValue) && nomValue!='';
}
function verifPseudo(){
    const pseudoValue=pseudo.value.trim();
    if(pseudoValue=='')
        setErrorFor(pseudo,"Le pseudo ne doit pas être vide");
    else if(pseudoValue.length<4){
        setErrorFor(pseudo,"Pseudo trop petit");
    }else if(!isAlphaNumeric(pseudoValue))
        setErrorFor(pseudo,"Pseudo invalid");
    else
        setSuccessFor(pseudo);
    return isAlphaNumeric(pseudoValue) && pseudoValue!='';
}

function setSuccessFor(input) {
    const formControl=input.parentElement;
    formControl.classList="form-control success";
}
function setErrorFor(input, message) {
    const formControl=input.parentElement;
    const small=formControl.querySelector('small');
    small.innerText=message;
    formControl.classList="form-control error";
}