<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sazon de casa</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        @vite('resources/js/app.js')
</head>

<body>
    <style>
        body {
            background-image: url('/imagenes/Background.png');

                background-size: cover;

        }
    </style>

    {{-- BARRA DE NAVEGACION PARA USUARIO ATUENTICADO --}}
    @auth

        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <a class="navbar-brand" href="/"><img src="/imagenes/Logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> Sazon de casa</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
            @if ((Auth::user()->rol)== 5)
            <li class="nav-item active">
                <a class="nav-link" href="/admindashboard" target="_parent">Admin <span
                        class="sr-only">(current)</span></a>
            </li>
            @endif
            
            <li class="nav-item active">
                <a class="nav-link" href="/iniciocaja" target="_parent">Ventas <span
                        class="sr-only">(current)</span></a>
            </li>
            </ul>
            </div>


            {{--  
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Compras
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('facturas.ingresar') }}">Agregar Factura</a>
                            <a class="dropdown-item" href="">Buscar Factura</a>
                            <a class="dropdown-item" href="">ALGO IRA AQUI</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Agregar nuevo
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('facturas.ingresar') }}">Receta</a>
                            <a class="dropdown-item" href="">Plato</a>
                            <a class="dropdown-item" href="/proveedores/crear">Proveedor</a>
                            <a class="dropdown-item" href="">Materia prima o insumo</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/iniciocaja" target="_parent">Ventas <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mantenedores
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Editar Recetas</a>
                            <a class="dropdown-item" href="">Editar Platos</a>
                            <a class="dropdown-item" href="">Editar Materias primas e insumos</a>
                            <a class="dropdown-item" href="">jajant</a>
                        </div>
                    </li>

                </ul>--}}
                <div style="margin-right: 30px">
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

    @endauth
    {{-- BARRA DE NAVEGACION PARA USUARIO NO ATUENTICADO --}}
    @guest

        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <a class="navbar-brand" href="/"><img src="/imagenes/Logo.png" alt="Logo" width="30"
                    height="24" class="d-inline-block align-text-top"> Sazon de casa</a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav mr-auto">
            </ul>

            <a class="btn btn-success" href="{{ route('registro.formulario') }}"> Registro</a>



        </nav>

    @endguest

    <div class="container-fluid mt-2">
        @include('components.flash_alerts')
        @yield('main')
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="/js/app.js"></script>
    <script src="/js/button.js"></script>
    <style>
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
        div.dashboard {
            text-align: center;
            text-decoration-color: #ffffff
        }
       
    </style>
    @yield('scripts')
</body>

</html>
