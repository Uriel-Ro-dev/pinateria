@extends('adminlte::page')

@section('content')
<style>
    .admin-card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .admin-card:hover {
        transform: translateY(-5px);
    }
    .text-purple { color: #8c43f6; }
    .bg-purple { background-color: #8c43f6; }
    .btn-pink {
        background-color: #f643a7;
        color: white;
        border-radius: 20px;
        font-weight: bold;
    }
    .btn-pink:hover { background-color: #d83991; color: white; }
</style>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-purple font-weight-bold">Bienvenido, Administrador 🍍</h2>
            <p class="text-muted">Gestiona tu piñatería de forma sencilla y eficiente.</p>
        </div>
    </div>

    <div class="row mb-4 text-center">
        <div class="col-md-4">
            <div class="card admin-card p-3 border-left border-info">
                <h5 class="text-muted">Pedidos Hoy</h5>
                <h3 class="text-primary font-weight-bold">Próximamente</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card admin-card p-3 border-left border-success">
                <h5 class="text-muted">Ventas Mensuales</h5>
                <h3 class="text-success font-weight-bold">Próximamente</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card admin-card p-3 border-left border-warning">
                <h5 class="text-muted">Pendientes</h5>
                <h3 class="text-warning font-weight-bold">Próximamente</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card admin-card h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="text-purple font-weight-bold">📦 Catálogo de Piñatas</h5>
                </div>
                <div class="card-body">
                    <p>Administra tus piñatas de catálogo y personalizadas. Agrega nuevos modelos o actualiza precios.</p>
                    <a href="{{ url('/pinatas') }}" class="btn btn-purple text-white bg-purple">Ir a Productos</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card admin-card h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="text-purple font-weight-bold">👥 Gestión de Usuarios</h5>
                </div>
                <div class="card-body">
                    <p>Revisa la lista de clientes registrados, y gestiona sus roles.</p>
                    <a href="{{ url('/usuarios') }}" class="btn btn-pink">Ver Usuarios</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    {{-- Tarjeta de Compras/Ventas --}}
    <div class="col-md-4 mb-4">
        <div class="card admin-card h-100 shadow-sm">
            <div class="card-header bg-white border-0 pt-4">
                <h5 class="text-purple font-weight-bold">💰 Historial de Ventas</h5>
            </div>
            <div class="card-body">
                <p>Monitorea los pedidos realizados, verifica folios de pago y consulta el detalle de cada compra de tus clientes.</p>
                <a href="{{ route('compras.index') }}" class="btn btn-purple text-white bg-purple">
                    <i class="fas fa-shopping-cart"></i> Ver Ventas
                </a>
            </div>
        </div>
    </div>

    {{-- Tarjeta de Reseñas --}}
    <div class="col-md-4 mb-4">
        <div class="card admin-card h-100 shadow-sm">
            <div class="card-header bg-white border-0 pt-4">
                <h5 class="text-purple font-weight-bold">🌟 Moderación de Reseñas</h5>
            </div>
            <div class="card-body">
                <p>Gestiona la opinión de tus clientes. Revisa las calificaciones de las piñatas y elimina comentarios inapropiados.</p>
                <a href="{{ route('resenas.index') }}" class="btn btn-purple text-white bg-purple">
                    <i class="fas fa-star"></i> Moderar Opiniones
                </a>
            </div>
        </div>
    </div>

    {{-- Tarjeta de Categorías --}}
    <div class="col-md-4 mb-4">
        <div class="card admin-card h-100 shadow-sm">
            <div class="card-header bg-white border-0 pt-4">
                <h5 class="text-purple font-weight-bold">🏷️ Categorías de Piñatas</h5>
            </div>
            <div class="card-body">
                <p>Organiza tu inventario por tipos (Infantiles, Temporada, Personalizadas) para facilitar la búsqueda a tus clientes.</p>
                <a href="{{ route('categorias.index') }}" class="btn btn-purple text-white bg-purple">
                    <i class="fas fa-tags"></i> Gestionar Tipos
                </a>
            </div>
        </div>
    </div>
</div>

    @if (session('status'))
        <div class="alert alert-success mt-4 rounded-pill" role="alert">
            {{ session('status') }}
        </div>
    @endif
</div>
@endsection
