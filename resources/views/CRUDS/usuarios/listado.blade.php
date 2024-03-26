@extends('layouts.admin')

@section('main')
    <div class="container col-md-10 p-3">
        <table id="listado" class="table table-light table-bordered " style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th style="width:10%">ID</th>
                    <th style="width:20%">Nombre</th>
                    <th style="width:40%">Apellidos</th>
                    <th style="width: 5%">Rol</th>
                    <th style="width:1%"></th>
                    <th style="width:1%"></th>
                    <th style="width:1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->rut }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->apellidop }} {{ $usuario->apellidom }}</td>
                        <td>{{ $usuario->rol }}</td>
                        <td>
                            <form method="GET" action="{{ route('usuarios.show', $usuario) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">VER</button>
                            </form>
                        </td>
                        <td>
                            <form method="GET" action="{{ route('usuarios.edit', $usuario) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">EDITAR</button>
                            </form>
                        </td>
                        <td>


                            <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
