@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data="validar()">
        <h2 class="bg-white" style="width: 50%">Crear nuevo rol</h2>
        <div class="card"  style="width:50%">

            <form x-bind:action="action" method="POST">
                @csrf
                <label for="nombre">Nombre:</label><br>
                <input x-model="nombre" type="text" name="nombre" x-on:input="validarnombre"><br>
                <small x-show="errorNombre">Error: No ha colocado un nombre.</small><br>
                <label for="descripcion">Descripcion:</label><br>
                <input x-model="descripcion" type="text" name="descripcion"><br>
                <br>
               
                <button class="btn btn-success" type="submit" x-bind:disabled="formInvalid">Continuar</button>
            </form>
        </div>
    </div>


    <script>
        function validar() {
            return {
                nombre: null,

                errorNombre: false,

                action: '{{ route('roles.store') }}',
                formInvalid: true, // Inicialmente deshabilitar el botón de envío

                validarnombre() {
                    this.errorNombre = !this.nombre;
                    this.validarFormulario();           
                },
                validarFormulario() {
                    this.formInvalid = this.errorNombre;
                },

                
        }
    }
    </script>
@endsection
