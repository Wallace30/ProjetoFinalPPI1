<?php
require "conexaoMysql.php";

try {
    $sql = "SELECT Nome, Email, Telefone, Mensagem, Datahora FROM Contato ORDER BY Datahora DESC";
    $listaContatos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    exit('Ocorreu uma falha na consulta ao banco de dados: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Cl�nica Tupatro - Listar Contatos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="d-flex justify-content-center align-items-center position-relative p-1">
    <h1 class="text-center">Cl�nica Tupatro</h1>
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

  <main class="container my-4">
    <h2 class="conteudoTitulo">Mensagens de Contato Recebidas</h2>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead class="table-light">
          <tr>
            <th>Data/Hora</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Mensagem</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($listaContatos as $contato):
           
            
            $data = new DateTime($contato['Datahora']);
           
            $dataHoraFormatada = $data->format('d/m/Y H:i:s');
            
          ?>
          <tr>
            <td><?= $dataHoraFormatada ?></td>
            <td><?= htmlspecialchars($contato['Nome']) ?></td>
            <td><?= htmlspecialchars($contato['Email']) ?></td>
            <td><?= htmlspecialchars($contato['Telefone']) ?></td>
            <td><?= htmlspecialchars($contato['Mensagem']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <a href="admin.html" class="btn btn-primary mt-3">Voltar ao Painel</a>
  </main>
      <footer class="mt-5">
      <address>Endereco da Clinica: Avenida Rondon Pacheco 123, sala: 123</address>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
