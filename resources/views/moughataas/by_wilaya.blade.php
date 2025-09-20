@extends('fronts.base')

@section('styles')
    <style>
        /* Import Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --deep-blue: #1a2a44;
            --medium-blue: #0d1b2e;
            --white: #ffffff;
            --gold: #ffd700;
            --dark: #2d3748;
            --light-gray: #f1f5f9;
            --shadow: rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #e2e8f0 100%);
            color: var(--dark);
            line-height: 1.6;
        }

        /* Main Container */
        .moughataa-wrapper {
            min-height: 100vh;
            padding: 20px 0;
        }

        /* Luxury Hero Section */
        .luxury-hero {
            position: relative;
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--medium-blue) 100%);
            color: var(--white);
            padding: 100px 0;
            margin-bottom: 80px;
            overflow: hidden;
        }

        .luxury-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 215, 0, 0.05) 0%, transparent 50%);
            animation: luxuryFloat 8s ease-in-out infinite;
        }

        @keyframes luxuryFloat {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(20px, -20px) rotate(1deg); }
        }

        .luxury-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(180deg, transparent 0%, var(--light-gray) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            letter-spacing: -0.02em;
        }

        .hero-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            animation: goldLine 2s ease-in-out infinite alternate;
        }

        @keyframes goldLine {
            from { width: 60px; opacity: 0.7; }
            to { width: 120px; opacity: 1; }
        }

        .hero-population {
            font-size: 1.3rem;
            font-weight: 300;
            opacity: 0.9;
            margin-top: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .population-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--gold), #ffed4a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--deep-blue);
            font-size: 1.2rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Elegant Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--deep-blue);
            margin-bottom: 15px;
            position: relative;
        }

        .events-counter {
            display: inline-block;
            background: linear-gradient(135deg, var(--gold), #ffed4a);
            color: var(--deep-blue);
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            margin-left: 15px;
            box-shadow: 0 8px 16px rgba(255, 215, 0, 0.3);
            animation: counterGlow 3s ease-in-out infinite;
        }

        @keyframes counterGlow {
            0%, 100% { box-shadow: 0 8px 16px rgba(255, 215, 0, 0.3); }
            50% { box-shadow: 0 12px 24px rgba(255, 215, 0, 0.5); }
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #64748b;
            font-weight: 400;
        }

        /* Premium Events Grid */
        .events-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }

        /* Luxury Event Card */
        .luxury-event-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow:
                0 10px 30px var(--shadow),
                0 1px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-origin: center;
        }

        .luxury-event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--deep-blue), var(--gold), var(--deep-blue));
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.6s ease;
            z-index: 3;
        }

        .luxury-event-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(26, 42, 68, 0.1);
        }

        .luxury-event-card:hover::before {
            transform: scaleX(1);
        }

        /* Event Image Container */
        .event-image-container {
            position: relative;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--light-gray), #e2e8f0);
        }

        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
            filter: brightness(0.9);
        }

        .luxury-event-card:hover .event-image {
            transform: scale(1.1);
            filter: brightness(1);
        }

        .event-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--light-gray), #e2e8f0);
        }

        .event-placeholder i {
            font-size: 3rem;
            color: #94a3b8;
        }

        .event-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                180deg,
                rgba(26, 42, 68, 0.1) 0%,
                rgba(26, 42, 68, 0.3) 100%
            );
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .luxury-event-card:hover .event-overlay {
            opacity: 1;
        }

        /* Event Date Badge */
        .event-date-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(26, 42, 68, 0.95);
            backdrop-filter: blur(10px);
            color: var(--white);
            padding: 12px 18px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 2;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        .date-icon {
            color: var(--gold);
            font-size: 1.1rem;
        }

        /* Event Content */
        .event-content {
            padding: 35px;
            position: relative;
        }

        .event-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--deep-blue);
            margin-bottom: 15px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .event-description {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 25px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Premium Button */
        .luxury-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--deep-blue), var(--medium-blue));
            color: var(--white);
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .luxury-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--gold), #ffed4a);
            transition: left 0.4s ease;
            z-index: -1;
        }

        .luxury-btn:hover {
            color: var(--deep-blue);
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(26, 42, 68, 0.3);
            border-color: var(--gold);
        }

        .luxury-btn:hover::before {
            left: 0;
        }

        .btn-arrow {
            transition: transform 0.3s ease;
        }

        .luxury-btn:hover .btn-arrow {
            transform: translateX(5px);
        }

        /* Empty State */
        .no-events-luxury {
            text-align: center;
            padding: 80px 40px;
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--shadow);
            max-width: 500px;
            margin: 0 auto;
        }

        .no-events-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--light-gray), #e2e8f0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #94a3b8;
            margin: 0 auto 25px;
        }

        .no-events-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--deep-blue);
            margin-bottom: 10px;
        }

        .no-events-text {
            color: #64748b;
            font-size: 1.1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .hero-population {
                flex-direction: column;
                gap: 10px;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .events-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .event-content {
                padding: 25px;
            }

            .luxury-hero {
                padding: 80px 0;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Loading Animation */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .luxury-event-card:nth-child(1) { animation-delay: 0.1s; }
        .luxury-event-card:nth-child(2) { animation-delay: 0.2s; }
        .luxury-event-card:nth-child(3) { animation-delay: 0.3s; }
        .luxury-event-card:nth-child(4) { animation-delay: 0.4s; }
        .luxury-event-card:nth-child(5) { animation-delay: 0.5s; }
        .luxury-event-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
@endsection

@section('content')
    @php $locale = app()->getLocale(); @endphp

    <div class="moughataa-wrapper">

        <!-- Luxury Hero Section -->
        <section class="luxury-hero">
            <div class="hero-content">
                <h1 class="hero-title">
                    {{ $locale == 'ar' ? $moughataa->nom_ar : ($locale == 'en' ? $moughataa->nom_en : $moughataa->nom_fr) }}
                </h1>
                <div class="hero-population">
                    <div class="population-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <span>
                        {{ __('messages.population') }} :
                        {{ number_format($moughataa->population, 0, ',', ' ') }}
                    </span>
                </div>
            </div>
        </section>

        <!-- Events Section -->
        <div class="events-container">
            <div class="section-header">
                <h2 class="section-title">
                    {{ __('messages.events') }}
                    <span class="events-counter">{{ $moughataa->evenements->count() }}</span>
                </h2>
                <p class="section-subtitle">Découvrez les événements marquants de la région</p>
            </div>

            <div class="events-grid">
                @forelse($moughataa->evenements as $event)
                    @php
                        $titre = $locale == 'ar' ? $event->titre_ar : ($locale == 'en' ? $event->titre_en : $event->titre);
                        $description = $locale == 'ar' ? $event->description_ar : ($locale == 'en' ? $event->description_en : $event->description);
                    @endphp

                    <article class="luxury-event-card fade-in-up">
                        <div class="event-image-container">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}"
                                     class="event-image"
                                     alt="{{ $titre }}"
                                     loading="lazy"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="event-placeholder" style="display: none;">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            @else
                                <div class="event-placeholder">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            @endif
                            <div class="event-overlay"></div>
                            <div class="event-date-badge">
                                <i class="far fa-calendar-alt date-icon"></i>
                                {{ \Carbon\Carbon::parse($event->date_evenement)->translatedFormat('d M Y') }}
                            </div>
                        </div>

                        <div class="event-content">
                            <h3 class="event-title">{{ $titre }}</h3>
                            <p class="event-description">{{ Str::limit($description, 160) }}</p>

                            <a href="{{ route('evenements.show', $event->id) }}" class="luxury-btn">
                                {{ __('messages.view_detail') }}
                                <i class="fas fa-arrow-right btn-arrow"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="no-events-luxury fade-in-up">
                        <div class="no-events-icon">
                            <i class="far fa-calendar-times"></i>
                        </div>
                        <h3 class="no-events-title">Aucun événement</h3>
                        <p class="no-events-text">{{ __('messages.no_events') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            // Initialize scroll animations
            document.querySelectorAll('.fade-in-up').forEach(el => {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            });

            // Enhanced hover effects
            document.querySelectorAll('.luxury-event-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.zIndex = '10';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.zIndex = '1';
                });
            });
        });
    </script>
@endsection
