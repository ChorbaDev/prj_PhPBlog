var mail=document.getElementById('mail');
var mdp=document.getElementById('mdp');
var connexion=document.getElementById('Connexion');
mail.addEventListener('input',verifMail);
mdp.addEventListener('input',verifMdp);
connexion.addEventListener("click",verif);
function verif(){
    var ok;
    ok=verifMail() && verifMdp();
    if(!ok){
        alert("Vérifier vos champs!");
        return false;
    }
    return true;
}
function verifMail(){
    const mailValue=mail.value.trim();
    const regexMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(mailValue==''){
        setErrorFor(mail,"Entrer votre mail")
    }else if(!mailValue.match(regexMail)){
        setErrorFor(mail,"Mail invalide");
    }else setSuccessFor(mail);
    return (mailValue!='') && (mailValue.match(regexMail));
}
function verifMdp(){
    const mdpValue=mdp.value.trim();
    if(mdpValue=='')
        setErrorFor(mdp,"Entrer votre mot de passe");
    return mdpValue!='';
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