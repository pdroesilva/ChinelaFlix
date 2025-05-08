<?php 
include ('../config.php');

$erro = ""; // Variável para armazenar mensagens de erro

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"]; 
    $confirm_senha = $_POST["confirm_senha"];

    if ($senha !== $confirm_senha) {
        $erro = "Erro: As senhas não coincidem.";
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $imagem_padrao = "../perfil/uploads/default.jpg"; // Caminho da imagem padrão

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Verificar se o e-mail já existe no banco
        $sql_verifica_email = "SELECT * FROM userss WHERE email = ?";
        $stmt_verifica = $conn->prepare($sql_verifica_email);
        
        if (!$stmt_verifica) {
            die("Erro ao preparar a query: " . $conn->error);
        }

        $stmt_verifica->bind_param("s", $email);
        $stmt_verifica->execute();
        $stmt_verifica->store_result();

        // Se o e-mail já existe, define a mensagem de erro
        if ($stmt_verifica->num_rows > 0) {
            $erro = "Erro: E-mail já existente.";
        } else {
            // Se o e-mail não existe, inserir o novo usuário
            $sql = "INSERT INTO userss (nome, email, senha, imagem_perfil) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Erro ao preparar a query: " . $conn->error);
            }

            $stmt->bind_param("ssss", $nome, $email, $senha_hash, $imagem_padrao);

            if ($stmt->execute()) {
                header("Location: login.php"); 
                exit();
            } else {
                echo "Erro ao executar a query: " . $stmt->error;
            }

            $stmt->close();
        }

        $stmt_verifica->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="img/pfp site.png">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Cadastro</title>
    <!--Voltando a estudar essa jossa-->
</head>
<body>
    <!-- Div principal que engloba geral -->
    <div class="login-container">
        <h1 class="logo"><a href="../home/index.php"><img src="img/home.png" alt="home" class="home"></a><span style="color: red;">ChinelaFlix ツ</span></h1>
        <p>Seja bem-vindo ao ChinelaFlix!</p>


      <!-- Form pro Cadastro -->
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Seu nome" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Seu email" required>
            
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Sua senha" required>

            <label for="confirm_senha">Confirme sua senha</label>
            <input type="password" name="confirm_senha" id="confirm_senha" placeholder="Confirme sua senha" required>
            <?php if (!empty($erro)): ?>
            <p style="color: red;"><?php echo $erro; ?></p>
            <?php endif; ?>
            
            <button type="submit" class="login">Criar</button>
        </form>
        <!-- Fim do form pro login -->


         <!-- Se n tiver conta -->
        <p>Ja possui uma conta?<a href="login.php" class="cadastro"><br>Faça login Aqui!</a></p>
        <!-- fim se n tiver conta -->
    </div>
    <!-- Fim da div principal que engloba geral -->
  
</body>
</html>