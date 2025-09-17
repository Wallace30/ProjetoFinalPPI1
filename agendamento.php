<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Clinica Tupatro - Agendamento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="d-flex justify-content-center align-items-center position-relative p-1">
    <h1 class="text-center">Clinica Tupatro</h1>
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

  <main>
    <h2 class="conteudoTitulo">Agendamento de Consulta</h2>
    <form id="formAgendamento" action="agendar.php" method="POST">

      <div class="mb-3">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
      </div>

      <div class="mb-3">
        <label for="sexo" class="form-label">Sexo</label>
        <select class="form-select" id="sexo" name="sexo" required>
          <option value="">Selecione</option>
          <option value="M">Masculino</option>
          <option value="F">Feminino</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="tel" class="form-control" id="telefone" name="telefone" required>
      </div>

      <div class="mb-3">
        <label for="especialidade" class="form-label">Especialidade</label>
        <select class="form-select" id="especialidade" name="especialidade" required>
          <option selected disabled value="">Carregando especialidades</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="medico" class="form-label">Medico</label>
        <select class="form-select" id="medico" name="medico" required>
          <option selected disabled value="">Selecione a especialidade</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="datahora" class="form-label">Data e Hora</label>
        <input type="datetime-local" class="form-control" id="datahora" name="datahora" required>
      </div>

      <button type="submit" class="btn btn-primary">Agendar</button>
    </form>
  </main>

  <footer>
    <address>Endereco da Clinica: Avenida Rondon Pacheco 123, sala: 123</address>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const esp = document.getElementById('especialidade');
      const med = document.getElementById('medico');

      try {
        const r = await fetch('buscar-especialidades.php');
        const especialidades = await r.json();
        esp.innerHTML = '<option value="">Selecione</option>';
        especialidades.forEach(e => {
          esp.innerHTML += `<option value="${e.Especialidade}">${e.Especialidade}</option>`;
        });

        esp.addEventListener('change', async () => {
          const r2 = await fetch('buscar-medicos.php?especialidade=' + encodeURIComponent(esp.value));
          const medicos = await r2.json();
          med.innerHTML = '<option value="">Selecione</option>';
          medicos.forEach(m => {
            med.innerHTML += `<option value="${m.Nome}">Dr(a). ${m.Nome}</option>`;
          });
        });
      } catch (e) {
        esp.innerHTML = '<option value="">Erro ao carregar</option>';
      }

      if (new URLSearchParams(window.location.search).get('sucesso') === '1') {
        alert('Agendamento realizado com sucesso!');
        history.replaceState({}, '', 'agendamento.php');
      }
    });
  </script>
</body>
</html>
