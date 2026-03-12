@extends('adminlte::page')
@section('title', 'Añadir Multimedia a Piñata')
@section('content_header')
    <h1>Añadir Multimedia a la Piñatería</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Subir imagen y video demostrativo</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('asset.store') }}" method="post" enctype="multipart/form-data" class="col-lg-8">
                @csrf
                @method('POST')

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error en el formulario</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="pinata_id">Seleccionar Piñata Relacionada</label>
                        @if(isset($selected_id))
                            {{-- Si venimos con un ID fijo, mostramos un input deshabilitado visualmente pero enviamos el valor --}}
                            <select name="pinata_id" id="pinata_id" class="form-control" style="background-color: #e9ecef; pointer-events: none;">
                                @foreach($pinatas as $pinata)
                                    <option value="{{ $pinata->id }}" selected>{{ $pinata->nombre }} (ID: {{ $pinata->id }})</option>
                                @endforeach
                            </select>
                            <small class="text-info">Estás añadiendo multimedia a una piñata específica.</small>
                        @else
                            {{-- El select normal por si entran directo al menú de assets --}}
                            <select name="pinata_id" id="pinata_id" class="form-control select2">
                                <option value="">-- Selecciona una piñata --</option>
                                @foreach($pinatas as $pinata)
                                    <option value="{{ $pinata->id }}">{{ $pinata->nombre }} (ID: {{ $pinata->id }})</option>
                                @endforeach
                            </select>
                        @endif
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="title">Nombre del recurso (Ej: Demo Piñata Estrella)</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Ingresa un título descriptivo" />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="image">Miniatura del Video (.jpg, .png)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">Elegir imagen...</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="video_path">Archivo de Vídeo (.mp4, .mov)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="video_path" name="video_path" accept="video/*">
                                <label class="custom-file-label" for="video_path">Elegir video...</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer mt-4">
                    <a href="{{ route('pinatas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success float-right">
                        <i class="fas fa-upload"></i> Subir a Galería
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
