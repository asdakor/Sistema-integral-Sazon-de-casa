@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data='busqueda()'>

        <div class="row ml-2">
            <div class="card col-md-6">
            <form form action="{{ route('boletas.filtrar') }}" method="GET">       
                <h2 class="bg-white" style="text-align:center">Buscar Boleta</h2>
                <label for="buscar">Numero de boleta:</label><br>
                <input type="text" name="buscar" id="buscar"><br>
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
