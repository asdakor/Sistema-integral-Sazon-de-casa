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
                        <th>Unidad</th>
                        <th>Stock Critico</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id_producto }}</td>
                            <td>{{ $producto->nombre_producto }}</td>
                            <td>{{ $producto->unidad_producto }}</td>

                            <td>
                                <div x-data="ajustes()">
                                    <form id="formstock" action="{{ route('ajustes.guardar', $producto->id_producto) }}">
                                        <input value="{{ $producto->stock_critico }}" type="text" name="stockcritico"
                                            id="stockcritico">
                                    </form>
                            </td>
        </div>


        </tr>
        @endforeach
        </tbody>

        </table>
    </div>
    </div>


    <script>
        function ajustes() {
            return {
                enviar() {
                    document.getElementById('formstock').submit();
                }


            };
        }
    </script>
@endsection
