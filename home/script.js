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


document.getElementById("iniciar").addEventListener("click", function() {
    const usuarioLogado = this.getAttribute("data-logged") === 'true'; // Recupera o valor do data-attribute

    if (usuarioLogado) {
        // Se o usuário estiver logado, faz o scroll até a seção de planos
        document.getElementById("planos").scrollIntoView({ behavior: 'smooth' });
    } else {
        // Caso não esteja logado, redireciona para a página de login
        window.location.href = "/Chinelaflix/login/login.php";
    }
});