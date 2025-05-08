<?php  
session_start();
$usuarioLogado = isset($_SESSION['user_id']) ? 'true' : 'false';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/pfp site.png">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>ChinelaFlix</title>
    <!--Voltando a estudar essa jossa-->

<!-- IMPORTANTE: CASO O CSS ESTEJA DEMORANDO MUITO PARA CARREGAR, ULTILIZE O ATALHO: CRTL + SHIFT + R -->

</head>
<body>
    <!-- INICIO CABEÇALHO -->
    <header>
        <nav>
        <div class="cabecalho">
        <h1>ChinelaFlix ツ</h1>    
        <li><a href="#">Home</a></li>
        <li><a href="#">Otimização e fps</a></li>
        <li><a href="#">Dicas de pvp</a></li>
        <li><a href="#">Minecraft settings</a></li>
        <!-- SE O USUARIO ESTIVER LOGADO, EXIBE O MEU HAMBURGUER, CASO CONTRARIO, EXIBE O BOTÃO DE LOGIN -->
        <?php 
        if (isset($_SESSION['user_id'])) {
            echo '
            <div class="menu">
                <button class="menu-hamburguer" onclick="toggleMenu()">☰</button>
                <div class="menu-content" id="menu-content">
                    <a href="../perfil/usuario.php">Editar Perfil</a>
                    <a href="logout.php">Sair</a>
                </div>
            </div>
            ';
        } else {
            // Se não estiver logado, exibe o botão de login
            echo '<button class="loginbtn"><a href="../login/login.php">Fazer login</a></button>';
        }
        ?>
    </div>
</nav>
</header>
<!-- FIM DO CABEÇALHO -->
<!-- <button class="loginbtn"><a href="../login/login.php">Fazer login</a></button> -->
<!-- VIDEO DE FUNDO -->
<div class="videoclip">
    <video class="MEUVIDEO" autoplay loop muted playsinline>
        <source class="ovideo" src="videoclip/home-video.mp4" type="video/mp4">
    </video>
</div>
<!-- FIM VIDEO DE FUNDO-->

<!-- COMEÇO CHAMAR ATENÇAO -->
<div class="main-container">
    <H1 class="titulo-main">Domine o pvp com <span style="color: red;">ChinelaFlix</span><br> e torne-se invencivel!</H1>
    <p>Vai mesmo ficar para tras? chega de perder pra esses randoms. <br>A partir de 10,99 você fara parte dos <span style="color: red; font: bold;">1% </span>que sabem os segredos das lendas do pvp. <br> Lidere os rankings com <span style="color: red; font: bold;">ChinelaFlix🏆</span></p>
    <br>
    <button class="iniciar" id="iniciar" data-logged="<?php echo $usuarioLogado; ?>">Comece Aqui</button>
</div>
<!-- FIM CHAMAR ATENÇAO -->
<br>
<!--MID SITE-->
    <div class="mid-site">
        <div class="mid-text">
        <h2>Já se perguntou <br> qual é o <span style="color: red; font: bold;">segredo</span> das lendas?</h2> 
         <p>Em algum momento da sua vida, você já deve ter caido contra AQUELE CARA, aquele cara que parecia saber de algo que você não sabia, ou que parecia cheater, mas será que era mesmo? bom, aqui no ChinelaFlix você tera uma outra visão de jogo, não se preocupe, não vamos abordar somente coisas simples como w-tap, cps entre outros, o pvp no minecraft é algo extremamente simples, mas ainda assim, poucos são capases de extrair 100% dos recursos e tecnicas existentes, até porque poucos conhecem as tecnicas secretas e sabem domina-las. Mas bom, agora não tem mais choro, só depende de você, aqui e agora, junte-se ao ChinelaFlix🏆.</p>  
        </div>
    <div class="legends">
        <img src="img/biel.png" alt="">
        <img src="img/spectro.png" alt="">
        <img src="img/chiela(lado).png" alt="principal">
        <img src="img/tringed.png" alt="">
        <img src="img/jacksterpvp.png" alt="">
        <img src="img/blackoutz.png" alt="">
        <img src="img/zonen.png" alt="">
        <img src="img/caiox.png" alt="">
        <img src="img/manpho.png" alt="">
        <img src="img/haxshw.png" alt="">
    </div>
