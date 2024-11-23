<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

$user_id = $_SESSION['user_id'];

$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];
$confirmar_senha = $_POST['confirmar_senha'];

if ($nova_senha !== $confirmar_senha) {
    echo "A nova senha e a confirmação não coincidem.";
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT senha FROM usuarios WHERE id = ?");
    $stmt->execute([$user_id]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha_atual, $usuario['senha'])) {
    
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

        $update_stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $update_stmt->execute([$nova_senha_hash, $user_id]);

        header("Location: ../../views/perfil.php");
        exit();
    } else {
        echo "A senha atual está incorreta.";
    }
} catch (PDOException $e) {
    echo "Erro ao alterar a senha: " . $e->getMessage();
}
?>
