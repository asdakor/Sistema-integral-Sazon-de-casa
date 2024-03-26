@extends('layouts.admin')

@section('main')
    <div class="container col-md-10">
        <div class="" style="text-align: center; background:white">
            <h2 class="mt-2">Revisar control de existencias</h2>
        </div>

        <div class="bg-white " style="text-align: left">
            <div class="row mb-3 bordered" style="margin-left: 30%">
                <div class="col-4"> Seleccione fecha de control </div>
                <div class="col-6" x-data='selec_fecha()'>
                    <form action="{{ route('listado.revisar') }}" x-on:change="submitForm"><input type="date"
                            name="fecha" id="fecha" value="{{ $fecha }}"></form>
                </div>
            </div>
            <div class="">
                <table id="listado" class="table table-light table-bordered " style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width:14%">PRODUCTO</th>
                            <th style="width:14%">CANTIDAD IDEAL</th>
                            <th style="width:14%">CANTIDAD REAL</th>
                            <th style="width:14%">DIFERENCIA</th>
                            <th style="width:14%">DESVIACION</th>
                            <th style="width:14%">COSTE IDEAL</th>
                            <th style="width:14%">COSTE REAL</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($productos as $producto)
                            @foreach ($control as $item)
                                @if ($producto->id_producto == $item->id_producto)
                                    <tr>
                                        <td>{{ $producto->nombre_producto }} {{ $producto->unidad_producto }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td>{{ $item->cantidad_contada }}</td>
                                        <td>{{ -($producto->stock - $item->cantidad_contada) }}</td>
                                        <td>{{ ($producto->stock/100)*$item->cantidad_contada }}%</td>
                                        <td>{{ ($producto->stock)*$producto->precio_producto }}</td>
                                        <td>{{ ($item->cantidad_contada)*$producto->precio_producto }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach

                        <tr>
                            <th style="width:14%">TOTALES</th>
                            <th style="width:14%">XX</th>
                            <th style="width:14%">XX</th>
                            <th style="width:14%">XX</th>
                            <th style="width:14%">XX</th>
                            <th style="width:14%">XX</th>
                            <th style="width:14%">XX</th>
                        </tr>
                    </thead>


                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <script>
        function selec_fecha() {
            return {
                fecha: '',
                submitForm() {
                    // Aquí puedes agregar lógica adicional antes de enviar el formulario si es necesario
                    this.$el.submit(); // Envía el formulario
                }
            };
        }

        function ajustes() {
            return {
                enviar() {
                    document.getElementById('formstock').submit();
                }


            };
        }
    </script>
@endsection
