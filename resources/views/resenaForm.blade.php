<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
    <img src="{{ asset('img/logo.png') }}"
         alt="Logo Piñatería Piña"
         width="60"
         height="60"
         class="d-inline-block align-text-top mr-2"
         style="object-fit: contain; clip-path: circle();">
    <span class="font-weight-bold" style="font-size: 1.4rem;">Piñatería Piña</span>
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">

    <!-- Menú centrado -->
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" href="#">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Nosotros</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Tienda
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Catálogo</a></li>
                <li><a class="dropdown-item" href="#">Combos</a></li>
                <li><a class="dropdown-item" href="#">Personalizadas</a></li>
                <li><a class="dropdown-item" href="#">Cursos</a></li>
                <li><a class="dropdown-item" href="/resenas/create">Reseñas</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Carrito</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contacto</a>
        </li>
    </ul>

    <!-- Login pegado a la derecha -->
    <ul class="navbar-nav ms-auto">
        @guest
            <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ route('login') }}">
                    Iniciar Sesión
                </a>
            </li>
        @endguest

        @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle fw-bold" href="#" data-bs-toggle="dropdown">
                    {{ Auth::user()->nombre }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        @endauth
    </ul>

</div>

  </div>
</nav>

{{-- formulario de reseña --}}
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">

            {{-- Diseño de Card Outline Morado (como el de usuarios) --}}
            <div class="card card-outline card-purple shadow">

                <div class="card-header text-center">
                    <h3 class="card-title text-purple font-weight-bold" style="float: none;">
                        <i class="fas fa-star text-warning"></i>
                        ¿Qué te pareció tu Piñata?
                        <i class="fas fa-star text-warning"></i>
                    </h3>
                </div>

                <form action="{{ route('resenas.store') }}" method="POST">
                    @csrf

                    <div class="card-body">

                        {{-- Mensajes de estado (Éxito en Zapopan) --}}
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="icon fas fa-check"></i> {{ session('status') }}
                                <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            {{-- Selector de Compra --}}
                            <div class="form-group col-md-6">
                                <label for="compra_select">
                                    <i class="fas fa-receipt text-purple"></i> Selecciona tu Compra (Folio)
                                </label>
                                <select id="compra_select" class="form-control @error('pinata_id') is-invalid @enderror" required onchange="actualizarPinatas()">
                                    <option value="">-- Elige una compra --</option>
                                    @foreach($compras as $compra)
                                        {{-- data-detalles guarda la info de las piñatas en Zapopan --}}
                                        <option value="{{ $compra->id }}" data-detalles='{{ json_encode($compra->detalles) }}'>
                                            Folio: {{ $compra->folio_compra }} - Fecha: {{ $compra->fecha_registro }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Mostrando tus compras recientes.</small>
                            </div>

                            {{-- Selector de Piñata --}}
                            <div class="form-group col-md-6">
                                <label for="pinata_select">
                                    <i class="fas fa-gifts text-purple"></i> ¿Qué piñata quieres calificar?
                                </label>
                                <select name="pinata_id" id="pinata_select" class="form-control @error('pinata_id') is-invalid @enderror" required disabled>
                                    <option value="">-- Selecciona primero una compra --</option>
                                </select>
                                @error('pinata_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row pt-2">
                            {{-- Estrellas --}}
                            <div class="form-group col-md-12 text-center">
                                <label class="d-block mb-3">Tu Calificación:</label>
                                <select name="estrellas" class="form-control text-warning" style="font-size: 1.2rem;">
                                    <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                                    <option value="4">⭐⭐⭐⭐ (Muy buena)</option>
                                    <option value="3">⭐⭐⭐ (Buena)</option>
                                    <option value="2">⭐⭐ (Regular)</option>
                                    <option value="1">⭐ (Mala)</option>
                                </select>
                            </div>
                        </div>

                            {{-- Comentario --}}
                        <div class="form-group">
                            <label>Cuéntanos más:</label>
                            <textarea name="comentario" class="form-control @error('comentario') is-invalid @enderror" rows="5" placeholder="¿Cómo fue el acabado? ¿Llegó a tiempo a tu domicilio?" required></textarea>
                            @error('comentario') <span class="invalid-feedback">{{ $message }}</span> @enderror                        </div>

                    </div>

                    {{-- Botón en Footer, alineado a la derecha --}}
                    <div class="card-footer text-right">
                        <a href="{{ url('/') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-purple text-white bg-purple">
                            <i class="fas fa-paper-plane"></i> Publicar mi opinión
                        </button>
                    </div>
                </form>
            </div>

            {{-- Spacer para empujar el footer hacia abajo --}}
            <div class="py-5"></div>

        </div>
    </div>
</div>


@section('css')
<style>
    /* Estilos personalizados morados para Zapopan */
    .text-purple { color: #8c43f6; }
    .card-purple.card-outline { border-top: 3px solid #8c43f6; }
    .bg-purple { background-color: #8c43f6 !important; }

    /* Efecto de hover para las estrellas */
    .rating-star:hover,
    .rating-star:hover ~ .rating-star,
    input[type="radio"]:checked ~ label {
        color: #ffc107 !important; /* Amarillo fuerte al seleccionar */
    }
</style>


@section('js')
<script>
// El script de JS, con el error de gettlementById corregido
function actualizarPinatas() {
    const selectCompra = document.getElementById('compra_select');
    const selectPinata = document.getElementById('pinata_select');
    const option = selectCompra.options[selectCompra.selectedIndex];

    // Limpiamos el select de piñatas
    selectPinata.innerHTML = '<option value="">-- Selecciona una piñata --</option>';

    if (option.value !== "") {
        const detalles = JSON.parse(option.getAttribute('data-detalles'));
        detalles.forEach(detalle => {
            const opt = document.createElement('option');
            opt.value = detalle.pinata_id;
            opt.text = detalle.pinata.nombre; // Traemos el nombre de la piñata en Zapopan
            selectPinata.add(opt);
        });
        selectPinata.disabled = false;
    } else {
        selectPinata.disabled = true;
    }
}
</script>

{{-- Footer --}}
<footer class="bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">

        <div class="row">

            <!-- LOGO / DESCRIPCIÓN -->
            <div class="col-md-4 mb-4">
                <h4 class="fw-bold text-warning">🎉 Piñateria Piña</h4>
                <p>
                    Creamos piñatas únicas y personalizadas para hacer tus fiestas
                    inolvidables. Calidad, rapidez y diversión garantizada.
                </p>
            </div>

            <!-- ENLACES RÁPIDOS -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Enlaces</h5>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white text-decoration-none">Inicio</a></li>
                    <li><a href="/catalogo" class="text-white text-decoration-none">Catálogo</a></li>
                    <li><a href="/contacto" class="text-white text-decoration-none">Contacto</a></li>
                </ul>
            </div>

            <!-- CONTACTO -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Contacto</h5>
                <p class="mb-1">📍 Guadalajara, Jalisco</p>
                <p class="mb-1">📞 33 1234 5678</p>
                <p class="mb-1">✉️ contacto@pinataspina.com</p>
            </div>

        </div>

        <hr class="bg-light">

        <!-- DERECHOS -->
        <div class="text-center">
            <small>
                © {{ date('Y') }} Piñatas Piña. Todos los derechos reservados.
            </small>
        </div>

    </div>
</footer>

</body>
</html>

