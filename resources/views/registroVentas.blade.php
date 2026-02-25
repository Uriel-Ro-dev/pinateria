<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .titulo { color: #2e86c1; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #2e86c1; color: white; padding: 10px; }
        td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        .total { font-weight: bold; color: #d35400; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="titulo">Registro Histórico de Ventas</h1>
        <p>Fecha de emisión: {{ $today }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Método de Pago</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
            <tr>
                <td>{{ $compra->folio_compra }}</td>
                <td>{{ $compra->nombre }} {{ $compra->apellido }}</td>
                <td>{{ \Carbon\Carbon::parse($compra->fecha_registro)->format('d/m/Y') }}</td>
                <td>{{ $compra->metodo_pago }}</td>
                <td class="total">${{ number_format($compra->total_compra, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
