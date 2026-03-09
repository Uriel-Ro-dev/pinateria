@extends('adminlte::page')

@section('title', 'Nuevo Usuario - Piñatería Piña')

@section('content_header')
    <h1 class="text-purple font-weight-bold">Registrar Nuevo Usuario</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-outline card-purple shadow">
                    <div class="card-header">
                        <h3 class="card-title">Formulario de Registro Administrativo</h3>
                    </div>

                    <form action="{{ route('usuarios.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                {{-- Nombre --}}
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombre(s)</label>
                                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ej. Uriel" required>
                                    @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                {{-- Apellido --}}
                                <div class="form-group col-md-6">
                                    <label for="apellido">Apellido(s)</label>
                                    <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}" placeholder="Ej. Gomez" required>
                                    @error('apellido') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                {{-- Email --}}
                                <div class="form-group col-md-6">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="usuario@ejemplo.com" required>
                                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                {{-- Teléfono --}}
                                <div class="form-group col-md-6">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" placeholder="33XXXXXXXX">
                                </div>
                            </div>

                            <div class="row">
                                {{-- Contraseña --}}
                                <div class="form-group col-md-6">
                                    <label for="password">Contraseña Provisional</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                    <small class="text-muted">Mínimo 8 caracteres.</small>
                                    @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                {{-- Confirmar Contraseña --}}
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>

                            {{-- Domicilio --}}
                            <div class="form-group">
                                <label for="domicilio">Domicilio de Entrega (Jalisco)</label>
                                <textarea name="domicilio" class="form-control" rows="2" placeholder="Calle, Número, Colonia, Zapopan...">{{ old('domicilio') }}</textarea>
                            </div>

                            <div class="row">
                                {{-- Rol --}}
                                <div class="form-group col-md-6">
                                    <label for="rol">Asignar Rol</label>
                                    <select name="rol" class="form-control">
                                        <option value="cliente" selected>Cliente</option>
                                        <option value="admin">Administrador del Sistema</option>
                                    </select>
                                </div>
                                {{-- Estado Inicial --}}
                                <div class="form-group col-md-6">
                                    <label for="status">Estado Inicial</label>
                                    <select name="status" class="form-control">
                                        <option value="activo" selected>Activo</option>
                                        <option value="inactivo">Inactivo (Suspendido)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-purple text-white bg-purple">
                                <i class="fas fa-user-plus"></i> Crear Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="callout callout-info">
                    <h5><i class="fas fa-lightbulb text-info"></i> Tip de Admin</h5>
                    <p>Al crear un nuevo <strong>Administrador</strong>, este tendrá acceso total al inventario de piñatas y reportes de ventas.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .text-purple { color: #8c43f6; }
        .card-purple.card-outline { border-top: 3px solid #8c43f6; }
        .bg-purple { background-color: #8c43f6 !important; }
    </style>
@endsection
