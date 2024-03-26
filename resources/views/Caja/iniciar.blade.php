@extends('layouts.master')

@section('main')
<h3 style="color:white" >Iniciar Caja</h3>
<div class="card-group">  
    <form action="{{route('validar.cajero')}}" id="formulario">
        @csrf
        <label style="color:white" for="rut_trabajador">RUT CAJERO:
            <input class="form-control" id="rut_trabajador" type="text" name="rut_trabajador">
            @error('rut_trabajador')
                <small> {{ $message }}</small>
            @enderror
        </label>
        <label  style="color:white" for="clave_cajero">CLAVE:
            <input class="form-control" id="clave_cajero" type="password" name="clave_cajero">
            @error('clave_cajero')
                <small> {{ $message }}</small>
            @enderror
        </label>
        <button class="btn btn-success" type="submit" onclick="validarFormulario()">Continuar</button>
    </form>
</div>
@endsection