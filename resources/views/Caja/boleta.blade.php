@extends('layouts.master')

@section('main')
    <h3>SISTEMA DE CAJA SAZON DE CASA</h3>
    <div class="card-deck">
        <form action="{{ route('actualizar.lista') }}" id="botones">
            @csrf
            @method('GET')
            <div class="card">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm">
                            <button name="platos" type="submit" class="boton-personalizado2" id="platos"
                                value="platos">PLATOS</button>
                        </div>
                        <div class="col-sm">
                            <button name="postres" type="submit" class="boton-personalizado2" id="postres"
                                value="postres">POSTRES</button>
                        </div>
                        <div class="col-sm">
                            <button name="sandwishes" type="submit" class="boton-personalizado2" id="sandwishes"
                                value="sandwishes">SANDWISHES</button>
                        </div>
                        <div class="col-sm">
                            <button name="tablas" type="submit" class="boton-personalizado2" id="tablas"
                                value="tablas">TABLAS/PICOTEOS</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm">
                            <button name="generar" type="submit" class="btn btn-success btn-lg" id="generar"
                                value="platos">GENERAR BOLETA</button>
                        </div>
                        <div class="col-sm">
                            <button name="cancelar" type="submit" class="btn btn-danger btn-lg" id="cancelar"
                                value="postres">CANCELAR COMPRA</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="container">
                <div class="row">
                    @if ($platos == null)
                    @else
                        @foreach ($platos as $plato)
                            <div class="col-sm">
                                <form action="{{ route('test') }}">
                                    <button name="platos" type="submit" class="boton-personalizado1" id="platos"
                                        value="{{ $plato->id_plato }}">{{ $plato->nombre_plato }}</button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                    @if ($postres == null)
                    @else
                        @foreach ($postres as $postre)
                            <div class="col-sm">
                                <form action="{{ route('test') }}">
                                    <button type="button" class="boton-personalizado1" id="postres"
                                        value="{{ $postre->id_postre }}">{{ $postre->nombre_postre }}</button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                    @if ($sandwishes == null)
                    @else
                        @foreach ($sandwishes as $sandwish)
                            <div class="col-sm">
                                <form action="{{ route('test') }}">
                                    <button type="button" class="boton-personalizado1" id="sandwishes"
                                        value="{{ $sandwish->id_sandwish }}">{{ $sandwish->nombre_sandwish }}</button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                    @if ($tablas == null)
                    @else
                        @foreach ($tablas as $tabla)
                            <div class="col-sm">
                                <form action="{{ route('test') }}">
                                    <button type="button" class="boton-personalizado1" id="tablas"
                                        value="{{ $tabla->id_tabla }}">{{ $tabla->nombre_tabla }}</button>
                                </form>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

        </div>
    </div>
    <div class="card-deck mt-3">
        <div class="card">
            <form action="">
                <input type="text">
            </form>
        </div>

    </div>
@endsection
