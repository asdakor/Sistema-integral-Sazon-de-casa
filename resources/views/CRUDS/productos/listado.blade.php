@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" >
        <div class="" style="text-align: center; background:white">
            <h2 class="mt-2">LISTADO DE PRODUCTOS</h2>
        </div>

        <div class="">
            <table id="listado" class="table table-light table-bordered" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Unidad</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id_producto }}</td>
                            <td>{{ $producto->nombre_producto }}</td>
                            <td>{{ $producto->unidad_producto }}</td>
                            <td>{{ $producto->precio_producto }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>
                                <form method="GET" action="{{ route('productos.edit', $producto) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">EDITAR</button>
                                </form>
                            </td>
                            <td>


                                <form method="POST" action="{{ route('productos.destroy', $producto) }}">
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
    </div>
@endsection
