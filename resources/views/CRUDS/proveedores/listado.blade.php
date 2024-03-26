@extends('layouts.admin')

@section('main')

    <div class="container col-md-10">
        <table id="listado" class="table table-light table-bordered" style="">
            <thead class="thead-dark">
                <tr>
                    <th>Rut/rol</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->rut_proveedor }}</td>
                        <td>{{ $proveedor->nombre_proveedor}}</td>
                        <td>
                            <form method="POST" action="{{ route('proveedores.edit', $proveedor) }}">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn btn-success">EDITAR</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('proveedores.destroy', $proveedor) }}">
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