@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data="rellenar()">
        <div style="display: flex">
            <div style="width: 100%">
                <h2 class="bg-white" style="text-align:center">{{ $usuario->nombre }} {{ $usuario->apellidop }}
                    {{ $usuario->apellidom }} <a href="/usuarios/listado" class="btn btn-danger mb-1" role="button">Volver</a></h2>
                <div class="card" style="">
                    <img src="{{ $usuario->profile_photo_path }}" class="card-img-top" alt="Fotodeperfil">

                    <div class="card-body">
                        <h5 class="card-title">{{ $usuario->nombre }} {{ $usuario->apellidop }} {{ $usuario->apellidom }}
                        </h5>
                        <p class="card-text">RUT: {{ $usuario->rut }}</p>
                        <p class="card-text">Cargo: {{ $rol->nombre_rol }}</p>
                        <p class="card-text">Correo: {{ $usuario->email }}</p>
                        <p class="card-text">Edad: {{ $edad }}</p>
                        <p class="card-text">Fecha de nacimiento: {{ $usuario->fecha_nacimiento }}</p>
                        <p class="card-text">Fecha de ingreso: {{ $usuario->fecha_ingreso }}</p>
                        <p class="card-text">Estado: Activo</p>


                    </div>

                </div>
            </div>
            <div style="width: 100%">
            <h2 class="bg-white ml-2" style=";text-align:center">Horario</h2>

            <div class="card ml-2" style="">
                <table id="listado" class="table table-light table-bordered " style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width:14%">Lunes</th>
                            <th style="width:14%">Martes</th>
                            <th style="width:14%">Miercoles</th>
                            <th style="width:14%">Jueves</th>
                            <th style="width:14%">Viernes</th>
                            <th style="width:14%">Sabado</th>
                            <th style="width:14%">Domingo</th>
                        </tr>
                    </thead>
                    <tbody>   
 
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>

                    </tbody>
                </table>

            </div>
        </div>
        </div>
    </div>

    </div>
    <script>
        function rellenar() {
            return {
                nombre: null,
                rut: null,
                apellidop: null,
                apellidom: null,
                fechanacimiento: null,
                fechaingreso: null,
                contraseña: null,
                email: null,
                errorNombre: false,
                errorRut: false,
                errorApellidop: false,
                errorApellidom: false,
                errorFechanacimiento: false,
                errorFechaingreso: false,
                errorContraseña: false,
                errorEmail: false,
                formatorut: null,
                action: '{{ route('usuarios.store') }}',
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
