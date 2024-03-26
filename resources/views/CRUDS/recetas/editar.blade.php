@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data='busqueda()'>
        <div class="row ml-2">
            <div class="card col-md-6">
                <h2 class="bg-white" style="text-align:center">Agregar productos al plato
                    {{ $productofinal->nombre_producto }}</h2>
                <form form action="{{ route('recetas.agregar') }}" method="GET">
                    <input hidden type="text" name="productofinal" id="productofinal"
                        value="{{ $productofinal->id_productofinal }}"><br>
                    <label for="producto">Seleccionar producto:</label><br>
                    <select class="form-control" name="producto" id="producto">
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id_producto }}">{{ $producto->nombre_producto }}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="cantidad">Cantidad:</label><br>
                    <input type="text" name="cantidad" id="cantidad" x-model='cantidad' x-on:input="validarform">
                    <button type="submit" class="btn btn-primary mt-2" x-bind:disabled="formInvalid">Agregar</button>
                </form>
            </div>
            <div class="card col-md-5 ml-2">
                <h2 class="bg-white" style="text-align:center">Receta de
                    {{ $productofinal->nombre_producto }}</h2>
                <div class="card-body">
                    <div class="row">
                        @foreach ($recetas as $receta)
                            @if ($receta->id_productofinal == $productofinal->id_productofinal)
                                <div class="col-md-5 border mx-auto">
                                    <p>Producto:
                                        @foreach ($productos as $productoReceta)
                                            @if ($receta->id_producto == $productoReceta->id_producto)
                                                {{ $productoReceta->nombre_producto }}
                                            @endif
                                        @endforeach
                                        <br>
                                        Cantidad: {{ $receta->cantidad_receta }} Unidad: UND

                                    <form action="{{ route('recetas.destroy', $receta->id_receta) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger ml-3">QUITAR</button>
                                    </form>
                                    </p>

                                </div>


                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script>
            function busqueda() {
                return {
                    productofinal: '{{ $productofinal->id_productofinal }}',
                    buscar: null,
                    boleta: null,
                    cantidad: null,
                    errorCantidad: false,
                    formInvalid: true,
                    validarform() {
                        this.errorCantidad = !this.cantidad || this.cantidad.trim() === '';
                        this.validarFormulario();
                    },
                    validarFormulario() {
                    this.formInvalid = this.errorCantidad;
                    },
                    filtrar() {
                        this.encontrado = !this.encontrado;
                        console.log(this.buscar);
                    }
                };
            }
        </script>
    @endsection
