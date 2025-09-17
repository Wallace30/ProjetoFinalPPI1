<?php
require "conexaoMysql.php";

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

if ($nome && $email && $telefone && $mensagem) {
    try {
        $sql = <<<SQL
          INSERT INTO Contato (Nome, Email, Telefone, Mensagem)
          VALUES (?, ?, ?, ?)
        SQL;
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $telefone, $mensagem]);
        
        header("Location: contato.html?status=sucesso");
        exit();

    } catch (Exception $e) {
        header("Location: contato.html?status=errodb");
        exit();
    }
} else {
    header("Location: contato.html?status=campos");
    exit();
}
?>