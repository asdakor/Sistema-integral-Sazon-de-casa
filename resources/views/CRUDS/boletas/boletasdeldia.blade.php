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
                @foreach ($boletas as $boleta)
                    <tr>
                        <td>{{ $boleta->id_boleta }}</td>
                        <td>{{ $boleta->fecha }}</td>
                        <td>{{ $boleta->total_boleta }}</td>
                        <td>
                            <form method="GET" action="{{ route('boletas.encontrada', $boleta->id_boleta) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">VER BOLETA</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
