function toggleMenu(classparam){
    let x = document.querySelector(classparam);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
 }