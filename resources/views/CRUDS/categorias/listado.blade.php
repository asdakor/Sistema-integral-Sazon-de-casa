@extends('layouts.admin')

@section('main')
    <div class="container col-md-10 mt-2">
        <h2 class="bg-white">Listado de categorias</h2>
        <table id="listado" class="table table-light table-bordered" >
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id_categoria }}</td>
                        <td>{{ $categoria->nombre_categoria }}</td>
                        <td>
                            <form method="GET" action="{{ route('categorias.edit', $categoria) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">EDITAR</button>
                            </form>
                        </td>
                        <td>


                            <form method="POST" action="{{ route('categorias.destroy', $categoria) }}">
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
