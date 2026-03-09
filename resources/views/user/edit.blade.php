@extends('adminlte::page')

@section('title', 'Editar Usuario - Piñatería Piña')

@section('content_header')
    <h1 class="text-purple font-weight-bold">Editar Perfil de Usuario</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                {{-- Card con estilo morado --}}
                <div class="card card-outline card-purple">
                    <div class="card-header">
                        <h3 class="card-title">Datos de: {{ $usuario->nombre }} {{ $usuario->apellido }}</h3>
                    </div>

                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">
                                {{-- Nombre --}}
                                <div class="form-group col-md-6">
                                    <label for="name">Nombre(s)</label>
                                    <input type="text" name="name" class="form-control" value="{{ $usuario->nombre }}" required>
                                </div>
                                {{-- Apellido --}}
                                <div class="form-group col-md-6">
                                    <label for="apellido">Apellido(s)</label>
                                    <input type="text" name="apellido" class="form-control" value="{{ $usuario->apellido }}" required>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Email --}}
                                <div class="form-group col-md-6">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
                                </div>
                                {{-- Teléfono --}}
                                <div class="form-group col-md-6">
                                    <label for="telefono">Teléfono de contacto</label>
                                    <input type="text" name="telefono" class="form-control" value="{{ $usuario->telefono }}">
                                </div>
                            </div>

                            {{-- Domicilio --}}
                            <div class="form-group">
                                <label for="domicilio">Domicilio de entrega (Jalisco)</label>
                                <textarea name="domicilio" class="form-control" rows="2">{{ $usuario->domicilio }}</textarea>
                            </div>

                            <div class="row">
                                {{-- Rol --}}
                                <div class="form-group col-md-6">
                                    <label for="rol">Rol del Sistema</label>
                                    <select name="rol" class="form-control">
                                        <option value="cliente" {{ $usuario->rol == 'cliente' ? 'selected' : '' }}>Cliente</option>
                                        <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    </select>
                                </div>
                                {{-- Estado --}}
                                <div class="form-group col-md-6">
                                    <label for="status">Estado de la cuenta</label>
                                    <select name="status" class="form-control">
                                        <option value="activo" {{ $usuario->status == 'activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="inactivo" {{ $usuario->status == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-purple text-white bg-purple">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Card informativo lateral --}}
            <div class="col-md-4">
                <div class="info-box bg-light border">
                    <span class="info-box-icon bg-purple"><i class="fas fa-info-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Última Actualización</span>
                        <span class="info-box-number">{{ $usuario->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
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
