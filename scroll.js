window.addEventListener("scroll", function() {
    let navArea = document.getElementById("navArea");
    
    if (window.pageYOffset > 100) {
    navArea.classList.add("is-sticky");
    } 
    else {
    navArea.classList.remove("is-sticky");
    }
    });

