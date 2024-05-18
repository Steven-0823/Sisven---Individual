<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit Categoria</title>
  </head>
  <body>
    <x-app-layout>
    <div class="container">
    <h1>Edit Categoria</h1>
    <form method="POST" action="{{ route('categorias.update', ['categoria' => $categoria->id]) }}">
      @method('put')  
      @csrf
        <div class="mb-3">
          <label for="id" class="form-label">Id</label>
          <input type="text" class="form-control" id="id" aria-describedby="idHelp" name="id" 
          disabled="disabled" value="{{ $categoria->id }}">
          <div id="idHelp" class="form-text"> Id Categoria</div>
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Nombre</label>
          <input type="text" required class="form-control" id="name" placeholder="Nombre Categoria" 
          name="name" value="{{ $categoria->name }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripcion</label>
            <input type="text" required class="form-control" id="description" placeholder="Descripcion Categoria" 
            name="description" value="{{ $categoria->description}}">
          </div>
       
        <div class="mt-3">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-warning">Cancel</a>
        </div>
      </form>
    </div>

  </x-app-layout>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>