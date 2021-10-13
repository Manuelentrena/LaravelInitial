<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600"
    rel="stylesheet">
  <!-- Styles -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 mx-auto">

        <div class="card border-0 shadow">
          <form action="{{ route('users.store') }}" method="POST">
            <p class="col-sm-3 m-1">Introduce un usuario:</p>
            <div class="form-row d-flex">
              {{-- name --}}
              <div class="col-sm-3 m-1">
                <input type="text" name="name" class="form-control "
                  placeholder="Nombre" value="{{ old('name') }}" />
              </div>
              {{-- email --}}
              <div class="col-sm-4 m-1">
                <input type="email" name="email" class="form-control"
                  placeholder="Email" value="{{ old('email') }}" />
              </div>
              {{-- password --}}
              <div class="col-sm-3 m-1">
                <input type="password" name="password" class="form-control"
                  placeholder="Contraseña" value="{{ old('password') }}" />
              </div>
              {{-- button --}}
              <div class="col-auto m-1">
                @csrf
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </form>
          @if ($errors->any())
            <div class="alert alert-danger m-1">
              @foreach ($errors->all() as $error)
                - {{ $error }} <br>
              @endforeach
            </div>
          @endif
          @if (session()->has('success'))
            <div class="alert alert-success m-0">
              <span>{{ session('success') }}</span>
            </div>
          @endif
        </div>

        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <form action="{{ route('users.destroy', $user->id) }}"
                    method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Eliminar"
                      class="btn btn-sm btn-danger"
                      onclick="return confirm('¿Desea eliminar al usuario {{ $user->name }}?')">
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>
