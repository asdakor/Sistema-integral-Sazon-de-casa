@extends('layouts.admin')

@section('main')

    <div class="card div-1 ml-3" style="text-align: left;">
        <h3>Nueva Categoria</h3>
        <form id="nuevacat" action="{{ route('categorias.store') }}">

            <label for="nombre">Nombre: </label> <br>

            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"> <br>

            <button class="btn btn-success mt-2" type="submit">Continuar</button>
        </form>
    </div>
@endsection
