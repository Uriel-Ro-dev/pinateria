@extends('adminlte::page')

@section('title', 'Moderación de Reseñas')

@section('content')
<div class="container-fluid">
    <div class="row pt-3">
        <div class="col-12">
            <h2 class="text-purple font-weight-bold">Moderación de Reseñas 🌟</h2>
            <hr>

            <div class="table-responsive">
                <table id="resenasTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Piñata</th>
                            <th>Estrellas</th>
                            <th>Comentario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resenas as $resena)
                        <tr>
                            <td>
                                <form action="{{ route('resenas.destroy', $resena->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta reseña?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $resena->id }}</td>
                            <td>{{ $resena->cliente->nombre }}</td> {{-- Relación con User --}}
                            <td>{{ $resena->pinata->nombre }}</td> {{-- Relación con Pinata --}}
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $resena->estrellas ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </td>
                            <td>{{ $resena->comentario }}</td>
                            <td>{{ $resena->fecha }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
