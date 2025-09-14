@extends('fronts.base')

@section('styles')
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 10;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #00ff00; /* Green for "B" */
        }
        .logo span {
            color: #fff; /* "flix" in white */
        }
        .search-bar {
            padding: 5px 10px;
            border-radius: 20px;
            border: none;
            background: #333;
            color: #fff;
        }
        .carousel {
            position: relative;
            height: 70vh; /* Reduced height to show full image */
            min-height: 500px; /* Minimum height to ensure content visibility */
            overflow: hidden;
        }
        .carousel-inner {
            position: relative;
            width: 100%;
            height: 100%;
        }
        .carousel-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .carousel-item.active {
            display: flex;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2); /* Reduced opacity for clearer image */
            z-index: 1;
        }
        .background-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures the image fits within the container */
            z-index: 0;
            opacity: 1; /* Full opacity for the image itself */
        }
        .movie-title {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
            z-index: 2;
        }
        .movie-details {
            font-size: 14px;
            margin-bottom: 20px;
            z-index: 2;
        }
        .movie-description {
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto 30px;
            z-index: 2;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            z-index: 2;
        }
        .btn-watch, .btn-favorite {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        .btn-watch {
            background-color: #007bff;
            color: #fff;
        }
        .btn-favorite {
            background-color: #ccc;
            color: #000;
        }
        .carousel-control-prev, .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            color: #fff;
            font-size: 24px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .carousel-control-prev {
            left: 20px;
        }
        .carousel-control-next {
            right: 20px;
        }
        .carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%); /* Ensures centering */
            z-index: 3;
            display: flex;
            gap: 10px;
            justify-content: center; /* Centers the indicators horizontally */
        }
        .carousel-indicator {
            width: 10px;
            height: 10px;
            background-color: #fff;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0.5;
        }
        .carousel-indicator.active {
            opacity: 1;
            background-color: #007bff;
        }
    </style>
@endsection

@section('content')

    <div class="carousel">
        <div class="carousel-inner">
            @foreach($evenements as $index => $event)
                @php
                    $locale = app()->getLocale();
                    $titre = $locale == 'ar' ? $event->titre_ar : ($locale == 'en' ? $event->titre_en : $event->titre);
                    $description = $locale == 'ar' ? $event->description_ar : ($locale == 'en' ? $event->description_en : $event->description);
                @endphp

                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $event->image) }}" class="background-img" alt="{{ $titre }}">
                    <div class="overlay"></div>
                    <h1 class="movie-title">{{ $titre }}</h1>
                    <div class="movie-details">{{ \Carbon\Carbon::parse($event->date)->format('d M, Y') }}</div>
                    <p class="movie-description">{{ Str::limit($description, 120) }}</p>
                    <div class="buttons">
                        <a href="{{ route('evenement.show', $event->id) }}" class="btn-watch">{{ __('messages.view_detail') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">❮</a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">❯</a>
        <div class="carousel-indicators">
            @for($i = 0; $i < count($evenements); $i++)
                <div class="carousel-indicator {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
            @endfor
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const totalSlides = slides.length;
        const prevBtn = document.querySelector('.carousel-control-prev');
        const nextBtn = document.querySelector('.carousel-control-next');
        const indicators = document.querySelectorAll('.carousel-indicator');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) slide.classList.add('active');
            });
            indicators.forEach((indicator, i) => {
                indicator.classList.remove('active');
                if (i === index) indicator.classList.add('active');
            });
            currentSlide = index;
        }

        prevBtn.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        });

        nextBtn.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        });

        indicators.forEach(indicator => {
            indicator.addEventListener('click', () => {
                const index = parseInt(indicator.getAttribute('data-index'));
                showSlide(index);
            });
        });

        // Auto-slide every 5 seconds
        setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }, 5000);
    </script>
@endsection
