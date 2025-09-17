<?php

require "conexaoMysql.php";

$sql = "SELECT Nome, Email, Funcao FROM Funcionario";

$listaFuncionarios = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

  <meta charset="UTF-8" />

  <title>Clínica Tupatro - Listar Funcionários</title>

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



  <main class="container my-4">

    <h2 class="conteudoTitulo">Funcionários Cadastrados</h2>

    <table class="table table-striped table-hover">

      <thead class="table-light">

        <tr>

          <th>Nome</th>

          <th>Email</th>

          <th>Função</th> </tr>

      </thead>

      <tbody>

        <?php

        foreach ($listaFuncionarios as $funcionario):

        ?>

        <tr>

          <td><?= htmlspecialchars($funcionario['Nome']) ?></td>

          <td><?= htmlspecialchars($funcionario['Email']) ?></td>

          <td><?= htmlspecialchars($funcionario['Funcao']) ?></td>

        </tr>

        <?php

        endforeach;

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