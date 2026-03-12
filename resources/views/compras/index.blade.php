@extends('adminlte::page')

@section('title', 'Gestión de Compras')

@section('content')
<div class="card card-outline card-purple shadow">
    <div class="card-header">
        <h3 class="card-title text-purple font-weight-bold">Historial de Ventas </h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="bg-purple text-white">
                <tr>
                    <th>Folio</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Método de Pago</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compras as $compra)
                <tr>
                    <td>{{ $compra->folio_compra }}</td>
                    <td>{{ $compra->usuario->nombre }}</td>
                    <td>${{ number_format($compra->total_compra, 2) }}</td>
                    <td><span class="badge badge-info">{{ $compra->metodo_pago }}</span></td>
                    <td>{{ $compra->fecha_registro }}</td>
                    <td>
                        <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-purple text-white bg-purple">
                            <i class="fas fa-eye"></i> Ver Detalles
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

