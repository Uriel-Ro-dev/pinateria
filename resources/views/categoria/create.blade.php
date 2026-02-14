@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Crear Nueva Categoría</h2>
    </div>
    <div class="row">
        <form action="{{ route('categorias.store') }}" method="post" class="col-lg-7">
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
                <label for="nombre">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                       placeholder="Ej: Infantiles, Bodas, Temporada"
                       value="{{old('nombre')}}" required />
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción (Opcional)</label>
                <textarea class="form-control" id="descripcion" name="descripcion"
                          rows="3" placeholder="Describe qué tipo de piñatas entran aquí">{{old('descripcion')}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Crear Categoría</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-default">Regresar</a>
        </form>
    </div>
</div>
@endsection
