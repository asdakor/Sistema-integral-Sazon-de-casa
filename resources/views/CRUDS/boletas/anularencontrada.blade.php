@extends('layouts.admin')

@section('main')
    <div class="container col-md-10" x-data='busqueda()'>

        <div class="row ml-2">
            <div class="card col-md-6">
                <form form action="{{ route('boletas.destroy', $boleta->id_boleta) }}" method="GET">       
                    <h2 class="bg-white" style="text-align:center">Eliminar boleta numero:{{ $boleta->id_boleta }}</h2>
                    <p>¿Esta seguro de anular esta boleta?</p>
                    <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                    
                </form>
            </div>
            <div class="card col-md-3 ml-5" style="width: 50%" >
                <div class="card-body " style="">
                    <h2>###############################</h2>
                    <h2>RESTAURANTE SAZON DE CASA LTDA</h2>
                    <h2>FECHA: {{ $boleta->fecha }} </h2>
                    <h2>Numero de boleta:
                                {{ $boleta->id_boleta }}
                    </h2>
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
                    <h2>TOTAL BOLETA: ${{ $boleta->total_boleta }}</h2>
                    <h2>###############################</h2>
                    <img src="/imagenes/sazonqr.png">
                    <h2>MUCHAS GRACIAS POR TU COMPRA</h2>
                    <h2>Siguenos en Instagram</h2>
                    <h2>@Sazon.de.casa.1207</h2>

                    <h2>###############################</a></h2>
                </div>
            </div>
        </div>
    </div>


    <script>
        function busqueda() {
            return {
                encontrado: true,
                buscar: null,
                boleta: null,
                filtrar() {




                    this.encontrado = !this.encontrado;
                    console.log(this.buscar);
                }

            };
        }
    </script>
@endsection
