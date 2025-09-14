@extends('fronts.base')

@section('styles')
    <style>
        .dirigeant-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .dirigeant-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .dirigeant-img {
            height: 250px;
            object-fit: cover;
            object-position: top;
        }

        .badge-count {
            background-color: #633d80;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .section-title {
            position: relative;
            margin-bottom: 50px;
        }

        .section-title:after {
            content: "";
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #633d80;
        }
    </style>
@endsection

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-teal mb-5 section-title">{{ __('messages.our_leaders') }}</h2>

            <div class="row g-4">
                @foreach($dirigeants as $dirigeant)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <div class="card dirigeant-card">
                            @if($dirigeant->photo)
                                <img src="{{ asset('storage/' . $dirigeant->photo) }}" class="card-img-top dirigeant-img" alt="{{ $dirigeant->prenom }} {{ $dirigeant->nom }}">
                            @else
                                <img src="{{ asset('assets/img/default-profile.jpg') }}" class="card-img-top dirigeant-img" alt="Default profile">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title text-teal">{{ $dirigeant->prenom }} {{ $dirigeant->nom }}</h5>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-envelope me-2"></i> {{ $dirigeant->email }}<br>
                                    <i class="fas fa-phone me-2"></i> {{ $dirigeant->telephone }}
                                </p>

                                <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">
                                <i class="fas fa-graduation-cap me-1"></i>
                                <span class="badge-count">{{ $dirigeant->diplomes_count }}</span>
                            </span>
                                    <span class="text-muted">
                                <i class="fas fa-briefcase me-1"></i>
                                <span class="badge-count">{{ $dirigeant->experiences_count }}</span>
                            </span>
                                    <span class="text-muted">
                                <i class="fas fa-star me-1"></i>
                                <span class="badge-count">{{ $dirigeant->competences_count }}</span>
                            </span>
                                </div>

                                <a href="{{ route('dirigeants.show', $dirigeant->id) }}" class="btn btn-teal w-100">
                                    <i class="fas fa-eye me-1"></i> {{ __('messages.view_details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
