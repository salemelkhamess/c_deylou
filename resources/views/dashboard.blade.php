@extends('base')

@section('content')
    <div class="content container-fluid mt-5">

        <div class="card">
            <div class="card-header">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Tableau de bord de l'administration</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                <li class="breadcrumb-item active">Tableau de bord</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
            </div>
            <div class="card-body">

                <div class="row">
                    <!-- Centres -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $centres->count() }}</h3>
                                    <span>Total Centres</span>
                                </div>
                                <a href="{{ route('centres.index') }}" class="btn btn-primary btn-block">Voir les Centres</a>
                            </div>
                        </div>
                    </div>

                    <!-- Événements -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-calendar"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $evenements->count() }}</h3>
                                    <span>Total Événements</span>
                                </div>
                                <a href="{{ route('evenements.index') }}" class="btn btn-primary btn-block">Voir les Événements</a>
                            </div>
                        </div>
                    </div>

                    <!-- Galeries -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-image"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $galeries->count() }}</h3>
                                    <span>Total Galeries</span>
                                </div>
                                <a href="{{ route('galeries.index') }}" class="btn btn-primary btn-block">Voir les Galeries</a>
                            </div>
                        </div>
                    </div>

                    <!-- Vidéos -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-video"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $videos->count() }}</h3>
                                    <span>Total Vidéos</span>
                                </div>
                                <a href="{{ route('videos.index') }}" class="btn btn-primary btn-block">Voir les Vidéos</a>
                            </div>
                        </div>
                    </div>

                    <!-- Carrousels -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-image"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $carousels->count() }}</h3>
                                    <span>Total Carrousels</span>
                                </div>
                                <a href="{{ route('carousel.index') }}" class="btn btn-primary btn-block">Voir les Carrousels</a>
                            </div>
                        </div>
                    </div>

                    <!-- Liens sociaux -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-link"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $socialLinks->count() }}</h3>
                                    <span>Total Liens sociaux</span>
                                </div>
                                <a href="{{ route('social-links.index') }}" class="btn btn-primary btn-block">Voir les Liens</a>
                            </div>
                        </div>
                    </div>

                    <!-- Utilisateurs -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $users->count() }}</h3>
                                    <span>Total Utilisateurs</span>
                                </div>
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-block">Voir les Utilisateurs</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
