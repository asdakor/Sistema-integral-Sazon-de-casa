<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sazon de casa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    @vite('resources/js/app.js')
</head>

<body>



    {{-- BARRA DE NAVEGACION PARA USUARIO ATUENTICADO --}}

    <div class="row">
        @auth
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                    <a class="navbar-brand" href="/"><img src="/imagenes/Logo.png" alt="Logo" width="30"
                            height="24" class="d-inline-block align-text-top"> Sazon de casa</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">

                            
                            <li class="nav-item active">
                                <a class="nav-link" href="/revisar/control">Control de existencias<span
                                        class="sr-only">(current)</span></a>
                            </li>


                        </ul>

                        <div class="button" style="margin-right:30px">
                            <h5>{{ Auth::user()->nombre }} {{ Auth::user()->apellidop }}</h5>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Cerrar Sesion</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="p-4 bg-white col-md-2" style="width: 280px;height: 100vh">
                <a href="/admindashboard"
                    class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                    <img src="/imagenes/Logo.png" width="50" height="48" class="d-inline-block align-text-top ml-">
                    <span class="fs-5 fw-semibold">Administracion</span>
                </a>
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#usuarios-collapse" aria-expanded="false">
                            USUARIOS
                        </button>
                        <div class="collapse" id="usuarios-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/usuarios/crear" class="link-dark rounded">Crear</a></li>
                                <li><a href="/usuarios/listado" class="link-dark rounded">Listado</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#roles-collapse" aria-expanded="false">
                            ROLES
                        </button>
                        <div class="collapse" id="roles-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/roles/crear" class="link-dark rounded">Crear</a></li>
                                <li><a href="/roles/listado" class="link-dark rounded">Listado</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#categorias-collapse" aria-expanded="false">
                            CATEGORIAS
                        </button>
                        <div class="collapse" id="categorias-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/categorias/crear" class="link-dark rounded">Crear</a></li>
                                <li><a href="/categorias/listado" class="link-dark rounded">Listado</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#productosfinales-collapse" aria-expanded="false">
                            PRODUCTOS VENTA
                        </button>
                        <div class="collapse" id="productosfinales-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/productosfinales/crear" class="link-dark rounded">Crear</a></li>
                                <li><a href="/productosfinales/listado" class="link-dark rounded">Listado</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#productos-collapse" aria-expanded="false">
                            MATERIAS PRIMAS E INSUMOS
                        </button>
                        <div class="collapse" id="productos-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/productos/crear" class="link-dark rounded">Crear</a></li>
                                <li><a href="/productos/listado" class="link-dark rounded">Listado</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#proveedores-collapse" aria-expanded="false">
                            PROVEEDORES
                        </button>
                        <div class="collapse" id="proveedores-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/proveedores/crear" class="link-dark rounded">Crear</a></li>
                                <li><a href="/proveedores/listado" class="link-dark rounded">Listado</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#boletas-collapse" aria-expanded="false">
                            BOLETAS
                        </button>
                        <div class="collapse" id="boletas-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/boletas/buscar" class="link-dark rounded">Buscar Boleta</a></li>
                                <li><a href="/boletas/anular" class="link-dark rounded">Anular Boleta</a></li>
                                <li><a href="/boletas/deldia" class="link-dark rounded">Boletas del dia</a></li>
                                <li><a href="/boletas/porfecha" class="link-dark rounded">Boletas por fecha</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#recetas-collapse" aria-expanded="false">
                            RECETAS
                        </button>
                        <div class="collapse" id="recetas-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/recetas/crear" class="link-dark rounded">Ingresar receta</a></li>
                                <li><a href="/recetas/crear" class="link-dark rounded">Revisar receta</a></li>
                                <li><a href="/recetas/editar" class="link-dark rounded">Editar receta</a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#facturas-collapse" aria-expanded="false">
                            FACTURAS
                        </button>
                        <div class="collapse" id="facturas-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/facturas/ingreso" class="link-dark rounded">Ingresar factura</a></li>
                                <li><a href="/facturas/buscar" class="link-dark rounded">Buscar factura por numero</a>
                                </li>
                                <li><a href="/facturas/buscarfecha" class="link-dark rounded">Buscar facturas por
                                        fechas</a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#ajustes-collapse" aria-expanded="false">
                            AJUSTES DE INVENTARIO
                        </button>
                        <div class="collapse" id="ajustes-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ml-3">
                                <li><a href="/mermas/crear" class="link-dark rounded">Agregar Merma</a></li>
                                <li><a href="/ajustes/stock" class="link-dark rounded">Ajustar Stock minimos</a></li>
                                <li><a href="/ingresar/control" class="link-dark rounded">Ingresar control</a></li>
                                <li><a href="/revisar/control" class="link-dark rounded">Revisar control</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="border-top my-3"></li>

                </ul>

            </div>
        @endauth
        {{-- BARRA DE NAVEGACION PARA USUARIO NO ATUENTICADO --}}
        <div class="mt-2 col-md-10">
            @include('components.flash_alerts')


            @yield('main')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <style>
        body {
            background-image: url('/imagenes/Background.png');

            background-size: cover;
        }

        .asignador {
            display: flex;
        }

        .div-1 {
            width: 300px;
            background-color: #ffffff;
        }

        .div-table1 {
            width: 400px;
            background-color: #ABBAEA;
        }

        .div-table2 {
            width: 400px;
            background-color: #ABBAEA;
        }

        .div-3 {
            margin: 0 auto;
            text-align: left;
            width: 230px;
            height: 200px;
            background-color: #ffffff;
        }

        .div-productos {
            margin: 0 auto;
            text-align: left;
            width: 230px;
            height: 200px;
            background-color: #ffffff;
        }

        .boton-personalizado1 {
            width: 150px;
            height: 150px;
            text-decoration: none;
            font-weight: 600;
            font-size: 20px;
            color: #ffffff;

            background-color: #1a87fc;
        }

        .boton-personalizado2 {
            width: 150px;
            height: 150px;
            text-decoration: none;
            font-weight: 600;
            font-size: 20px;
            color: #ffffff;

            background-color: #8a8a8a;
        }
    </style>
    @yield('scripts')

</body>

</html>
