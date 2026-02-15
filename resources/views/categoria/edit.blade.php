@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Editar Categoría: {{ $categoria->nombre }}</h2>
        <form action="{{ route('categorias.update', $categoria->id) }}" method="post" class="col-lg-7">
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
                <label for="nombre">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required />
            </div>

            {{-- Campo Descripción --}}
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Actualizar Categoría</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
</div>
@stop
