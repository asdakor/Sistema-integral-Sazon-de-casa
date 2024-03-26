@extends('layouts.admin')
@section('main')

<script>
    document.addEventListener('DOMContentLoaded', function () {
       
        var productosSinStock = @json($productosSinStock); // Asegúrate de pasar los productos sin stock desde tu controlador
        if (productosSinStock.length > 0) {
            alert("¡ATENCION! Los siguientes productos tienen stock insuficiente:\n\n" +
             productosSinStock.map(producto => producto.nombre_producto).join('\n'));
        }
    });
</script>
<div class="center col-md-10">
    <h1>Bienvenido al sistema de control de existencias, compras y ventas</h1>
</div>

@endsection