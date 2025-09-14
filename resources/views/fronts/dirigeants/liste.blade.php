@extends('fronts.base')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-teal mb-5">{{ __('messages.our_team') }}</h2>

            <div class="row g-4">
                @foreach($dirigeants as $dirigeant)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 h-100">
                            @if($dirigeant->photo)
                                <img src="{{ asset('storage/'.$dirigeant->photo) }}" class="card-img-top" alt="{{ $dirigeant->nom }}" style="height: 250px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/img/default-profile.jpg') }}" class="card-img-top" alt="Photo par défaut" style="height: 250px; object-fit: cover;">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title text-teal">{{ $dirigeant->prenom }} {{ $dirigeant->nom }}</h5>
                                <p class="text-muted">
                                    <i class="fa fa-envelope me-2"></i> {{ $dirigeant->email }}
                                </p>
                            </div>

                            <div class="card-footer bg-white border-0">
                                <a href="{{ route('equipe.details', $dirigeant->id) }}" class="btn btn-teal w-100">
                                    <i class="fa fa-eye me-1"></i> {{ __('messages.view_profile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
