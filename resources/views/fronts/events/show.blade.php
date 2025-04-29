@extends('fronts.base')

@section('styles')
    <style>
        .event-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }
        .event-card {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        .card-header {
            background-color: #b47f99;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .card-body {
            padding: 30px;
        }
        .btn-outline-teal {
            border-color: #b47f99;
            color: #b47f99;
        }
        .btn-outline-teal:hover {
            background-color: #b47f99;
            color: white;
        }
    </style>
@endsection
@section('content')
    @php
        $locale = app()->getLocale();
        $titre = $locale == 'ar' ? $event->titre_ar : ($locale == 'en' ? $event->titre_en : $event->titre);
        $description = $locale == 'ar' ? $event->description_ar : ($locale == 'en' ? $event->description_en : $event->description);
    @endphp

    <div class="container py-5" style="margin-top: 80px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Card container -->
                <div class="card event-card">
                    <div class="card-header">
                        {{ __('messages.event_detail') }}
                        {{ $titre }}
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $event->image) }}"
                             alt="{{ $titre }}"
                             class="event-image mb-4">
                        <h2 class="mb-3" style="color: #b47f99;">{{ $titre }}</h2>
                        <p class="text-muted">{{ $description }}</p>

                        <a href="{{ url()->previous() }}" class="btn btn-outline-teal mt-4">{{ __('messages.back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
