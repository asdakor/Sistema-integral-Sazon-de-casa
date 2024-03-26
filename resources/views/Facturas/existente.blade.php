@extends('layouts.admin')

@section('main')
    <div class="card-deck col-md-10">
        <div class="card" style="width: 50rem;" x-data="validar()">

            <form id="formulariofactura" method="POST" action="{{ route('facturas.guardaren') }}"
                x-bind:disabled="continuar">
                @csrf


                <div class="card-body">
                    <div disabled class="row form-group">
                        <div class="col-md-12 d-flex">
                            <label for="numero_factura">Nº Factura:<br>
                                <input class="form-control" id="numero_factura" type="text" name="numero_factura"
                                    value="{{ $factura->numero_factura }}"></label>
                            @error('numero_factura')
                                <small> {{ $message }}</small>
                            @enderror

                            <label class="ml-3" for="proveedor">Proveedores:<br>
                                <input class="form-control" id="proveedor" type="text" name="proveedor"
                                    value="{{ $factura->rut_proveedor }}"></label>
                        </div>

                        <div class="col-3 d-flex">
                            <label for="fecha">Fecha:
                                <input class="form-control" id="fecha" type="date" name="fecha"
                                    value="{{ $factura->fecha }}"></label><br>
                            @error('fecha')
                                <small> {{ $message }}</small>
                            @enderror
                            <br>
                        </div>

                        <div class="col-9 d-flex">

                            <label class="ml-3" for="totalneto">Total Neto:
                                <input x-model="totalneto" class="form-control" id="totalneto" type="text"
                                    name="totalneto"> </label>
                            <label class="ml-3" for="totaliva">Total Iva:
                                <input x-model="totaliva" class="form-control" id="totaliva" type="text"
                                    name="totaliva"> </label>
                            <label class="ml-3" for="totalfactura">Total Factura:
                                <input x-model="totalfactura" class="form-control" id="totalfactura" type="text"
                                    name="totalfactura"> </label> <br>
                        </div>

                        <div class="col-12 d-flex">
                            <label for="tipo">Producto:
                                <select class="form-control "name="producto" id="producto">
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id_producto }}"> {{ $producto->nombre_producto }}
                                        </option>
                                    @endforeach
                                </select></label>
                            <label class="ml-3" for="cantidad">Cantidad:
                                <input type="text" id="cantidad" name="cantidad" class="form-control">
                                @error('cantidad')
                                    <small> {{ $message }}</small>
                                @enderror </label></label>
                            <label class="ml-3" for="precio">Precio:
                                <input x-model="precio" type="text" id="precio" name="precio" class="form-control"></label> <br>
                        </div> <br>
                        <button x-bind:disabled="continuar" type="button" class="btn btn-success"
                            @click="calcular()">Continuar</button><br>

                        <small x-show="ErrorSuma" style="background: red">Error: La sumatoria es mayor al total facturado</small><br>
                        <small x-show="MsjExito" style="background: green">La sumatoria de detalles es igual al total facturado.</small><br>
                    </div>
                </div>
            </form>
            <div class="card-body">
                <form method="POST" action="{{ route('facturas.eliminar',$factura->numero_factura) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Factura</button>
                </form>
            </div>

        </div>
        <div class="card" style="width: 50rem; ml-3">
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
                                @foreach ($productos as $producto)
                                    @if ($detalle->id_producto == $producto->id_producto and $detalle->numero_factura == $factura->numero_factura)
                                        {{ $producto->nombre_producto }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $detalle->precio_detalle }}</td>
                            <td>
                                <form method="POST" action="{{ route('detalle.destroy', $detalle->id_detalle) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">X</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


    <script>
        function validar() {
            return {
                totalneto: "{{ $factura->total_neto }}",
                totaliva: "{{ $factura->total_iva }}",
                totalfactura: "{{ $factura->total_factura }}",
                sumatoria: '{{ $sumatoria }}',
                precio: null,
                continuar: false,
                ErrorSuma: false,
                MsjExito: false,
                init() {
                    let totalfacturaNum = parseFloat(this.totalfactura);
                    let sumatoriaNum = parseFloat(this.sumatoria);
                    if (sumatoriaNum == totalfacturaNum) {
                        console.log(
                            "La sumatoria de la factura es igual al total facturado no se puede agregar mas productos");
                        this.continuar = true;
                        this.MsjExito = true; 
                        return;
                    } else {
                        if (sumatoriaNum > totalfacturaNum) {
                            console.log("Error en la sumatoria");
                            this.ErrorSuma = true;
                            this.continuar = true;
                            return;
                        }
                    }

                },
                calcular() {
                    let totalnetoNum = parseFloat(this.totalneto);
                    let totalivaNum = parseFloat(this.totaliva);
                    let totalfacturaNum = parseFloat(this.totalfactura);
                    let sumatoriaNum = parseFloat(this.sumatoria);
                    let precioNum = parseFloat(this.precio);
                    let diferencia = totalfacturaNum - (totalivaNum + totalnetoNum);
                    if((precioNum+sumatoriaNum)>totalfacturaNum){
                        console.log("Error, al agregar este producto la sumatoria de la factura supera el total facturado ");
                        this.ErrorSuma = true;
                        return;
                    }





                    if (Math.abs(diferencia) < 0.01) {
                        console.log("El total facturado es correcto");
                        this.continuar = false;
                        document.getElementById('formulariofactura').submit();
                    } else {
                        console.log("El total facturado es incorrecto, la diferencia es: ", diferencia);
                        this.continuar = true;
                    }
                }
            }
        }
    </script>
@endsection
