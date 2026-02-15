@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Editar Piñata: {{ $pinata->nombre }}</h2>
        <form action="{{ route('pinatas.update', $pinata->id) }}" method="post" enctype="multipart/form-data" class="col-lg-7">
            @csrf
            @method('PUT')

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Campo Nombre --}}
            <div class="form-group">
                <label for="nombre">Nombre de la Piñata</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $pinata->nombre) }}" required />
            </div>

            {{-- Campo Tamaño --}}
            <div class="form-group">
                <label for="tamano">Tamaño</label>
                <input type="text" class="form-control" id="tamano" name="tamano" value="{{ old('tamano', $pinata->tamano) }}" />
            </div>

            {{-- Campo Precio --}}
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio', $pinata->precio) }}" required />
            </div>

            {{-- Campo Stock --}}
            <div class="form-group">
                <label for="stock">Stock (Cantidad)</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $pinata->stock) }}" required />
            </div>

            {{-- Campo Material --}}
            <div class="form-group">
                <label for="material">Material</label>
                <input type="text" class="form-control" id="material" name="material" value="{{ old('material', $pinata->material) }}" />
            </div>

            {{-- Selector de Categoría --}}
            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ (old('categoria_id', $pinata->categoria_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Campo URL Imagen --}}
            <div class="form-group">
                <label for="imagen_url">URL de la Imagen</label>
                <input type="text" class="form-control" id="imagen_url" name="imagen_url" value="{{ old('imagen_url', $pinata->imagen_url) }}" />
            </div>

            <button type="submit" class="btn btn-success">Actualizar Piñata</button>
            <a href="{{ route('pinatas.index') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
</div>
@endsection

