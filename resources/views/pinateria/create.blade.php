@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Agregar una nueva Piñata</h2>
    </div>
    <div class="row">
        <form action="{{ route('pinatas.store') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="nombre">Nombre de la Piñata</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{old('nombre')}}" required />
            </div>

            <div class="form-group">
                <label for="tamano">Tamaño</label>
                <input type="text" class="form-control" id="tamano" name="tamano" value="{{old('tamano')}}" placeholder="Ej: Grande, 80cm" required />
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{old('precio')}}" required />
            </div>

            <div class="form-group">
                <label for="stock">Stock (Cantidad)</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{old('stock')}}" required />
            </div>

            <div class="form-group">
                <label for="material">Material</label>
                <input type="text" class="form-control" id="material" name="material" value="{{old('material')}}" placeholder="Ej: Cartón, Papel China" required />
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="imagen_url">URL de la Imagen</label>
                <input type="text" class="form-control" id="imagen_url" name="imagen_url" value="{{old('imagen_url')}}" />
            </div>

            <button type="submit" class="btn btn-success">Guardar Piñata</button>
            <a href="{{ route('pinatas.index') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
</div>
@endsection
