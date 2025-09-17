<?php
require "conexaoMysql.php";

try {
    $sql = "SELECT DISTINCT Especialidade FROM Medico ORDER BY Especialidade";
    $stmt = $pdo->query($sql);
    $especialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($especialidades);
} catch (Exception $e) {
    echo json_encode([]);
}
