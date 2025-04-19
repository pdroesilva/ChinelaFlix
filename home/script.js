function toggleMenu() {
    var menu = document.getElementById("menu-content");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

// Fecha o menu se clicar fora dele
document.addEventListener("click", function(event) {
    var menu = document.getElementById("menu-content");
    var button = document.querySelector(".menu-hamburguer");

    if (!menu.contains(event.target) && !button.contains(event.target)) {
        menu.style.display = "none";
    }
});
