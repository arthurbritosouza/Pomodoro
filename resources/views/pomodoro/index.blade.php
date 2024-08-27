<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Página Inicial</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #e9ecef;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .container {
    width: 90%;
    max-width: 1100px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }

  .card {
    border: none;
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
  }

  .card-header h6 {
    font-weight: bold;
    font-size: 1.5rem;
    color: #495057;
    margin-bottom: 20px;
  }

  .form-label {
    font-weight: 500;
    color: #495057;
  }

  .form-select, .form-control {
    box-shadow: none;
    border-radius: 8px;
    border: 1px solid #ced4da;
  }

  .btn {
    background-color: #007bff;
    color: #fff;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #0056b3;
  }

  .row {
    margin-bottom: 20px;
  }

  .list-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
  }

  .list-item a {
    text-decoration: none;
    color: #007bff;
    font-weight: 500;
  }

  .list-item a:hover {
    color: #0056b3;
  }

  .list-item i {
    font-size: 1.2rem;
    cursor: pointer;
  }

  .list-item i:hover {
    color: #dc3545;
  }

  .delete-icon {
    color: #dc3545;
  }
</style>
</head>
<body>
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h6>Pomodoro</h6>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </div>
    </div>
    <div class="card-body">
      <form method="POST" action="/timer_form">
        @csrf
        <div class="row">
          <div class="col-md-4">
            <label for="select1" class="form-label">Tempo Completo</label>
            <select name="tempo_completo" class="form-select" required>
              <option value="" selected disabled>Selecione</option> 
              <option value="1">10 minutos</option>
              <option value="2">20 minutos</option>
              <option value="3">30 minutos</option>
              <option value="4">40 minutos</option>
              <option value="5">50 minutos</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="select2" class="form-label">Descanso</label>
            <select name="descanso" class="form-select" required>
              <option value="" selected disabled>Selecione</option> 
              <option value="1">3 minutos</option>
              <option value="2">5 minutos</option>
              <option value="3">7 minutos</option>
              <option value="4">9 minutos</option>
              <option value="5">11 minutos</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="select3" class="form-label">Tempo de Foco</label>
            <select name="tempo_foco" class="form-select" required>
              <option value="" selected disabled>Selecione</option>
              <option value="1">10 minutos</option>
              <option value="2">20 minutos</option>
              <option value="3">30 minutos</option>
              <option value="4">40 minutos</option>
              <option value="5">50 minutos</option>
            </select>
          </div>
        </div>
        <input name="name" placeholder="Nome" type="text" class="form-control mt-3" required>
        <button type="submit" class="btn mt-4">Enviar</button>
      </form>

      @foreach($pomo as $pomodoro)
        @php
          $tempos = [
            1 => '10 minutos',
            2 => '20 minutos',
            3 => '30 minutos',
            4 => '40 minutos',
            5 => '50 minutos',
          ];
          $tempoCompleto = $tempos[$pomodoro->temp_completo] ?? $pomodoro->temp_completo . ' minutos';
        @endphp

        <div class="row mt-4">
          <div class="col-12">
            <div class="list-item">
              <div>
                <a href="/timer/{{ $pomodoro->id }}">{{ $pomodoro->nome }}</a>
                <p class="mb-0">Tempo completo: {{ $tempoCompleto }}</p>
              </div>
              <a href="/apagar_pomo/{{ $pomodoro->id }}" class="delete-icon">
                <i class="fas fa-trash-alt"></i>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

</body>
</html>
