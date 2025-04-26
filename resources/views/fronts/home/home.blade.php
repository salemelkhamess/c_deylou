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
            color: #00796b;
            font-family: 'Poppins', sans-serif;
        }

        .btn-teal {
            background-color: #00796b;
            color: white;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-teal:hover {
            background-color: #005a4f;
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




    </style>
@endsection

@section('content')

    <!-- Carousel -->
    <div id="textCarousel" class="carousel slide mb-5 mt-4" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner bg-teal text-white py-5 px-3 rounded shadow position-relative overflow-hidden">
            <div class="carousel-item active">
                <h4 class="carousel-text text-center mb-0">Bienvenue au centre Deyloul pour les études stratégiques</h4>
            </div>
            <div class="carousel-item">
                <h4 class="carousel-text text-center mb-0">Découvrez nos événements</h4>
            </div>
            <div class="carousel-item">
                <h4 class="carousel-text text-center mb-0">Rejoignez-nous pour un avenir meilleur</h4>
            </div>
        </div>
    </div>


    <!-- À propos du centre -->
    @if($centre)
        <section id="centre" class="container mb-5">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <img src="{{ asset('assets/img/de.jpeg') }}" class="img-fluid rounded shadow" alt="Image du centre">
                </div>
                <div class="col-md-6" data-aos="fade-left"
                   style="direction: rtl; text-align: right;" >
                    <h2 class="text-teal fw-bold"> {{ $centre->nom }}</h2>
                    <p class="lead text-muted">{{ $centre->description }}</p>
                </div>
            </div>
        </section>
    @endif


    <!-- Événements -->
    <section id="evenements" class="py-5 bg-light">
        <div class="container">
            <h3 class="text-center text-teal mb-4">Nos Événements</h3>
            <div class="row g-4">
                @foreach($evenements as $event)
                    <div class="col-md-4" data-aos="zoom-in">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->titre }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-teal">{{ $event->titre }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($event->description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-end">
                                <a href="#" class="btn btn-teal btn-sm">Voir plus</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-teal btn-lg px-5">Voir tous les événements</a>
            </div>
        </div>
    </section>

    <!-- Galerie -->
    <section id="galerie" class="py-5 bg-white">
        <div class="container">
            <h3 class="text-center mb-4 text-teal">Galerie</h3>
            <div class="row g-4">
                @foreach($galeries as $photo)
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="card border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $photo->image_path) }}" class="card-img-top rounded" style="height: 200px; object-fit: cover;" alt="Photo de la galerie">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Vidéos -->
    <section id="videos" class="py-5 bg-light">
        <div class="container">
            <h3 class="text-center mb-4 text-teal">Vidéos</h3>
            <div class="row g-4">
                @foreach($videos as $video)
                    <div class="col-md-6" data-aos="flip-left">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-teal">{{ $video->titre }}</h5>
                                @if($video->type === 'youtube')
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ $video->video_path }}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                @else
                                    <video controls class="w-100 rounded">
                                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                    </video>
                                @endif
                                <p class="mt-2 text-muted">{{ $video->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Lien pour voir toutes les vidéos -->
            <div class="text-center mt-4">
                <a href="" class="btn btn-teal">Voir toutes les vidéos</a>
            </div>
        </div>
    </section>

@endsection
