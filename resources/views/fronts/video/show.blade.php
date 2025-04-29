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
    @php
        $locale = app()->getLocale();
        $titre = $locale === 'ar' ? $video->titre_ar : ($locale === 'en' ? $video->titre_en : $video->titre);
        $description = $locale === 'ar' ? $video->description_ar : ($locale === 'en' ? $video->description_en : $video->description);
    @endphp

    <div class="container py-5" style="margin-top: 80px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Card container -->
                <div class="card video-card">
                    <div class="card-header">
                        {{ __('messages.video_detail') }}
                    </div>
                    <div class="card-body">
                        <!-- Affichage de la vidéo -->
                        @if($video->type === 'youtube')
                            <div class="ratio ratio-16x9 mb-4">
                                <iframe src="{{ $video->video_path }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @else
                            <video class="video-player mb-4" controls>
                                <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                {{ __('messages.browser_not_support_video') }}
                            </video>
                        @endif

                        <!-- Titre et description -->
                        <h2 class="mb-3 text-teal">{{ $titre }}</h2>
                        <p class="text-muted">{{ $description }}</p>

                        <!-- Bouton retour à la liste -->
                        <a href="{{ route('videos.all') }}" class="btn btn-outline-teal mt-4">{{ __('messages.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
