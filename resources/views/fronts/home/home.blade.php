@extends('fronts.base')

@section('styles')
    <style>
        .bg-teal {
            background-color: #00796b !important;
        }

        .text-teal {
            color: #00796b;
        }

        .btn-teal {
            background-color: #00796b;
            color: white;
            border-radius: 25px;
        }

        .btn-teal:hover {
            background-color: #005a4f;
            color: #fff;
        }

        #textCarousel h4 {
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(50%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }

        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }


        .carousel-text {
            animation: fadeSlideUp 1s ease-in-out;
            font-size: 1.5rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Polices personnalisées */
        body {
            font-family: 'Poppins', sans-serif; /* Police principale */
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Roboto', sans-serif; /* Police pour les titres */
            font-weight: 600;
        }

        .text-teal {
            color: #633d80;
            font-family: 'Poppins', sans-serif;
        }

        .btn-teal {
            background-color: #633d80;
            color: white;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-teal:hover {
            background-color: #633d80;
            color: #fff;
        }

        /* Texte du carrousel */
        .carousel-text {
            animation: fadeSlideUp 1s ease-in-out;
            font-size: 1.5rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            font-family: 'Roboto', sans-serif; /* Police pour le texte du carrousel */
        }

        /* Animations */
        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }

        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        /* Améliorer l'apparence des sections */
        #centre {
            font-family: 'Poppins', sans-serif;
        }


        .gallery-scroll {
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
        }
        .gallery-scroll > div {
            scroll-snap-align: start;
        }

    </style>
@endsection

@section('content')

    <!-- À propos du centre -->
    @if($centre)

        <section id="centre" class="container mb-5 mt-4" style="margin-top: 20px">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    @if($centre->logo)
                        <img src="{{ asset('storage/' . $centre->logo) }}" class="img-fluid rounded shadow" alt="{{ __('messages.image_centre_alt') }}">
                    @else
                        <img src="{{ asset('assets/img/de.jpeg') }}" class="img-fluid rounded shadow" alt="{{ __('messages.image_centre_alt') }}">
                    @endif
                </div>
                <div class="col-md-6" data-aos="fade-left" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}; text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};">
                    <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-body">
                            <h2 class="text-teal fw-bold">
                                {{ app()->getLocale() == 'ar' ? $centre->nom_ar : (app()->getLocale() == 'en' ? $centre->nom_en : $centre->nom) }}
                            </h2>
                            <p class="lead text-muted">
                                {{ app()->getLocale() == 'ar' ? $centre->description_ar : (app()->getLocale() == 'en' ? $centre->description_en : $centre->description) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endif

    <!-- Événements -->
    <section id="evenements" class="py-5 bg-light">
        <div class="container">
            <h3 class="text-center text-teal mb-4">{{ __('messages.our_events') }}</h3>
            <div class="row g-4">
                @foreach($evenements as $event)
                    @php
                        $locale = app()->getLocale();
                        $titre = $locale == 'ar' ? $event->titre_ar : ($locale == 'en' ? $event->titre_en : $event->titre);
                        $description = $locale == 'ar' ? $event->description_ar : ($locale == 'en' ? $event->description_en : $event->description);
                    @endphp

                    <div class="col-md-4" data-aos="zoom-in">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $titre }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-teal">{{ $titre }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-end">
                                <a href="{{ route('evenements.show', $event->id) }}" class="btn btn-teal btn-sm">{{ __('messages.see_more') }}</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('evenements.all') }}" class="btn btn-teal btn-lg px-5">{{ __('messages.view_all_events') }}</a>
            </div>
        </div>
    </section>

    <!-- Galerie -->
    <section id="galerie" class="py-5 bg-white">
        <div class="container">
            <h3 class="text-center mb-4 text-teal">{{ __('messages.gallery') }}</h3>

            <div class="gallery-scroll d-flex overflow-auto pb-3">
                @foreach($galeries as $photo)
                    <div class="flex-shrink-0 me-3" style="width: 300px;" data-aos="fade-up">
                        <div class="card border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $photo->image_path) }}" class="card-img-top rounded" style="height: 200px; object-fit: cover;" alt="{{ __('messages.gallery_photo') }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Vidéos -->
    <section id="videos" class="py-5 bg-light">
        <div class="container">
            @php
                $locale = app()->getLocale();
            @endphp
            <h3 class="text-center mb-4 text-teal" style="direction: {{ $locale == 'ar' ? 'rtl' : 'ltr' }}; text-align: {{ $locale == 'ar' ? 'right' : 'left' }};">
                {{ __('messages.videos') }}
            </h3>

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
                                    </video>
                                @endif

                                <p class="mt-2 text-muted">{{ Str::limit($description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-end">
                                <a href="{{ route('videos.show', $video->id) }}" class="btn btn-teal btn-sm">
                                    {{ __('messages.view_detail') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Lien pour voir toutes les vidéos -->
            <div class="text-center mt-4">
                <a href="{{ route('videos.all') }}" class="btn btn-teal btn-lg px-5">
                    {{ __('messages.view_all_videos') }}
                </a>
            </div>
        </div>
    </section>



    <script>
        window.addEventListener('load', function () {
            var navbarHeight = document.querySelector('nav').offsetHeight; // récupère la hauteur de la navbar
            document.querySelector('.custom-carousel').style.marginTop = navbarHeight + 'px'; // applique la hauteur comme marge
        });

    </script>

@endsection
