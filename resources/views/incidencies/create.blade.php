<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creació Incidència</title>
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
      <h5 class="card-title">Creació d'una incidència</h5>
    </div>
    <div class="card-body">
      <form class="custom-form" method="post" action="/incidences" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="Nom" class="form-label">Nom</label>
          <input type="text" name="Nom" placeholder="Nom de l'incidència" class="form-control" id="Nom" required>
        </div>
        <div class="mb-3">
          <label for="Descripcio" class="form-label">Descripcio</label>
          <input type="text" name="Descripcio" placeholder="Descripció de l'incidència" class="form-control" id="Descripcio" required>
        </div>
        <div class="mb-3">
          <label for="Estat" class="form-label">Estat de l'incidència</label>
          <select id="Estat" name="Estat" class="form-select" required>
            <option value="Solucionada">Solucionada</option>
            <option value="Borrador">Borrador</option>
            <option value="Informativa">Informativa</option>
            <option value="Inactiva">Inactiva</option>
            <option value="Requereix">Requereix</option>
            <option value="En manteniment">En manteniment</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="Prioritat" class="form-label">Prioritat de l'incidència</label>
          <select id="Prioritat" name="Prioritat" class="form-select" required>
            <option value="Poca">Poca</option>
            <option value="Informativa">Informativa</option>
            <option value="Normal">Normal</option>
            <option value="Mínima">Mínima</option>
            <option value="Màxima">Màxima</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="Zona" class="form-label">Zona de l'incidència</label>
          <select id="Zona" name="Zona" class="form-select" required>
            @foreach($zones as $zona)
              <option value="{{$zona->id}}">{{$zona->Nom}}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="Imatge" class="form-label">Imatge de l'incidència</label>
          <input type="file" name="Imatge" class="form-control" id="Imatge" accept="image/*" required>
        </div>
        <div class="mb-3">
          <label for="Rol_assignat" class="form-label">Rol Assignat</label>
          <select id="Rol_assignat" name="Rol_assignat" class="form-select" required>
            <option value="Operari">Operari</option>
            <option value="Administrador">Administrador</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">ENVIAR</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS y dependencias -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