</div>

<!-- FIM DO: MID SITE -->

<!-- SEÇÃO DOS PLANOS CHINELAFLIX -->
<div class="planos" id="planos">
    <div class="produtos">
        <h2>Plano mensal <br>[10,99]</h2>
        <img src="img/steve.jpg" alt=""> 
        <h3>Beneficios:</h3>
        <p>Acesso a todas as aulas✅</p>
        <p>Acesso as configs✅</p>
        <p>Acesso a otimização completa✅</p>
        <p>Chat comigo no discord❌</p>
        <p>Coaching ao vivo [...]❌</p>
        <p>Solicitar analise vod [...]❌</p>
        <p>Participar do ranking ChinelaFlix❌</p>
        <p>Bonus:❌</p>
        <p>[...]</p>
        <hr>
        <button class="buy">Comprar🛒</button>
    </div>
    <div class="produtos">
        <h2>Plano anual <br>[37,99]</h2>
        <img src="img/herobrine.png" alt="">
        <h3>Beneficios:</h3>
        <p>Acesso a todas as aulas✅</p>
        <p>Acesso as configs✅</p>
        <p>Acesso a otimização completa✅</p>
        <p>Chat comigo no discord✅</p>
        <p>Coaching ao vivo [3 p/ano]✅</p>
        <p>Solicitar analise vod [1 p/mes]✅</p>
        <p>Participar do ranking ChinelaFlix✅</p>
        <p>Bonus:❌</p>
        <p>[...]</p>
        <hr>
        <button class="buy">Comprar🛒</button>
    </div>
    <div class="produtos">
        <h2>Acesso vitalicio <br>[80,99]</h2>
        <img src="img/notch.png" alt="">
        <h3>Beneficios:</h3>
        <p>Acesso a todas as aulas✅</p>
        <p>Acesso as configs✅</p>
        <p>Acesso a otimização completa✅</p>
        <p>Chat comigo no discord✅</p>
        <p>Coaching ao vivo [2 p/mês]✅</p>
        <p>Solicitar analise vod [3 p/mes]✅</p>
        <p>Participar do ranking ChinelaFlix✅</p>
        <p>Bonus:✅</p>
        <p>-Secreto😈</p>
        <hr>
        <button class="buy">Comprar🛒</button>
    </div>
</div>
<!-- FIM DA: SEÇÃO DOS PLANOS CHINELAFLIX -->



<!-- INICIO DO RODAPE -->
<!-- <footer>
<div class="rodape">
    <h2>ChinelaFlix ツ</h2>
    <p>Contato: ChinelaFlix2K25@gmail.com</p>
    <p>© 2025 ChinelaFlix. Todos os direitos reservados.</p>
</div>
</footer> -->
<!-- FIM DO RODAPE -->

<!-- GPT -->



<footer>

    <div class="footer-main">
       <H2>ChinelaFlix ツ</H2>
       <div class="footer-infos">
        <h4>Mais informações</h4>
            <li><a href="#">Termos de Uso</a></li>
            <li><a href="#">Poitica de privacidade</a></li>
            <li><a href="#">Duvidas</a></li>
            <li><a href="#">Faça parte</a></li>
    </div> 

        <div class="contatos">
            <h4>Contato</h4>
            <p>Email: chinelaflix2000@gmail.com</p>
            <li><a href="#"> Discord: discord.com/Chinelaflix</a></li>
            <br>
            <div class="redes-sociais">
                <a href="#"><img src="img/instagram.png" alt=""></a>
                <a href="#"><img src="img/facebook blue.png" alt=""></a>
                <a href="#"><img src="img/disc2.png" alt=""></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <img src="img/formas-pagamento.png" alt="">
        <p>© 2025 ChinelaFlix. Todos os direitos reservados.</p>
    </div>
</footer>
<script src="script.js" defer></script>
</body>
</html>