<?php
require "conexaoMysql.php";

$especialidade = $_GET['especialidade'] ?? '';

try {
    $sql = "SELECT Nome FROM Medico WHERE Especialidade = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especialidade]);
    $medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($medicos);
} catch (Exception $e) {
    echo json_encode([]);
}
