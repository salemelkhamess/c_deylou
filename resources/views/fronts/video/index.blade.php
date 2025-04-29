@extends('fronts.base')

@section('styles')
    <style>
        .video-card {
            transition: transform 0.3s, box-shadow 0.3s ease-in-out;
            border-radius: 12px;
            overflow: hidden;
            background-color: #fff;
        }
        .video-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }
        .video-thumbnail {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .btn-teal {
            background-color: #c0ca8a;
            color: white;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-teal:hover {
            background-color: #c0ca8a;
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
        }
        .card-text {
            font-size: 0.95rem;
            color: #4b5563;
            margin-bottom: 10px;
        }
        .pagination .page-item.active .page-link {
            background-color: #c0ca8a;
            border-color: #c0ca8a;
        }
        .pagination .page-link {
            color: #c0ca8a;
            border: none;
            font-weight: bold;
        }
        .card-footer {
            background-color: transparent;
            border: none;
            text-align: center;
        }

        /* Style for the header */
        .header-section {
            background: linear-gradient(to right, #14b8a6, #c0ca8a);
            padding: 40px 0;
            color: white;
            border-radius: 10px;
            margin-bottom: 40px;
        }
        .header-section h2 {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
        }
        .header-section p {
            font-size: 1.1rem;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
@endsection


@section('content')
    @php
        $locale = app()->getLocale();
    @endphp

    <div class="container py-5" style="margin-top: 2px;">
        <!-- Header Section -->
        <div class="header-section">
            <h2>{{ __('messages.welcome_videos_gallery') }}</h2>
            <p>{{ __('messages.welcome_videos_subheader') }}</p>
        </div>

        <!-- Videos Section -->
        <h2 class="text-center text-teal mb-5">{{ __('messages.all_videos') }}</h2>

        <section id="videos" class="py-5 bg-light">
            <div class="container">
                <h3 class="text-center mb-4 text-teal">{{ __('messages.videos_section_title') }}</h3>
                <div class="row g-4">
                    @foreach($videos as $video)
                        @php
                            $titre = $locale == 'ar' ? $video->titre_ar : ($locale == 'en' ? $video->titre_en : $video->titre);
                            $description = $locale == 'ar' ? $video->description_ar : ($locale == 'en' ? $video->description_en : $video->description);
                        @endphp

                        <div class="col-md-6" data-aos="flip-left">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title text-teal">{{ $titre }}</h5>

                                    @if($video->type === 'youtube')
                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ $video->video_path }}" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    @else
                                        <video controls class="w-100 rounded">
                                            <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                            {{ __('messages.browser_not_support_video') }}
                                        </video>
                                    @endif

                                    <p class="mt-2 text-muted">{{ Str::limit($description, 100) }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-end">
                                    <a href="{{ route('videos.show', $video->id) }}" class="btn btn-teal btn-sm">{{ __('messages.view_detail') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $videos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    </div>
@endsection
