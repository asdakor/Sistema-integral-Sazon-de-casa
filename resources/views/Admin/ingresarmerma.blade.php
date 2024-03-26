@extends('layouts.admin')

@section('main')

    <div class="card div-1 ml-3" style="text-align: left;">
        <h3>Agregar producto a merma</h3>
        <form id="formulario" action="{{ route('mermas.store') }}">

            <label for="producto">Producto: </label> <br>

            <select class="form-control" name="producto" id="producto">
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre_producto }}</option>
                @endforeach    
            </select> <br>

            <label for="cantidad">Cantidad: </label> <br>

            <input type="text" id="cantidad" name="cantidad" value="{{ old('producto') }}"> <br>
            
            <label for="glosa">Glosa: </label> <br>

            <input type="text" id="glosa" name="glosa" value="{{ old('glosa') }}"> <br>
            <button class="btn btn-success mt-2" type="submit">Continuar</button>
        </form>
    </div>
@endsection
