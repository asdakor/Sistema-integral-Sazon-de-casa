@extends('layouts.master')

@section('main')
    <h3>SISTEMA DE CAJA SAZON DE CASA</h3>
    <div class="card-deck">

        <div class="card">
            <div class="container">
                <div class="row">
                    @foreach ($categorias as $categoria)
                        <div class="col-sm">
                            <form action="{{ route('actualizar2.lista', $boleta->id_boleta) }}" id="botones">
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
                            <form action="{{ route('test3', $boleta->id_boleta) }}">
                                <button name="producto" type="submit" class="boton-personalizado1" id="producto"
                                    value="{{ $productofinal->id_productofinal }}">{{ $productofinal->nombre_producto }}</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    </div>
    <div class="card-deck mt-3">
        <div class="card">
            <table class="table tablebordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->cantidad_detalle }}</td>

                            <td>
                                {{ $detalle->nombre_producto }}
                            </td>
                            <td>{{ $detalle->precio_detalle }}</td>
                            <td>
                                <form method="POST"
                                    action="{{ route('detalleboleta.destroy', $detalle->id_detalleboleta) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">X</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form id="formulariob" action="{{ route('generar', $boleta) }}">
                @csrf
                @method('PUT')
                <div hidden>
                    @foreach ($detalles as $detalle)
                        @if ($detalle->id_boleta == $boleta->id_boleta)
                            {{ $totalboleta = $totalboleta + $detalle->precio_detalle }}
                        @endif
                    @endforeach
                </div>
                <h3><label for=""> Total Boleta: ${{ $totalboleta }}</label></h3>
                <input hidden type="text" id="total_boleta" name="total_boleta" class="form-control"
                    value="{{ $totalboleta }}">

                <div class="col-sm">
                    <button type="button" class="btn btn-success btn-lg" onclick="imprimirBoleta()">GENERAR
                        BOLETA</button>
                </div>



            </form>
            <form action="{{ route('boleta.cancelar',$boleta->id_boleta) }}">
                <div class="col-sm">
                    <button name="cancelar" type="submit" class="btn btn-danger btn-lg" id="cancelar"
                        value="postres">CANCELAR
                        COMPRA</button>
                </div>
            </form>
        </div>

    </div>
    <div class="bg-white" style="width: 100%" hidden id="imprimirboleta">
        <h2>###############################</h2>
        <h2>RESTAURANTE SAZON DE CASA LTDA</h2>
        <h2>FECHA: {{ date('d-m-Y') }}</h2>
        <h2>Numero de boleta: {{ $boleta->id_boleta }}</h2>
        <h2>###############################</h2>

        <table>
            <thead>
                <tr>
                    <th>
                        <h2>Cantidad</h2>
                    </th>
                    <th>
                        <h2>Descripcion</h2>
                    </th>
                    <th>
                        <h2>Precio</h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($detalles as $detalle)
                        @if ($detalle->id_boleta == $boleta->id_boleta)
                            <td>
                                <h2>{{ $detalle->cantidad_detalle }}</h2>
                            </td>
                            <td>
                                <h2>{{ $detalle->nombre_producto }}</h2>
                            </td>
                            <td>
                                <h2>${{ $detalle->precio_detalle }}</h2>
                            </td>
                        @endif
                </tr>
                @endforeach

            </tbody>
        </table>
        <h2>TOTAL BOLETA: ${{ $totalboleta }}</h2>
        <h2>###############################</h2>
        <img src="/imagenes/sazonqr.png">
        <h2>MUCHAS GRACIAS POR TU COMPRA</h2>
        <h2>Siguenos en Instagram</h2>
        <h2>@Sazon.de.casa.1207</h2>

        <h2>###############################</h2>
    </div>
@endsection
<script>
    function imprimirBoleta() {
        var contenido = document.getElementById('imprimirboleta').innerHTML;
        var ventanaImpresion = window.open('', 'PRINT', 'height=400,width=600');
        ventanaImpresion.document.write('<html><head><title>Boleta</title>');
        ventanaImpresion.document.write('<style type="text/css" media="print">');
        ventanaImpresion.document.write('@page { size: 58mm 210mm; }');
        ventanaImpresion.document.write('body { width: 64mm; }');

        ventanaImpresion.document.write('</style>');

        ventanaImpresion.document.write('</head><body>');
        ventanaImpresion.document.write(contenido);
        ventanaImpresion.document.write('</body></html>');
        ventanaImpresion.document.close();
        ventanaImpresion.focus();
        ventanaImpresion.print();
        ventanaImpresion.close();
        document.getElementById('formulariob').submit();
    }
</script>
