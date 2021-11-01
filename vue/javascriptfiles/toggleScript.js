function toggleMenu(classparam){
    var x= document.querySelector(classparam)
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
 }