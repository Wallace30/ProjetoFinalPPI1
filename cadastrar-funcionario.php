<?php
require "conexaoMysql.php";

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$estadoCivil = $_POST['estadoCivil'] ?? '';
$dataNasc = $_POST['dataNascimento'] ?? '';
$funcao = $_POST['funcao'] ?? '';

if ($nome && $email && $senha) {
    try {
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Funcionario (Nome, Email, Senhahash, EstadoCivil, DataNascimento, Funcao) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $hash, $estadoCivil, $dataNasc, $funcao]);

        
        header("Location: listar-funcionarios.php?status=sucesso");
        exit();

    } catch (Exception $e) {
        
        if ($e->errorInfo[1] === 1062) {
            header("Location: cadastrar-funcionario.html?status=emailduplicado");
        } else {
            header("Location: cadastrar-funcionario.html?status=errodb");
        }
        exit();
    }
} else {
    
    header("Location: cadastrar-funcionario.html?status=campos");
    exit();
}
?>
