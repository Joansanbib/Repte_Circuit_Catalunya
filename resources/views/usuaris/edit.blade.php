<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edició d'un usuari</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    /* Estilos personalizados */
    .custom-form {
      max-width: 400px; 
      margin: auto; 
      padding: 20px; 
    }
  </style>
</head>
<body>
<div style="text-align: center;">
  <div class="card" style="width: 400px; margin: 0 auto; margin-top: 20px">
  <div class="card-header">
      <h5 class="card-title">Edició d'un usuari</h5>
  </div>
  <div class="card-body">
  <form class="custom-form" method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
    <div class="mb-3">
      <label for="NIF" class="form-label">NIF</label>
      <input type="text" name="NIF" value="{{$user->NIF}}" class="form-control" id="NIF" required>
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Nom</label>
      <input type="text" name="name" value="{{$user->name}}" class="form-control" id="name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" name="email" value="{{$user->email}}" class="form-control" id="email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contrasenya</label>
      <input type="text" name="password" class="form-control" id="password">
    </div>
    <div class="mb-3">
  <label for="Rol" class="form-label">Rol de l'usuari</label>
  <select id="Rol" name="Rol" class="form-select" required>
    <option value="Administrador" @if($user->Rol == 'Administrador') selected @endif>Administrador</option>
    <option value="Operari" @if($user->Rol == 'Operari') selected @endif>Operari</option>
  </select>
</div>

    <button type="submit" class="btn btn-primary">ENVIAR</button>
  </form>
  </div>
</div>
</div>

  <!-- Bootstrap JS y dependencias -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
