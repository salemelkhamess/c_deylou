<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDPES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;600&display=swap" rel="stylesheet">




    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/de.jpeg') }}">

    <style>

        .gallery img:hover { transform: scale(1.05); transition: .3s; }
        .carousel-item img { height: 500px; object-fit: fill; }

        html {
            scroll-behavior: smooth;
        }

        .gallery img {
            transition: transform 0.3s ease-in-out;
        }

        .gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .social-icons a:hover {
            color: #ffcc00; /* Change la couleur des icônes au survol */
            transform: scale(1.1); /* Légère augmentation de la taille au survol */
            transition: 0.3s ease;
        }
        [dir="rtl"] {
            font-family: 'Tajawal', sans-serif;
        }

        .carousel-inner img {
            height: 250px; /* par exemple */
            object-fit: fill;
        }

        .carousel-caption h5,
        .carousel-caption p {
            color: black; /* Texte en noir */
        }

        .carousel-inner {
            position: relative;
        }

        .carousel-image {
            position: relative;
            background-size: cover;
            background-position: center;
            height: 500px; /* Ajustez la hauteur selon vos besoins */
        }

        .carousel-caption {
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.6); /* Fond sombre transparent */
        }

        .text-overlay h5, .text-overlay p {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Ombre pour rendre le texte plus visible */
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5); /* Icones de contrôle plus visibles */
        }

    </style>

    @yield('styles')



</head>
<body style="background: linear-gradient(to right, #e9eec1, #c0ca8a ,#b4b6cc);">
@include('fronts.nav')


<div class="container mt-4">

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach(\App\Models\Carousel::all() as $index => $slide)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach(\App\Models\Carousel::all() as $index => $slide)
                @php
                    $locale = app()->getLocale();
                    $titre = $locale === 'ar' ? $slide->title_ar : ($locale === 'en' ? $slide->title_en : $slide->title_fr);
                    $description = $locale === 'ar' ? $slide->description_ar : ($locale === 'en' ? $slide->description_en : $slide->description_fr);
                    $direction = $locale === 'ar' ? 'rtl' : 'ltr';
                    $textAlign = $locale === 'ar' ? 'right' : 'left';
                @endphp

                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="carousel-image" style="background-image: url('{{ asset('storage/' . $slide->image_path) }}');">
                        <div class="carousel-caption d-none d-md-block text-overlay">
                            <h5 class="text-center" style="direction: {{ $direction }}; text-align: {{ $textAlign }};">{{ $titre }}</h5>
                            <p class="text-center" style="direction: {{ $direction }}; text-align: {{ $textAlign }};">{{ $description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('messages.previous') }}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('messages.next') }}</span>
        </button>
    </div>

    @yield('content')
</div>

<footer class="bg-dark text-white text-center py-5 mt-5">
    <div class="container">
        <!-- Message de droits d'auteur -->
        <p class="mb-4">&copy; {{ date('Y') }}
            {{ app()->getLocale() == 'ar' ? \App\Models\Centre::find(1)->nom_ar : \App\Models\Centre::find(1)->nom }}
            {{ __('messages.all_r') }}
        </p>

        <!-- Mini navbar pour les réseaux sociaux -->
        <div class="social-icons">
            @foreach(\App\Models\SocialLink::all() as $link)
                <a href="{{ $link->link }}" class="me-3 text-white fs-4" target="_blank">
                    <i class="fa fa-{{ strtolower($link->title) }}"></i>
                </a>
            @endforeach
        </div>


        <!-- Ligne de séparation -->
        <hr class="my-4" style="border-color: #444;">


    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
    var myCarousel = document.querySelector('#carouselExampleIndicators');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 2000, // temps entre slides (2 secondes ici)
        wrap: true      // permet de boucler à la fin
    });

</script>

</body>
</html>
