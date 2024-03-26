@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data='busqueda()'>

        <div class="row ml-2">
            <div class="card col-md-6">
            <form form action="{{ route('boletas.listadoporfecha') }}" method="GET">       
                <h2 class="bg-white" style="text-align:center">Buscar Boleta</h2>
                <label for="fechainicio">Fecha de inicio:</label><br>
                <input type="date" name="fechainicio" id="fechainicio"><br>
                <label for="fechafinal">Fecha de termino:</label><br>
                <input type="date" name="fechafinal" id="fechafinal"><br>
                <button type="submit" class="btn btn-primary mt-2">Buscar</button>
                
            </form>
            </div>

    <script>
        function busqueda() {
            return {
                encontrado: true,
                buscar: null,
                boleta: null,
                filtrar() {




                    this.encontrado = !this.encontrado;
                    console.log(this.buscar);
                }

            };
        }
    </script>
@endsection
