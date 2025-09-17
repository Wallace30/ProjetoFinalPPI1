<?php
require "conexaoMysql.php";

try {
  $sql = <<<SQL
    SELECT 
      p.Nome AS NomePaciente,
      p.Sexo,
      p.Email,
      p.Telefone,
      m.Nome AS NomeMedico,
      m.Especialidade,
      a.Datahora
    FROM Agendamento a
    INNER JOIN Paciente p ON a.CodigoPaciente = p.Codigo
    INNER JOIN Medico m ON a.CodigoMedico = m.Codigo
    ORDER BY a.Datahora;
  SQL;

  $stmt = $pdo->query($sql);

} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Clínica Tupatro - Listar Agendamentos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <header class="d-flex justify-content-center align-items-center position-relative p-1">
    <h1 class="text-center">Clínica Tupatro</h1>
  </header>

  <nav>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="galeria.html">Galeria</a></li>
      <li><a href="login.html">Login</a></li>
      <li><a href="contato.html">Contato</a></li>
      <li><a href="agendamento.php">Agendamento</a></li>
    </ul>
  </nav>

  <main class="container mt-3">
    <h2 class="conteudoTitulo">Listar Agendamentos</h2>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Paciente</th>
          <th>Sexo</th>
          <th>Email</th>
          <th>Telefone</th>
          <th>Médico</th>
          <th>Especialidade</th>
          <th>Data</th>
          <th>Horário</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = $stmt->fetch()) {
          $dataHora = new DateTime($row['Datahora']);
          $data = $dataHora->format('d/m/Y');
          $hora = $dataHora->format('H:i');

          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['NomePaciente']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Sexo']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Telefone']) . "</td>";
          echo "<td>Dr(a). " . htmlspecialchars($row['NomeMedico']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Especialidade']) . "</td>";
          echo "<td>" . $data . "</td>";
          echo "<td>" . $hora . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    <a href="admin.html" class="btn btn-primary mt-3">Voltar ao Painel</a>
  </main>

  <footer>
    <address>Endereço da Clínica: Avenida Rondon Pacheco 123, sala: 123</address>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
