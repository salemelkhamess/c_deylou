<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDPES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;600&display=swap" rel="stylesheet">




    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/de.jpeg') }}">

    <style>
        .gallery img:hover { transform: scale(1.05); transition: .3s; }
        .carousel-item img { height: 500px; object-fit: cover; }

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



    </style>

    @yield('styles')



</head>
<body>
@include('fronts.nav')

<div class="container mt-4">
    @yield('content')
</div>

<footer class="bg-dark text-white text-center py-5 mt-5">
    <div class="container">
        <!-- Message de droits d'auteur -->
        <p class="mb-4">&copy; {{ date('Y') }} Centre Culturel. Tous droits réservés.</p>

        <!-- Mini navbar pour les réseaux sociaux -->
        <div class="social-icons">
            <a href="#" class="me-3 text-white fs-4">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="#" class="me-3 text-white fs-4">
                <i class="fa fa-twitter"></i>
            </a>
            <a href="#" class="me-3 text-white fs-4">
                <i class="fa fa-instagram"></i>
            </a>
            <a href="#" class="text-white fs-4">
                <i class="fa fa-youtube"></i>
            </a>
        </div>

        <!-- Ligne de séparation -->
        <hr class="my-4" style="border-color: #444;">

        <!-- Contact et informations supplémentaires -->
        <div class="row">
            <div class="col-md-6">
                <p>Pour plus d'informations, contactez-nous à <a href="mailto:contact@centre.com" class="text-white">contact@centre.com</a></p>
            </div>
            <div class="col-md-6">
                <p><a href="#" class="text-white">Politique de confidentialité</a> | <a href="#" class="text-white">Conditions d'utilisation</a></p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>
</html>
