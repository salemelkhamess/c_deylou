<!-- Navbar principale blanche -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm ">
    <div class="container">
        <a class="navbar-brand fw-bold text-teal" href="{{ route('home') }}">
            {{ __('messages.centre_name') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="{{ route('evenements.all') }}">{{ __('messages.events') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="#galerie">{{ __('messages.gallery') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="{{ route('videos.all') }}">{{ __('messages.videos') }}</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-4 align-items-center">

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('change.language', 'ar') }}">
                        <img src="{{ asset('assets/img/flags/mr.svg') }}" alt="عربي" width="24" class="me-1">
                        عربي
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('change.language', 'en') }}">
                        <img src="{{ asset('assets/img/flags/us.png') }}" alt="english" width="24" class="me-1">
                        English
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('change.language', 'fr') }}">
                        <img src="{{ asset('assets/img/flags/fr.png') }}" alt="Français" width="24" class="me-1">
                        Français
                    </a>
                </li>



            </ul>
        </div>
    </div>
</nav>
