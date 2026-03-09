@extends('adminlte::page')

@section('title', 'Usuarios - Piñatería Piña')

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
    <style>
        .text-purple { color: #8c43f6; }
        .bg-purple { background-color: #8c43f6 !important; }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row pt-3">
            @if (session('status'))
                <div class="alert alert-success col-12">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="text-purple font-weight-bold">Gestión de Usuarios</h2>
                <hr>
                <p align="right">
                    <a href="{{ route('usuarios.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Agregar administrador
                </a>
                    <a href="{{ route('home') }}" class="btn btn-primary">Regresar</a>
                </p>

                <div class="table-responsive">
                    <table id="usuariosTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>ID</th>
                                <th>Nombre Completo</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Domicilio</th>
                                <th>Rol</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $user)
                            <tr>
                                <td>
                                    {{-- Botón Editar con tu estilo --}}
                                    <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- Botón Desactivar con tu estilo y modal --}}
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmarBorrado('{{ $user->id }}', '{{ $user->nombre }} {{ $user->apellido }}')"
                                        data-toggle="modal" data-target="#deleteModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->nombre }} {{ $user->apellido }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->telefono ?? 'N/A' }}</td>
                                <td>{{ $user->domicilio ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $user->rol == 'admin' ? 'bg-purple text-white' : 'badge-secondary' }}">
                                        {{ strtoupper($user->rol) }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->status == 'activo')
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Inactivo</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de Confirmación --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Desactivación de Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas desactivar al usuario: <strong id="nombreUsuario"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="formConfirmarBorrar" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Desactivar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>

    <script>
        function confirmarBorrado(id, nombre) {
            $('#nombreUsuario').html(nombre);
            // Ajustamos la ruta para que coincida con tu UsuarioController
            let url = "{{ route('usuarios.destroy', ':id') }}";
            url = url.replace(':id', id);
            $('#formConfirmarBorrar').attr('action', url);
        }

        $(document).ready(function() {
            $('#usuariosTable').DataTable({
                "pageLength": 10,
                "order": [[1, "asc"]],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Copiar',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger'
                    }
                ]
            });
        });
    </script>
@endsection
