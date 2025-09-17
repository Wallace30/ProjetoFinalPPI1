<?php
require "conexaoMysql.php";

$nome = $_POST['nome'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$medicoNome = $_POST['medico'] ?? '';
$datahora = $_POST['datahora'] ?? '';

try {
    $sqlMed = "SELECT Codigo FROM Medico WHERE Nome = ?";
    $stmt = $pdo->prepare($sqlMed);
    $stmt->execute([$medicoNome]);
    $med = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$med) throw new Exception("Medico nao encontrado.");

    $sqlPac = "INSERT INTO Paciente (Nome, Sexo, Email, Telefone) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sqlPac);
    $stmt->execute([$nome, $sexo, $email, $telefone]);
    $pacienteId = $pdo->lastInsertId();

    $sqlAg = "INSERT INTO Agendamento (Datahora, CodigoMedico, CodigoPaciente) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sqlAg);
    $stmt->execute([$datahora, $med['Codigo'], $pacienteId]);

    header("Location: agendamento.php?sucesso=1");
    exit;
} catch (Exception $e) {
    exit("Falha ao agendar: " . $e->getMessage());
}
