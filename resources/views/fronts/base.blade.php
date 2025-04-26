<!DOCTYPE html>
<html lang="fr">
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

        .carousel-inner img {
            height: 250px; /* par exemple */
            object-fit: fill;
        }

        .carousel-caption h5,
        .carousel-caption p {
            color: black; /* Texte en noir */
        }

    </style>

    @yield('styles')



</head>
<body style="background-color: #82efef">
@include('fronts.nav')


<div class="container mt-4">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('assets/img/de.jpeg') }}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>مركز ديلول</h5>
                    <p>تعريف مركز ديلول مركز ديلول للدراسات والبحوث الاستراتيجية هو مؤسسة فكرية مستقلة، يقودها نخبة من الضباط السابقين والخبراء المدنيين، وقد تم ترخيصه رسميًا بتاريخ 03 يونيو 2024 تحت رقم fA 010000242805202408687.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('assets/img/de.jpeg') }}" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>مركز ديلول</h5>
                    <p>تأسس المركز استجابة لحاجة ملحة إلى بلورة رؤى استراتيجية تُعلي من شأن الدولة وتعيد الاعتبار للبعد الوطني، في بيئة تتشابك فيها التحديات الداخلية بالتحولات الإقليمية والدولية. ويتخذ من التحليل العميق والمقاربة متعددة الأبعاد أدواتٍ لفهم الواقع واستشراف المستقبل، ضمن منظور يعزز الأمن والتنمية والاستقرار.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('assets/img/de.jpeg') }}" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>مركز ديلول</h5>
                    <p>ويعمل المركز على تحقيق جملة من الأهداف الاستراتيجية، من أبرزها: ردم الفجوات النفسية والاجتماعية بين مكونات الشعب الموريتاني، وتعزيز ثقافة الانتماء للوطن الجامع بعيدًا عن مظاهر التشرذم والانقسام. تعزيز التقارب الإقليمي بين نُظُم الأعضاء، انطلاقًا من منطق التعاون والتكامل لا التنازع والتنافس، بما يخدم المصلحة الجماعية ويؤسس لتنمية مستدامة. ترسيخ ثقافة السلم والسلام في المنطقة والعالم، من خلال النقاش وتبادل الآراء بين الخبراء وأصحاب الفكر والرأي، تأكيدًا على أن السلام هو الأساس لأي نهضة أو استقرار. بناء منصة تفكير مستقلة ومسؤولة تُسهم في صناعة القرار الاستراتيجي، وترسيخ مفاهيم التكامل بين الدولة والمجتمع، والأمن والتنمية، في أفق إنساني مشترك. يسعى مركز ديلول لأن يكون مرجعًا موثوقًا في مجاله، وجسرًا يربط بين النخب وصنّاع القرار، وبين الحاضر الطموح والمستقبل الممك</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
