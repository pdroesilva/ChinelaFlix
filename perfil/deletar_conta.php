<?php
session_start();
include ('../config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Executa a exclusão com segurança
$sql = "DELETE FROM userss WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    // Encerra a sessão do usuário
    session_destroy();
    // Redireciona para a home ou página de despedida
    header("Location: ../home/index.php");
    exit();
} else {
    echo "Erro ao excluir a conta: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
