@extends('layouts.admin')

@section('main')
    <div class="container col-md-10 p-3">
        <table id="listado" class="table table-light table-bordered " style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th style="width:10%">ID</th>
                    <th style="width:20%">Fecha</th>
                    <th style="width:40%">Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->numero_factura }}</td>
                        <td>{{ $factura->fecha }}</td>
                        <td>{{ $factura->total_factura }}</td>
                        <td>
                            <form method="GET" action="{{ route('facturas.existente', $factura->numero_factura) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">VER FACTURA</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection