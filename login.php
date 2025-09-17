<?php
session_start();

require "conexaoMysql.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($email && $senha) {
    try {
        $sql = "SELECT Codigo, Nome, Senhahash FROM Funcionario WHERE Email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['Senhahash'])) {
            $_SESSION['user_id']   = $usuario['Codigo'];
            $_SESSION['user_name'] = $usuario['Nome'];
            header("Location: admin.html");
            exit();
        }

        $sql = "SELECT Codigo, Usuario, Senha FROM LoginInicial WHERE Usuario = ? AND Senha = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $senha]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $_SESSION['user_id']   = $usuario['Codigo'];
            $_SESSION['user_name'] = $usuario['Usuario'];
            header("Location: admin.html");
            exit();
        }

        header("Location: login.html?error=1");
        exit();

    } catch (Exception $e) {
        header("Location: login.html?error=2");
        exit();
    }
} else {
    header("Location: login.html?error=3");
    exit();
}
?>