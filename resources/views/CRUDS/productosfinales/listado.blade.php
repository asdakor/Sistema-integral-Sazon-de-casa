@extends('layouts.admin')

@section('main')
    <div class="container col-md-10">
        <div class="" style="text-align: center; background:white">
            <h2 class="mt-2">LISTADO DE PRODUCTOS</h2>
        </div>

        <div class="">
            <table id="listado" class="table table-light table-bordered" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productosfinales as $producto)
                        <tr>
                            <td>{{ $producto->id_productofinal }}</td>
                            <td>{{ $producto->nombre_producto }}</td>
                            <td>{{ $producto->precio_producto }}</td>
                            <td>
                                @foreach ($categorias as $categoria)
                                    @if ($categoria->id_categoria == $producto->id_categoria)
                                        {{ $categoria->nombre_categoria }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <form method="GET" action="{{ route('productosfinales.edit', $producto) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">EDITAR</button>
                                </form>
                            </td>
                            <td>


                                <form method="POST" action="{{ route('productosfinales.destroy', $producto) }}">
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
