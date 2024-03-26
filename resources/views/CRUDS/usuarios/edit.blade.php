@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data="validar()">
        <div d-inline-flex>
            <h2 class="bg-white " style="width: 50%;text-align:center">Editar Usuario
            
            <a href="/usuarios/listado" class="btn btn-danger mb-1" role="button">Volver</a></h2>
        </div>
        <div class="card" style="width: 50%">
            <form x-bind:action="action" method="POST">
                @csrf
                <div class="row ml-3">
                    <div class="col-md-6">
                        <label for="RUT">RUT (sin puntos ni guion):</label><br>
                        <input x-model="rut" type="text" name="rut" x-on:input="validarrut"
                            placeholder="123456789"><br>
                        <small x-show="errorRut">Error: El RUT debe tener 9 caracteres o es inválido.</small><br>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">Nombre:</label><br>
                        <input x-model="nombre" type="text" name="nombre" x-on:input="validarnombre"><br>
                        <small x-show="errorNombre">Error: No ha colocado un nombre.</small><br>
                    </div>
                    <div class="col-md-6">
                        <label for="apellidop">Apellido Paterno:</label><br>
                        <input x-model="apellidop" type="text" name="apellidop" x-on:input="validarApellidop"><br>
                        <small x-show="errorApellidop">Error: No ha colocado un apellido.</small><br>
                    </div>
                    <div class="col-md-6">
                        <label for="apellidom">Apellido Materno:</label><br>
                        <input x-model="apellidom" type="text" name="apellidom" x-on:input="validarApellidom"><br>
                        <small x-show="errorApellidom">Error: No ha colocado un apellido.</small><br>
                    </div>
                    <div class="col-md-6">
                        <label for="fechanacimiento">Fecha de nacimiento:</label><br>
                        <input x-model="fechanacimiento" type="date" name="fechanacimiento"
                            x-on:input="validarFechanacimiento"><br>
                        <small x-show="errorFechanacimiento">Error: Fecha de nacimiento invalida.</small><br>
                    </div>
                    <div class="col-md-6">
                        <label for="fechaingreso">Fecha de ingreso:</label><br>
                        <input x-model="fechaingreso" type="date" name="fechaingreso"
                            x-on:input="validarFechaingreso"><br>
                        <small x-show="errorFechaingreso">Error: Fecha de ingreso invalida.</small><br>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Correo electronico:</label><br>
                        <input x-model="email" type="email" name="email" x-on:input="validarEmail"><br>
                        <small x-show="errorEmail">Error: Correo invalido.</small><br>
                    </div>
                    <div class="col-md-6">
                        <label for="contraseña">Contraseña:</label><br>
                        <input x-model="contraseña" type="password" name="contraseña" x-on:input="validarContraseña"><br>
                        <small x-show="errorContraseña">Error: La contraseña debe tener almenos 8 caracteres.</small><br>
                    </div>

                    <br>
                    <div class="col-md-6">
                        <button type="submit" x-bind:disabled="formInvalid">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
    <script>
        function validar() {
            return {
                nombre: '{{ $usuario->nombre }}',
                rut: '{{ $usuario->rut }}',
                apellidop: '{{ $usuario->apellidop }}',
                apellidom: '{{ $usuario->apellidom }}',
                fechanacimiento: '{{ $usuario->fecha_nacimiento }}',
                fechaingreso: '{{ $usuario->fecha_ingreso }}',
                contraseña: '{{ $usuario->password }}',
                email: '{{ $usuario->email }}',
                errorNombre: false,
                errorRut: false,
                errorApellidop: false,
                errorApellidom: false,
                errorFechanacimiento: false,
                errorFechaingreso: false,
                errorContraseña: false,
                errorEmail: false,
                formatorut: null,
                action: '{{ route('usuarios.update', $usuario->rut) }}',
                formInvalid: true,

                validarnombre() {
                    this.errorNombre = !this.nombre || this.nombre.trim() === '';
                    this.validarFormulario();
                },
                validarFormulario() {
                    this.formInvalid = this.errorNombre || this.errorRut || this.errorApellidop || this.errorApellidom ||
                        this.errorFechanacimiento || this.errorFechaingreso || this.errorEmail || this.errorContraseña;
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

                    return verificador === 11 ? '0' : verificador
                    r === 10 ? 'K' : String(verificador);
                },
                validarApellidop() {
                    this.errorApellidop = !this.apellidop || this.apellidop.trim() === '';
                    this.validarFormulario();
                },

                validarApellidom() {
                    this.errorApellidom = !this.apellidom || this.apellidom.trim() === '';
                    this.validarFormulario();
                },

                validarFechanacimiento() {
                    this.fechanacimiento = this.fechanacimiento ? this.fechanacimiento.trim() :
                    ''; // Asigna un valor vacío si es null
                    const fechaNacimiento = new Date(this.fechanacimiento);
                    const edadMinima = 18;
                    const fechaHace18Anios = new Date();
                    fechaHace18Anios.setFullYear(fechaHace18Anios.getFullYear() - edadMinima);
                    this.errorFechanacimiento = !this.fechanacimiento || isNaN(fechaNacimiento) || fechaNacimiento >
                        fechaHace18Anios;
                    this.validarFormulario();
                },
                validarFechaingreso() {
                    this.fechaingreso = this.fechaingreso ? this.fechaingreso.trim() :
                    ''; // Asigna un valor vacío si es null
                    const fechaIngreso = new Date(this.fechaingreso);
                    const fechaActual = new Date();
                    this.errorFechaingreso = !this.fechaingreso || isNaN(fechaIngreso) || fechaIngreso > fechaActual;
                    this.validarFormulario();
                },
                validarEmail() {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    this.errorEmail = !emailRegex.test(this.email);
                    this.validarFormulario();
                },
                validarContraseña() {
                    this.errorContraseña = !this.contraseña || this.contraseña.length < 8;
                    this.validarFormulario();
                },
                validarrut() {
                    this.errorRut = !this.rut || this.rut.length !== 9;
                    this.validarFormulario();

                    if (!this.formInvalid) {

                        const digitoVerificadorCalculado = this.calcularDigitoVerificador();
                        this.formatorut = this.formatoRut() + '-' + digitoVerificadorCalculado;
                        if (String(digitoVerificadorCalculado) !== this.rut.slice(8, 9)) {
                            alert("Error: El RUT ingresado no es valido.");
                            this.errorRut = true;
                            this.validarFormulario();
                        }

                        console.log("Nombre:", this.nombre, "RUT:", this.rut, "formato:", this.formatorut);
                    }
                },


            };
        }
    </script>
@endsection
