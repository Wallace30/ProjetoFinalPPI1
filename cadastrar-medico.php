<?php
require "conexaoMysql.php";

$nome = $_POST['nome'] ?? '';
$especialidade = $_POST['especialidade'] ?? '';
$crm = $_POST['crm'] ?? '';

if ($nome && $especialidade && $crm) {
    try {
        $sql = "INSERT INTO Medico (Nome, Especialidade, CRM) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $especialidade, $crm]);

        header("Location: listar-medicos.php?status=sucesso");
        exit();

    } catch (Exception $e) {
        if ($e->errorInfo[1] === 1062) {
            header("Location: cadastrar-medico.html?status=crmduplicado");
        } else {
            header("Location: cadastrar-medico.html?status=errodb");
        }
        exit();
    }
} else {
    header("Location: cadastrar-medico.html?status=campos");
    exit();
}
?>