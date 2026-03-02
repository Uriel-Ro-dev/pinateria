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
    <div class="mx-auto" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Nosotros</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tienda
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Catálogo</a></li>
            <li><a class="dropdown-item" href="#">Combos</a></li>
            <li><a class="dropdown-item" href="#">Personalizadas</a></li>
            <li><a class="dropdown-item" href="#">Cursos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Carrito</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contacto</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

{{-- Carousel --}}
<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/logo.png') }}" class="d-block w-100" alt="Piñata de Estrella" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px;">
                    <h5>Piñatas Piña</h5>
                    <p>Nuestra piñatas son garantia de diversion.</p>
                </div>
            </div>
    <div class="carousel-item">
                <img src="{{ asset('img/piñatasTradicionales.png') }}" class="d-block w-100" alt="Promociones" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px;">
                    <h5>Piñatas Tradicionales</h5>
                    <p>Nuestra piñata de estrella es la favorita para estas fiestas.</p>
                </div>
            </div>
    <div class="carousel-item">
                <img src="{{ asset('img/combo.png') }}" class="d-block w-100" alt="Personalizadas" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px;">
                    <h5>¡Paquetes para Fiestas!</h5>
                    <p>Pregunta por nuestros combos de piñata</p>
                </div>
            </div>
        </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

{{-- Bienvenida --}}
<div class="container my-5 py-4">
    <div class="row mb-5 align-items-center justify-content-center">
        <div class="col-auto text-center">
            <img src="{{ asset('img/piña.png') }}" alt="Piña" class="img-fluid" style="max-height: 80px;">
        </div>
        <div class="col-md-8">
            <h2 class="text-purple font-weight-bold text-center text-md-left m-0">
                ¡Bienvenido a piñateria Piña!
            </h2>
        </div>
    </div>
</div>

{{-- catalogo/combos/personalizadas/cursos --}}
<div class="container my-5 py-4">
<div class="row justify-content-center">
    <div class="col-6 col-md-6 text-center mb-5">
        <div class="category-item">
            <div class="category-icon-container">
                <img src="{{ asset('img/catalogo.png') }}" alt="Catálogo" class="img-fluid category-icon">
            </div>
            <h4 class="font-weight-bold mt-3">Catálogo</h4>
            <p class="text-muted small px-2">Más piñatas, mas diversión.</p>
            <a href="#" class="btn btn-purple btn-rounded shadow-sm">Próximamente</a>
        </div>
    </div>

    <div class="col-6 col-md-6 text-center mb-5">
        <div class="category-item">
            <div class="category-icon-container">
                <img src="{{ asset('img/combo2.png') }}" alt="combos" class="img-fluid category-icon">
            </div>
            <h4 class="font-weight-bold mt-3">Combos</h4>
            <p class="text-muted small px-2">¡Promociones y combos en tu compra!</p>
            <a href="#" class="btn btn-purple btn-rounded shadow-sm">Próximamente</a>
        </div>
    </div>

    <div class="col-6 col-md-6 text-center mb-5">
        <div class="category-item">
            <div class="category-icon-container">
                <img src="{{ asset('img/murcielago.png') }}" alt="Personalizadas" class="img-fluid category-icon">
            </div>
            <h4 class="font-weight-bold mt-3">Personalizadas</h4>
            <p class="text-muted small px-2">Si no lo tenemos, lo fabricamos.</p>
            <a href="#" class="btn btn-purple btn-rounded shadow-sm">Próximamente</a>
        </div>
    </div>


    <div class="col-6 col-md-6 text-center mb-5">
        <div class="category-item">
            <div class="category-icon-container">
                <img src="{{ asset('img/curso.png') }}" alt="Cursos" class="img-fluid category-icon">
            </div>
            <h4 class="font-weight-bold mt-3">Cursos</h4>
            <p class="text-muted small px-2">¡Aprende a hacer tus piñatas favoritas!</p>
            <a href="#" class="btn btn-purple btn-rounded shadow-sm">Próximamente</a>
        </div>
    </div>
</div>
</div>

{{-- Calidad y rapidez --}}
<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">

        <!-- PRIMERA SECCIÓN -->
        <div class="row grid md:grid-cols-2 gap-10 align-items-center mb-20">

            {{-- texto --}}
            <div class="col-md-6">
                <h1 class="title-purple">Calidad</h1>
                <p class="paragraph-text">
                    Nuestra marca es un simbolo de califaf. En piñatas Piña amamos lo que hacemos, por ello entregamos nuestros productos con la maxima calidad. </p>
            </div>

            {{-- imagen --}}
            <div class="col-md-6 text-center ">
                <img src="{{ asset('img/calidad.png') }}" alt="calidad" class="responsive-image">
            </div>

        </div>


        <!-- SEGUNDA SECCIÓN -->
        <div class="row grid md:grid-cols-2 gap-10 align-items-center">

            <!-- Texto -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('img/veloz.png') }}" alt="veloz" class="responsive-image">
            </div>

            <!-- Imagen Circular -->
            <div class="col-md-6">
                <h1 class="title-purple">Rapidez</h1> <p class="paragraph-text">
                Tu decides el dia que puedas recibir la piñata. COn velocidad y precicion entregamos tu piñata sin ton ni son! </p>
            </div>

        </div>

    </div>
</div>

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
