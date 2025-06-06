<?php

session_start();
include('../config.php');

$erro = ""; // Variável para armazenar mensagens de erro

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Obter os dados do usuário logado
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['email']) && !empty(trim($_POST['name'])) && !empty(trim($_POST['email']))) {
        $nome = trim($_POST['name']);
        $email = trim($_POST['email']);
        $senha = $_POST['password'];

        // Regex mais restrita: antes do @ só letras, números, ponto, traço e underline
        $regexEmail = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        if (!preg_match($regexEmail, $email)) {
            $erro = "Erro: O e-mail informado possui caracteres inválidos.";
        } else {
            // Verifica se o e-mail já existe no banco (exceto o do usuário atual)
            $sql_verifica_email = "SELECT * FROM userss WHERE email = ? AND id != ?";
            $stmt_verifica = $conn->prepare($sql_verifica_email);
            $stmt_verifica->bind_param("si", $email, $user_id);
            $stmt_verifica->execute();
            $stmt_verifica->store_result();

            if ($stmt_verifica->num_rows > 0) {
                $erro = "Erro: E-mail já existente.";
            } else {
                // Atualiza os dados
                if (!empty($senha)) {
                    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                    $sql = "UPDATE userss SET nome = ?, email = ?, senha = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssi", $nome, $email, $senha_hash, $user_id);
                } else {
                    $sql = "UPDATE userss SET nome = ?, email = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssi", $nome, $email, $user_id);
                }

                if ($stmt->execute()) {
                    $erro = "Dados atualizados com sucesso!";
                } else {
                    $erro = "Erro ao atualizar os dados.";
                }
                $stmt->close();

                // --- Tratamento da imagem ---
                if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] === UPLOAD_ERR_OK) {
                    $arquivoTmp = $_FILES['profile-pic']['tmp_name'];
                    $nomeOriginal = $_FILES['profile-pic']['name'];
                    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
                    $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                    if (in_array($extensao, $permitidas)) {
                        $novoNome = uniqid('img_', true) . '.' . $extensao;
                        $caminho = 'uploads/' . $novoNome;

                        if (!is_dir('uploads')) {
                            mkdir('uploads', 0755, true);
                        }

                        if (move_uploaded_file($arquivoTmp, $caminho)) {
                            $sqlImg = "UPDATE userss SET imagem_perfil = ? WHERE id = ?";
                            $stmtImg = $conn->prepare($sqlImg);
                            $stmtImg->bind_param("si", $caminho, $user_id);
                            $stmtImg->execute();
                            $stmtImg->close();
                        } else {
                            $erro = " Não foi possível salvar a imagem.";
                        }
                    } else {
                        $erro = " Formato de imagem inválido.";
                    }
                }
                // --- Fim do tratamento da imagem ---
            }

            $stmt_verifica->close();
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}

// Obter os dados do usuário atualizado
$sql = "SELECT * FROM userss WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userss = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edição de Perfil</title>
    <link rel="icon" href="img/pfp site.png">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="usuario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="profile-container">
        <a href="../home/index.php"><img src="img/home.png" alt="home" class="home"></a>
        <h2>Editar Perfil</h2>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <div class="avatar-container">
                <img src="<?= $userss['imagem_perfil'] ?>" alt="Foto de Perfil" id="avatar-preview">
                <label for="profile-pic" class="edit-icon">
                    <input type="file" id="upload-img" style="display: none;">
                    <i class="fa fa-pencil"></i>
                </label>
                <input type="file" id="profile-pic" name="profile-pic" accept="image/*" hidden />
            </div>

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userss['nome']); ?>" require>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userss['email']); ?>" require>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Sua Senha">
            </div>

            <?php if (!empty($erro)): ?>
                <p style="color: red; text-align:center"><?php echo $erro; ?></p>
            <?php endif; ?>

            <div class="button-group">
                <button type="button" class="button-update" id="openUpdateModal">Atualizar</button>
                <button type="button" class="button-delete" id="openDeleteModal">Deletar Conta</button>
            </div>
        </form>
    </div>
    <!-- Modal Atualizar -->
    <div class="modal" id="modalUpdate">
        <div class="modal-content">
            <p>Tem certeza que deseja atualizar os dados do perfil?</p>
            <div class="modal-buttons">
                <button id="confirmUpdate" class="button-update">Confirmar</button>
                <button class="modal-close">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Modal Deletar -->
    <div class="modal" id="modalDelete">
        <div class="modal-content">
            <p>Tem certeza que deseja DELETAR sua conta? Essa ação é irreversível.</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="button-delete">Confirmar</button>
                <button class="modal-close">Cancelar</button>
            </div>
        </div>
    </div>
    <script src="usuario.js"></script>
    <form id="deleteForm" action="deletar_conta.php" method="post" style="display: none;"></form>
</body>

</html>