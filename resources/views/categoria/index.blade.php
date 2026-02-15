@extends('adminlte::page')

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="row">
            <h2>Gestión de Categorías</h2>
            <hr>
            <p align="right">
                <a href="{{ route('categorias.create') }}" class="btn btn-success">
                    <i class="fas fa-folder-plus"></i> Nueva Categoría
                </a>
                <a href="{{ route('home') }}" class="btn btn-primary">Regresar</a>
            </p>

            <div class="table-responsive">
                <table id="categoriasTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td>
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmarBorradoCat('{{ $categoria->id }}', '{{ $categoria->nombre }}')"
                                    data-toggle="modal" data-target="#deleteCatModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion ?? 'Sin descripción' }}</td>
                            <td>
                                @if($categoria->activo == 1)
                                    <span class="badge badge-success">Activa</span>
                                @else
                                    <span class="badge badge-danger">Inactiva</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCatModal" tabindex="-1" aria-labelledby="deleteCatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteCatModalLabel">Desactivar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas desactivar la categoría: <strong id="nombreCategoria"></strong>?
                    <br><small class="text-muted">Nota: Esto no borrará las piñatas asociadas, pero la categoría ya no aparecerá como opción.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="" id="btnConfirmarBorrarCat" class="btn btn-danger">Desactivar</a>
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

    <script>
        function confirmarBorradoCat(id, nombre) {
            $('#nombreCategoria').html(nombre);
            let url = "{{ route('deleteCategoria', ':id') }}";
            url = url.replace(':id', id);
            document.getElementById('btnConfirmarBorrarCat').href = url;
        }

        $(document).ready(function() {
            $('#categoriasTable').DataTable({
                "pageLength": 10,
                "order": [[1, "asc"]],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                responsive: true,
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'pdf']
            });
        });
    </script>
@endsection





