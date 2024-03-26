@extends('layouts.admin')

@section('main')
    <div class="container col-md-10 p-3">
        <table id="listado" class="table table-light table-bordered " style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th style="width:10%">ID</th>
                    <th style="width:20%">Nombre</th>
                    <th style="width:40%">Descripcion</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $rol)
                    <tr>
                        <td>{{ $rol->id_rol }}</td>
                        <td>{{ $rol->nombre_rol }}</td>
                        <td>{{ $rol->detalle_rol }}</td>
                        <td>
                            <form method="GET" action="{{ route('roles.show', $rol) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">VER</button>
                            </form>
                        </td>
                        <td>
                            <form method="GET" action="{{ route('roles.edit', $rol) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">EDITAR</button>
                            </form>
                        </td>
                        <td>


                            <form method="POST" action="{{ route('roles.destroy', $rol) }}">
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
