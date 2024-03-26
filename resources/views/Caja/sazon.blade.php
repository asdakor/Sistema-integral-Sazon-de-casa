@extends('layouts.master')

@section('main')
    <h3></h3>
    <div class="card-deck">

        <div class="card">
            <div class="container">
                <div class="row">
                    @foreach ($categorias as $categoria)
                        <div class="col-sm">
                            <form action="{{ route('actualizar.lista') }}" id="botones">
                                @csrf
                                @method('GET')
                                <button name="opcion" type="submit" class="boton-personalizado2" id="opcion"
                                    value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</button>
                            </form>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>


        <div class="card">
            <div class="container">
                <div class="row">
                    @foreach ($productosfinales as $productofinal)
                        <div class="col-sm">
                            <form action="{{ route('test') }}">
                                <button name="producto" type="submit" class="boton-personalizado1" id="producto"
                                    value="{{ $productofinal->id_productofinal }}">{{ $productofinal->nombre_producto }}</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection

