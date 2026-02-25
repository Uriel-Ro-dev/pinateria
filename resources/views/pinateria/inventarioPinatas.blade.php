<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Reporte de Inventario - Piñatería</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .titulo { color: #e91e63; margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th { background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 10px; text-align: left; }
        td { border: 1px solid #dee2e6; padding: 8px; }
        tr:nth-child(even) { background-color: #fff5f8; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="titulo">Inventario General de Piñatas</h1>
        <p>{{$today}}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tamaño</th>
                <th>Material</th>
                <th class="text-center">Stock</th>
                <th class="text-right">Precio</th>
                <th class="text-center">Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pinatas as $pinata)
            <tr>
                <td><strong>{{ $pinata->nombre }}</strong></td>
                <td>{{ $pinata->tamano }}</td>
                <td>{{ $pinata->material }}</td>
                <td class="text-center">{{ $pinata->stock }}</td>
                <td class="text-right">${{ number_format($pinata->precio, 2) }}</td>
                <td class="text-center">
                    {{ $pinata->activo ? 'Activo' : 'Inactivo' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
