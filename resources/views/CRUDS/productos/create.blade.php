
@extends('layouts.admin')

@section('main')


    <div class="container col-md-10" x-data="validar()">
        <h2 class="bg-white" style="width: 50%;text-align:center">Agregar una nueva materia prima o insumo</h2>
        <div class="card" style="width: 50%">
            <form x-bind:action="action" method="POST">
                @csrf
                <div class="row ml-3">
                    <div class="col-md-6">
                        <label for="nombre">Nombre producto:</label><br>
                        <input x-model="nombre" type="text" name="nombre" x-on:input="validarform"><br>
                        <small x-show="errorNombre">Error: No ha colocado un nombre.</small><br>
                    </div>
                    <div class="col-md-6">
                        <label for="precio">Precio:</label><br>
                        <input x-model="precio" type="number" name="precio" x-on:input="validarform"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="unidad_producto">Tipo de unidad:</label><br>
                        <select class="form-control " name="unidad_producto" id="unidad_producto">
                                <option value="UND">UND</option>
                                <option value="KG">KG</option>
                                <option value="LTS">LTS</option>
              
                          </select>
                    </div>          
                    <br>
                    <div class="col-md-6 mt-2">
                        <button class="btn btn-success" type="submit" x-bind:disabled="formInvalid">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
    <script>
        function validar() {
            return {
                nombre: null,
                errorNombre: false,
                precio: null,
                errorPrecio: false,
                action: '{{ route('productos.store') }}',
                formInvalid: true,
                validarform(){
                    this.errorNombre = !this.nombre || this.nombre.trim() === '';
                    this.errorPrecio = !this.precio || this.precio.trim() === '';
                    this.validarFormulario();
                },
                validarnombre() {
                    this.errorNombre = !this.nombre || this.nombre.trim() === '';
                    this.validarFormulario();
                },
                validarFormulario() {
                    this.formInvalid = this.errorNombre || this.errorPrecio;
                },

                


            };
        }
    </script>
@endsection
