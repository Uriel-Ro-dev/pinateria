@extends('adminlte::page')

@section('title', 'Detalle del Recurso - Piñatería')

@section('content_header')
    <h1>Visualizar Recurso Multimedia</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-video mr-1"></i>
                        {{ $asset->title }}
                    </h3>
                </div>
                <div class="card-body text-center bg-dark">
                    <video width="100%" height="auto" controls autoplay muted class="img-fluid shadow">
                        <source src="{{ route('fileVideo', $asset->video_path) }}" type="video/mp4" />
                        Tu navegador no es compatible con HTML5.
                    </video>
                </div>
                <div class="card-footer">
                    <p class="text-muted">
                        <strong>Archivo de video:</strong> {{ $asset->video_path }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Detalles de la Piñata</h3>
                </div>
                <div class="card-body">
                    <label>Miniatura (Imagen):</label>
                    <img class="img-thumbnail d-block mb-3"
                         src="{{ route('imageVideo', $asset->image) }}"
                         alt="{{ $asset->title }}"
                         style="max-height: 200px;">

                    <hr>

                    <strong><i class="fas fa-birthday-cake mr-1"></i> Piñata Asociada:</strong>
                    <p class="text-muted">
                        {{ $asset->pinata->nombre ?? 'Sin piñata asignada' }}
                    </p>

                    <strong><i class="far fa-calendar-alt mr-1"></i> Fecha de subida:</strong>
                    <p class="text-muted">{{ $asset->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('asset.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left"></i> Volver a la lista
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
