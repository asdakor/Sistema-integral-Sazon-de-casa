@extends('layouts.admin')

@section('main')
    <div class="container col-md-10"> 
        <h2 class="bg-white mt-1" style="text-align: center">Editar Proveedor 
        <a href="/proveedores/listado" class="btn btn-warning mb-1">Volver</a></h2>
    <div class="card " style="" x-data="validar()">
        
        <form x-bind:action="action" method="POST">
            @csrf
            <label for="nombre">Nombre:</label><br>
            <input x-model="nombre" type="text" name="nombre" x-on:input="validarnombre"><br>
            <small x-show="errorNombre">Error: No ha colocado un nombre.</small><br>

            <label for="RUT">RUT (9 caracteres):</label><br>
            <input x-model="rut" type="text" name="rut" x-on:input="validarrut"><br>
            <small x-show="errorRut">Error: El RUT debe tener 9 caracteres.</small><br>

            <button class="btn btn-success" type="submit" x-bind:disabled="formInvalid">Continuar</button>
        </form>
    </div>
</div>

    <script>
        function validar() {
            return {
                nombre: '{{ $proveedor->nombre_proveedor }}',
                rut: '{{ $proveedor->rut_proveedor }}',
                errorNombre: false,
                errorRut: false,
                formatorut: null,
                action: '{{ route('proveedores.update', $proveedor->rut_proveedor) }}',
                formInvalid: true, // Inicialmente deshabilitar el botón de envío

                validarnombre() {
                    this.errorNombre = !this.nombre;
                    this.errorRut = !this.rut || this.rut.length !== 9;

                    this.formInvalid = this.errorNombre || this.errorRut;

                    if (!this.formInvalid) {
                        console.log("Nombre:", this.nombre, "RUT:", this.rut);
                    }
                },
                validarFormulario() {
                    this.formInvalid = this.errorNombre || this.errorRut;
                },

                formatoRut() {
                    return this.rut.slice(0, 2) + '.' + this.rut.slice(2, 5) + '.' + this.rut.slice(5, 8)
                },

                calcularDigitoVerificador() {
                    let rutDigits = this.rut.slice(0, 8).split('').reverse().map(Number);
                    let factor = 2;
                    let suma = 0;

                    for (let i = 0; i < rutDigits.length; i++) {
                        if (factor > 7) {
                            factor = 2;
                        }

                        suma += rutDigits[i] * factor;
                        factor++;
                    }

                    let verificador = 11 - (suma % 11);

                    return verificador === 11 ? '0' : verificador === 10 ? 'K' : String(verificador);
                },

                validarrut() {
                    this.errorRut = !this.rut || this.rut.length !== 9;
                    this.validarFormulario();

                    if (!this.formInvalid) {
                        const digitoVerificadorCalculado = this.calcularDigitoVerificador();
                        this.formatorut = this.formatoRut() + '-' + digitoVerificadorCalculado;
                        if (digitoVerificadorCalculado !== this.rut.slice(8,9 )) {
                            alert("Error: El RUT ingresado no es valido.");
                            this.formInvalid = !this.formInvalid;
                            return;
                        }
                        console.log("Nombre:", this.nombre, "RUT:", this.rut, "formato:", this.formatorut);
                    }
                },


            };
        }
    </script>
@endsection
