
<!-- Navbar principale blanche -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm ">
    <div class="container">
        <a class="navbar-brand fw-bold text-teal" href="{{route('home')}}">Centre Deyloul pour les études Stratégiques</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{route('evenements.all')}}">Événements</a></li>
                <li class="nav-item"><a class="nav-link" href="#galerie">Galerie</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('videos.all')}}">Vidéos</a></li>
            </ul>
        </div>
    </div>
</nav>
