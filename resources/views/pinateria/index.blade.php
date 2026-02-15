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
            <h2>Inventario de Piñatas</h2>
            <hr>
            <p align="right">
                <a href="{{ route('pinatas.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Agregar Piñata
                </a>
                <a href="{{ route('home') }}" class="btn btn-primary">Regresar</a>
            </p>

            <div class="table-responsive">
                <table id="pinatasTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Tamaño</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinatas as $pinata)
                        <tr>
                            <td>
                                <a href="{{ route('pinatas.edit', $pinata->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmarBorrado('{{ $pinata->id }}', '{{ $pinata->nombre }}')"
                                    data-toggle="modal" data-target="#deleteModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            <td>{{ $pinata->id }}</td>
                            <td>{{ $pinata->nombre }}</td>
                            <td>${{ number_format($pinata->precio, 2) }}</td>
                            <td>{{ $pinata->stock }}</td>
                            <td>{{ $pinata->tamano }}</td>
                            <td>
                                @if($pinata->activo == 1)
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

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Desactivación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas desactivar la piñata: <strong id="nombrePinata"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="" id="btnConfirmarBorrar" class="btn btn-danger">Desactivar</a>
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
        // Función para preparar el modal de borrado
        function confirmarBorrado(id, nombre) {
            $('#nombrePinata').html(nombre);
            let url = "{{ route('deletePinata', ':id') }}";
            url = url.replace(':id', id);
            document.getElementById('btnConfirmarBorrar').href = url;
        }

        $(document).ready(function() {
            $('#pinatasTable').DataTable({
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
