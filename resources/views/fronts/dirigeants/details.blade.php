@extends('fronts.base')

@section('styles')
    <style>
        .profile-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .profile-card {
            background: linear-gradient(135deg, #2a0845 0%, #633d80 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 15px 35px rgba(42, 8, 69, 0.2);
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
        }

        .profile-header {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }

        .profile-name {
            color: white;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .profile-contact {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        .contact-item {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .contact-item i {
            font-size: 1.1rem;
        }

        .content-grid {
            display: grid;
            gap: 2rem;
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr 1fr;
            }
            .section.full-width {
                grid-column: 1 / -1;
            }
        }

        .section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(42, 8, 69, 0.1);
            border: 1px solid rgba(99, 61, 128, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2a0845, #633d80);
        }

        .section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(42, 8, 69, 0.15);
        }

        .section-title {
            color: #2a0845;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            background: linear-gradient(135deg, #2a0845, #633d80);
            color: white;
            padding: 0.5rem;
            border-radius: 10px;
            font-size: 1rem;
        }

        .timeline-item {
            margin-bottom: 2rem;
            padding-left: 2rem;
            position: relative;
            border-left: 2px solid #f0f0f0;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: -6px;
            top: 8px;
            height: 12px;
            width: 12px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2a0845, #633d80);
            box-shadow: 0 0 0 3px white, 0 0 0 5px #f0f0f0;
        }

        .item-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2a0845;
            margin-bottom: 0.5rem;
        }

        .item-meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .item-meta i {
            color: #633d80;
            width: 16px;
        }

        .item-description {
            color: #555;
            line-height: 1.6;
            margin-top: 0.75rem;
            font-size: 0.95rem;
        }

        .skill {
            margin-bottom: 1.5rem;
        }

        .skill-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .skill-name {
            color: #2a0845;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .skill-value {
            color: #633d80;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .skill-level {
            height: 8px;
            background: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .skill-progress {
            height: 100%;
            background: linear-gradient(90deg, #2a0845, #633d80);
            border-radius: 10px;
            transition: width 0.8s ease;
            position: relative;
        }

        .skill-progress::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, #2a0845, #633d80);
            color: white;
            border-radius: 25px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 0.75rem;
            font-weight: 500;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(42, 8, 69, 0.3);
            color: white;
        }

        .empty-state {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 2rem;
            background: #f9f9f9;
            border-radius: 10px;
            border: 2px dashed #ddd;
        }

        /* Animations d'entrée */
        .section {
            animation: slideUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .section:nth-child(1) { animation-delay: 0.1s; }
        .section:nth-child(2) { animation-delay: 0.2s; }
        .section:nth-child(3) { animation-delay: 0.3s; }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-container {
                padding: 1rem;
            }

            .profile-card {
                padding: 2rem 1.5rem;
            }

            .profile-name {
                font-size: 1.8rem;
            }

            .profile-contact {
                flex-direction: column;
                gap: 1rem;
            }

            .section {
                padding: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="profile-container">
        <!-- En-tête avec gradient -->
        <div class="profile-card">
            <div class="profile-header">
                @if($dirigeant->photo)
                    <img src="{{ asset('storage/' . $dirigeant->photo) }}" class="profile-avatar" alt="{{ $dirigeant->prenom }} {{ $dirigeant->nom }}">
                @else
                    <img src="{{ asset('assets/img/default-profile.jpg') }}" class="profile-avatar" alt="Photo par défaut">
                @endif

                <h1 class="profile-name">{{ $dirigeant->prenom }} {{ $dirigeant->nom }}</h1>

                <div class="profile-contact">
                    <div class="contact-item">
                        <i class="fa fa-envelope"></i>
                        <span>{{ $dirigeant->email }}</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-phone"></i>
                        <span>{{ $dirigeant->telephone }}</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-map-marker"></i>
                        <span>{{ $dirigeant->adresse }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu en grille -->
        <div class="content-grid">
            <!-- Diplômes -->
            <div class="section">
                <h3 class="section-title">
                    <i class="fa fa-graduation-cap"></i>
                    Diplômes
                </h3>

                @forelse($dirigeant->diplomes as $diplome)
                    <div class="timeline-item">
                        <div class="item-title">{{ $diplome->titre }}</div>
                        <div class="item-meta">
                            <i class="fa fa-university"></i>
                            <span>{{ $diplome->etablissement }}</span>
                        </div>
                        <div class="item-meta">
                            <i class="fa fa-calendar"></i>
                            <span>{{ $diplome->annee_obtention }}</span>
                        </div>
                        @if($diplome->fichier)
                            <a href="{{ asset('storage/' . $diplome->fichier) }}" class="btn-download" target="_blank">
                                <i class="fa fa-download"></i>
                                Télécharger
                            </a>
                        @endif
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa fa-graduation-cap" style="font-size: 2rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <p>Aucun diplôme enregistré</p>
                    </div>
                @endforelse
            </div>

            <!-- Compétences -->
            <div class="section">
                <h3 class="section-title">
                    <i class="fa fa-star"></i>
                    Compétences
                </h3>

                @forelse($dirigeant->competences as $competence)
                    <div class="skill">
                        <div class="skill-header">
                            <div class="skill-name">{{ $competence->nom }}</div>
                            <div class="skill-value">{{ $competence->niveau }}/5</div>
                        </div>
                        <div class="skill-level">
                            <div class="skill-progress" style="width: {{ ($competence->niveau / 5) * 100 }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa fa-star" style="font-size: 2rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <p>Aucune compétence enregistrée</p>
                    </div>
                @endforelse
            </div>

            <!-- Expériences -->
            <div class="section full-width">
                <h3 class="section-title">
                    <i class="fa fa-briefcase"></i>
                    Expériences Professionnelles
                </h3>

                @forelse($dirigeant->experiences as $experience)
                    <div class="timeline-item">
                        <div class="item-title">{{ $experience->poste }}</div>
                        <div class="item-meta">
                            <i class="fa fa-building"></i>
                            <span>{{ $experience->entreprise }}</span>
                        </div>
                        <div class="item-meta">
                            <i class="fa fa-calendar"></i>
                            <span>
                                {{ $experience->date_debut->format('m/Y') }} -
                                @if($experience->date_fin)
                                    {{ $experience->date_fin->format('m/Y') }}
                                @else
                                    Aujourd'hui
                                @endif
                            </span>
                        </div>
                        @if($experience->description)
                            <p class="item-description">{{ $experience->description }}</p>
                        @endif
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa fa-briefcase" style="font-size: 2rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <p>Aucune expérience enregistrée</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
