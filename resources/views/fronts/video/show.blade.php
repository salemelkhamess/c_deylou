@extends('fronts.base')

@section('styles')
    <style>
        .video-player {
            width: 100%;
            height: 500px;
            border-radius: 15px;
            object-fit: cover;
        }
        .video-card {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        .card-header {
            background-color: #0d9488;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .card-body {
            padding: 30px;
        }
        .btn-outline-teal {
            border-color: #0d9488;
            color: #0d9488;
        }
        .btn-outline-teal:hover {
            background-color: #0d9488;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5" style="margin-top: 80px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Card container -->
                <div class="card video-card">
                    <div class="card-header">
                        Détail de la vidéo
                    </div>
                    <div class="card-body">
                        <video class="video-player mb-4" controls>
                            <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <h2 class="mb-3 text-teal">{{ $video->titre }}</h2>
                        <p class="text-muted">{{ $video->description }}</p>

                        <a href="{{ route('videos.all') }}" class="btn btn-outline-teal mt-4">← Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
