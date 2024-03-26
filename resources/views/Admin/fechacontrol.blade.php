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
                    <form action="{{ route('administracion.control') }}" x-on:change="submitForm"><input x-model='fecha' type="date" name="fecha" id="fecha"></form>
                </div>
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
