@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data='busqueda()'>

        <div class="row ml-2">
            <div class="card col-md-6">
            <h2 class="bg-white" style="text-align:center">Agregar productos al plato {{ $productofinal->nombre_producto }}</h2>
            <form form action="{{ route('recetas.agregar') }}" method="GET">      
                <input hidden type="text" name="productofinal" id="productofinal" value="{{ $productofinal->id_productofinal }}"><br>
                <label for="producto">Seleccionar producto:</label><br>
                <select class="form-control" name="producto" id="producto">
                    @foreach ($productos as $productos)
                        <option value="{{ $productos->id_producto }}"> {{ $productos->nombre_producto }}</option>
                    @endforeach
                </select>
                <br>
                <label for="cantidad">Cantidad:</label><br>
                <input type="text" name="cantidad" id="cantidad">
                <button type="submit" class="btn btn-primary mt-2">Agregar</button>
                
            </form>
        </div>

    <script>
        function busqueda() {
            return {
                productofinal: '{{ $productofinal->id_productofinal }}',
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