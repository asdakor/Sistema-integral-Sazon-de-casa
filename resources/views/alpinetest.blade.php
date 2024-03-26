<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/js/app.js')
</head>

<body>

    <div x-data="validar()">
        <form x-bind:action="action" method="POST" @submit="validar">
            @csrf 
            <label for="nombre">Nombre:</label><br>
            <input x-model="nombre" type="text" name="nombre"><br>
            <small x-show="errorNombre">Error: No ha colocado un nombre.</small><br>
    
            <label for="RUT">RUT (9 caracteres):</label><br>
            <input x-model="rut" type="text" name="rut" x-on:input="validar"><br>
            <small x-show="errorRut">Error: El RUT debe tener 9 caracteres.</small><br>
    
            <button type="submit" x-bind:disabled="formInvalid">Continuar</button>
        </form>
    </div>
    
    <script>
        function validar() {
            return {
                nombre: null,
                rut: null,
                errorNombre: false,
                errorRut: false,
                action: '{{ route('proveedores.store') }}', // Definir la URL del formulario
                formInvalid: true, // Inicialmente deshabilitar el botón de envío
    
                validar() {
                    this.errorNombre = !this.nombre;
                    this.errorRut = !this.rut || this.rut.length !== 9;
    
                    this.formInvalid = this.errorNombre || this.errorRut;
    
                    if (!this.formInvalid) {
                        console.log("Nombre:", this.nombre, "RUT:", this.rut);
                    }
                },
            };
        }
    </script>
    
</body>

</html>
