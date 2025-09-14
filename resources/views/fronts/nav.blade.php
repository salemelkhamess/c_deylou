<!-- Navbar -->
<!-- Header with Logo -->
<header class="main-header">
    <div class="container">
        <div class="logo-container">
            <div class="text-center">
                <h1 class="logo-text">PARTI MAURITANIEN DEMOCRATIQUE ET POPULAIRE</h1>

                <div class="arabic-text">  <h1> الحزب الموريتاني الديمقراطي الشعبي</h1> </div>
            </div>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark main-nav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('messages.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('evenements.all') }}">{{ __('messages.events') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#galerie">{{ __('messages.gallery') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('videos.all') }}">{{ __('messages.videos') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('equipe.liste') }}">{{ __('messages.our_leaders') }}</a>
                </li>
            </ul>

            <ul class="navbar-nav language-selector">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('change.language', 'ar') }}">
                        <img src="{{ asset('assets/img/flags/mr.svg') }}" alt="عربي" width="20" class="me-1">
                        عربي
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('change.language', 'en') }}">
                        <img src="{{ asset('assets/img/flags/us.png') }}" alt="English" width="20" class="me-1">
                        English
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('change.language', 'fr') }}">
                        <img src="{{ asset('assets/img/flags/fr.png') }}" alt="Français" width="20" class="me-1">
                        Français
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
