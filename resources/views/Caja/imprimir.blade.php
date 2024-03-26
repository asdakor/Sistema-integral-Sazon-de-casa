<div>
<h2>###############################</h2>
<h2>RESTAURANTE SAZON DE CASA LTDA</h2>
<h2>FECHA: {{date('d-m-Y')}}</h2>
<h2>Numero de boleta: {{$boleta->id_boleta}}</h2>
<h2>###############################</h2>

<table>
    <thead>
        <tr>
            <th><h2>Cantidad</h2></th>
            <th><h2>Descripcion</h2></th>
            <th><h2>Precio</h2></th>
        </tr>
    </thead>
    <tbody>
        <tr>
        @foreach ($detalles as $detalle)
        
                @if ($detalle->id_boleta == $boleta->id_boleta)
                    <td><h2>{{ $detalle->cantidad_detalle }}</h2></td>
                    <td>
                        <h2>{{ $detalle->nombre_producto }}</h2>
                    </td>
                    <td><h2>${{ $detalle->precio_detalle }}</h2></td>
                @endif        
            </tr>    
        @endforeach
        
    </tbody>
</table>
<h2>TOTAL BOLETA: ${{$boleta->total_boleta}}</h2>
<h2>###############################</h2>
<img src="/imagenes/sazonqr.png">
<h2>MUCHAS GRACIAS POR TU COMPRA</h2>
<h2>Siguenos en Instagram</h2>  
<h2>@Sazon.de.casa.1207</h2>

<h2><a href="{{route('sazon.caja')}}">###############################</a></h2>
</div>