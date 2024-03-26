@extends('layouts.admin')

@section('main')
    <div class="card-deck" style="width: 50rem;">
        <div class="card" style="width: 50rem;">

            <form id="formulariofactura" method="POST" action="{{ route('facturas.buscarfactura') }}">
                @csrf
                @method('POST')

                <div class="card-body">
                    <div class="form-group">
                        <label for="numero_factura">Nº Factura:
                            <input class="form-control" id="numero_factura" type="text" name="numero_factura"
                                value="{{ old('numero_factura') }}">
                            @error('numero_factura')
                                <small> {{ $message }}</small>
                            @enderror
                        </label>


                        <button type="submit" class="btn btn-success">Buscar</button>


                    </div>
                </div>

        </div>

    </div>

@endsection
