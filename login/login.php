<?php 
session_start();
//Estabelece conexão com o banco de dados mysql
include ('../config.php');

$erro = ""; // Variável para armazenar mensagens de erro

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"]; 

    $sql = "SELECT * FROM userss WHERE email = ?"; //O ? dentro da string indica um parâmetro, que será substituído mais tarde usando bind_param().
    //Assim como $stmt, $sql poderia ter qualquer nome, como $query ou $comando_sql, mas o nome $sql é comum por representar instruções SQL.

    $stmt = $conn->prepare($sql); //Chama o método prepare() do objeto $conn.
    //Aqui, $stmt não é um nome especial, mas sim um objeto que representa a consulta SQL preparada.d
    //O operador "->" é utilizado para acessar métodos e propriedades de objetos em PHP.

    // Verificar se o prepare foi bem-sucedido
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email); //Chama o método bind_param() do objeto $stmt.
    $stmt->execute(); //Chama o método execute() do objeto $stmt. //EXECUTA CONSULTA SQL
    $result = $stmt->get_result(); //Chama o método get_result() do objeto $stmt.
    //get_result() retorna o resultado da consulta SQL executada.
    //Agora, $result contém um conjunto de resultados (tabela de dados) que pode ser percorrido usando fetch_assoc().

    //bind_param() é um método da classe mysqli_stmt (objeto statement). Ele substitui o parâmetro ? da consulta SQL por um valor real, de forma segura.


    if ($result->num_rows > 0) { 
        //num_rows é uma propriedade do objeto result. Ele indica quantas linhas foram retornadas pela consulta.

        // Captura os dados do usuário em um array associativo
        $usuario = $result->fetch_assoc(); //fetch_assoc() retorna uma linha da tabela como um array associativo.
        
        // Verificar a senha
        if (password_verify($senha, $usuario["senha"])) {
            // Iniciar a sessão com os dados corretos do usuário
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];
            
            // Redireciona para a home
            header("Location: /GitHub/chinelaflix/home/index.php");
            exit();
        } else {
            // Senha incorreta
            $erro = "Erro: Senha incorreta";
        }
    } else {
        // Usuário não encontrado
        $erro = "Erro: Usuario não encontrado";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="img/pfp site.png">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Login</title>
    <!--Voltando a estudar essa jossa-->
</head>
<body>

    <!-- Div principal que engloba geral -->
    <div class="login-container">
        <h1 class="logo"><a href="../home/index.php"><img src="img/home.png" alt="home" class="home"></a><span style="color: red;">ChinelaFlix ツ</span></h1>
        <p>Bem-vindo de volta!</p>


      <!-- Form pro login -->
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Seu email" required>
            
            <label for="senha">Senha<a href="#" class="esqueceu">Esqueceu sua senha?</a></label>
            <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
            <?php if (!empty($erro)): ?>
            <p style="color: red;"><?php echo $erro; ?></p>
            <?php endif; ?>
            <button type="submit" class="login">Entrar</button>
        </form>
        <!-- Fim do form pro login -->


         <!-- Se n tiver conta -->
        <p>Não tem uma conta ainda?<a href="cadastro.php" class="cadastro"><br>Cadastre-se Aqui!</a></p>
        <!-- fim se n tiver conta -->
    </div>
    <!-- Fim da div principal que engloba geral -->

</body>
</html>
