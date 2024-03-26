@extends('layouts.admin')

@section('main')
    <div class="container col-md-10">
        <div class="" style="text-align: center; background:white">
            <h2 class="mt-2">Ingresar control</h2>
        </div>

        <div class="bg-white " style="text-align: left">
            <div class="row mb-3 bordered" style="margin-left: 30%">
                <div class="col-4"> Seleccione fecha de control </div>
                <div class="col-6" x-data='selec_fecha()'>
                    <form action="{{ route('administracion.control') }}" x-on:change="submitForm"><input x-model='fecha'
                            type="date" name="fecha" id="fecha"></form>
                </div>
            </div>
            <div class="row mb-3 bordered" style="margin-left: 30%">
                <div class="col-4"> PRODUCTO </div>
                <div class="col-6"> CANTIDAD </div>
            </div>
            @foreach ($listado as $producto)
                <div x-data='ajustes({{ $producto->id_producto }})'>
                    <form id="control-{{ $producto->id_producto }}" action="{{ route('control.guardar', $producto->id_producto) }}">
                        <div class="row" style="margin-left: 30%">
                            <input hidden type="date" name="fecha" id="fecha" value="{{ $fecha }}">
                            <div class="col-4"> <label for="">{{ $producto->nombre_producto }} : </label></div>
                            <div class="col-6">
                                <input type="text" id="cantidad" name="cantidad" x-on:change='enviar' value='{{ $producto->cantidad_contada }}'>
                                {{ $producto->unidad_producto }}
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function selec_fecha() {
            return {
                fecha: '{{ $fecha }}',
                submitForm() {
                    // Agregar lógica adicional antes de enviar el formulario si es necesario
                    this.$el.submit(); // Envía el formulario
                }
            };
        }

        function ajustes(productoId) {
            return {
                

                // Lógica para establecer la cantidad predeterminada
          
                enviar() {
                    document.getElementById(`control-${productoId}`).submit();
                }
            };
        }
    </script>
@endsection
