@extends('adminlte::page')

@section('title', 'Detalle de Venta - Piñatería Piña')

@section('content')
<div class="container-fluid pt-3">
    <div class="row">
        {{-- Información General del Pedido --}}
        <div class="col-md-4">
            <div class="card card-outline card-purple shadow">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">Información del Cliente</h3>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $compra->usuario->nombre }}</p>
                    <p><strong>Correo:</strong> {{ $compra->usuario->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $compra->usuario->telefono ?? 'No registrado' }}</p>
                    <hr>
                    <p><strong>Folio:</strong> <span class="badge badge-purple">{{ $compra->folio_compra }}</span></p>
                    <p><strong>Método de Pago:</strong> {{ $compra->metodo_pago }}</p>
                    <p><strong>Fecha de Venta:</strong> {{ $compra->fecha_registro }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('compras.index') }}" class="btn btn-secondary btn-block">Volver al Historial</a>
                </div>
            </div>
        </div>

        {{-- Desglose de Piñatas Compradas --}}
        <div class="col-md-8">
            <div class="card card-outline card-purple shadow">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">Productos en este Pedido</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="bg-purple text-white">
                            <tr>
                                <th>Piñata</th>
                                <th class="text-center">Cantidad recibida</th>
                                <th class="text-right">Precio Unitario</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($compra->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->pinata->nombre }}</td>
                                <td class="text-center">{{ $detalle->cantidad_recibida }}</td>
                                <td class="text-right">${{ number_format($detalle->costo_unitario, 2) }}</td>
                                <td class="text-right">${{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="3" class="text-right">Total Final:</th>
                                <th class="text-right text-purple" style="font-size: 1.2rem;">
                                    ${{ number_format($compra->total_compra, 2) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .text-purple { color: #8c43f6; }
    .bg-purple { background-color: #8c43f6 !important; }
    .card-purple.card-outline { border-top: 3px solid #8c43f6; }
</style>
@endsection
