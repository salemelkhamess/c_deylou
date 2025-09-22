<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMD - Parti Mauritanien Démocratique et Populaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/l.jpeg') }}">
    <style>
        :root {
            --deep-blue: #1a365d;
            --medium-blue: #2c5282;
            --gold: #d4af37;
            --light-gold: #f0e6d2;
            --white: #ffffff;
            --light-gray: #f8f9fa;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--white);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--deep-blue);
        }

        [dir="rtl"] {
            font-family: 'Tajawal', sans-serif;
        }

        /* Header styles */
        .main-header {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--medium-blue) 100%);
            color: var(--white);
            padding: 15px 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            background-color: var(--white);
            border-bottom: 3px solid var(--gold);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.2rem;
            color: var(--deep-blue);
            text-align: center;
            margin: 0;
            padding: 15px 0;
        }

        .logo-text::after {
            content: "";
            display: block;
            width: 80px;
            height: 3px;
            background: var(--gold);
            margin: 10px auto;
        }

        .arabic-text {
            font-size: 1.8rem;
            color: var(--deep-blue);
            margin-bottom: 10px;
        }

        /* Navigation */
        .main-nav {
            background: var(--deep-blue);
            padding: 0;
        }

        .main-nav .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .main-nav .navbar-nav .nav-link::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--gold);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .main-nav .navbar-nav .nav-link:hover {
            color: var(--white) !important;
            background: rgba(255,255,255,0.05);
        }

        .main-nav .navbar-nav .nav-link:hover::before {
            width: 70%;
        }

        .language-selector .nav-link {
            display: flex;
            align-items: center;
            padding: 0.5rem 0.8rem;
            color: var(--white) !important;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 4px;
            margin-left: 0.5rem;
            transition: all 0.3s ease;
        }

        .language-selector .nav-link:hover {
            background: rgba(255,255,255,0.1);
            border-color: var(--gold);
        }

        /* Carousel */
        .hero-carousel {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 30px 0;
        }

        .carousel-image {
            height: 500px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .carousel-caption {
            background: rgba(26, 54, 93, 0.85);
            padding: 25px;
            border-radius: 8px;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            border-left: 4px solid var(--gold);
        }

        .carousel-caption h5 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: var(--white);
        }

        .carousel-caption p {
            color: var(--light-gold);
        }

        /* Cards */
        .elegant-card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }

        .elegant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }

        .elegant-card-header {
            background: linear-gradient(135deg, var(--deep-blue), var(--medium-blue));
            color: var(--white);
            padding: 20px 25px;
            font-size: 1.4rem;
            border-bottom: none;
        }

        .elegant-card-body {
            padding: 10px;
        }

        /* Vote Cards */
        .vote-card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .vote-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }

        .vote-card .card-header {
            background: linear-gradient(135deg, var(--deep-blue), var(--medium-blue));
            color: var(--white);
            border-bottom: none;
            padding: 15px 20px;
        }

        /* Buttons */
        .btn-gold {
            background: var(--gold);
            color: var(--deep-blue);
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background: #c19d2e;
            color: var(--deep-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-blue {
            background: var(--medium-blue);
            color: var(--white);
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-blue:hover {
            background: #254e7a;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Stats */
        .stats-section {
            background: var(--light-gray);
            padding: 60px 0;
            margin: 50px 0;
        }

        .stat-card {
            text-align: center;
            padding: 30px 20px;
            border-radius: 8px;
            background: var(--white);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--deep-blue);
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        .stat-label {
            font-size: 1rem;
            color: var(--medium-blue);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Footer */
        .political-footer {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--medium-blue) 100%);
            color: var(--white);
            padding: 50px 0 20px;
            margin-top: 50px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background: rgba(255,255,255,0.1);
            color: var(--white);
            border-radius: 50%;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: var(--gold);
            color: var(--deep-blue);
            transform: translateY(-3px);
        }

        /* Map */
        .map-container {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 30px 0;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease forwards;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .carousel-image {
                height: 400px;
            }

            .logo-text {
                font-size: 1.8rem;
            }

            .arabic-text {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .carousel-image {
                height: 300px;
            }

            .stat-number {
                font-size: 2rem;
            }

            .main-nav .navbar-nav .nav-link {
                padding: 0.8rem 1rem;
            }

            .logo-text {
                font-size: 1.5rem;
            }

            .arabic-text {
                font-size: 1.3rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
@include('fronts.nav')

<main>
    <div class="container mt-4">
        @yield('content')
    </div>
</main>

<footer class="political-footer">
    <div class="container">
        <!-- Message de droits d'auteur -->
        <p class="mb-4">&copy; {{ date('Y') }}
            {{ app()->getLocale() == 'ar' ? \App\Models\Centre::find(1)->nom_ar : \App\Models\Centre::find(1)->nom }}
            {{ __('messages.all_r') }}
        </p>

        <!-- Mini navbar pour les réseaux sociaux -->
        <div class="social-icons">
            @foreach(\App\Models\SocialLink::all() as $link)
                <a href="{{ $link->link }}" class="text-white" target="_blank">
                    <i class="fab fa-{{ strtolower($link->title) }}"></i>
                </a>
            @endforeach
        </div>

        <!-- Ligne de séparation -->
        <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
    var myCarousel = document.querySelector('#carouselExampleIndicators');
    if (myCarousel) {
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 4000,
            wrap: true
        });
    }
</script>
@yield('scripts')
</body>
</html>
