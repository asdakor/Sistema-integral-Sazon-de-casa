@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data='busqueda()'>

        <div class="row ml-2">
            <div class="card col-md-6">
            <form form action="{{ route('recetas.ingresar') }}" method="GET">       
                <h2 class="bg-white" style="text-align:center">Ingresar receta</h2>
                <select class="form-control" name="productofinal" id="productofinal">
                    @foreach ($platos as $plato)
                        <option value="{{ $plato->id_productofinal }}"> {{ $plato->nombre_producto }}</option>
                    @endforeach
                </select>
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