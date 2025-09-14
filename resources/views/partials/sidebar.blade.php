<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="submenu">
                    <a><i class="la la-dashboard"></i> <span> Accueil</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a  href="{{route('admin.dashboard')}}" class="active" >Admin Accueil</a></li>

                    </ul>
                </li>


                <li>
                    <a href="{{ route('carousel.index') }}"><i class="fa fa-building"></i> <span>Entéte</span></a>
                </li>


                <li>
                    <a href="{{ route('centres.index') }}"><i class="fa fa-building"></i> <span>Partie</span></a>
                </li>

                <li>
                    <a href="{{ route('wilayas.index') }}"><i class="fa fa-building"></i> <span>Willaya</span></a>
                </li>


                <li>
                    <a href="{{ route('moughataas.index') }}"><i class="fa fa-building"></i> <span>Moughataas</span></a>
                </li>



                <li>
                    <a href="{{ route('participants.index') }}"><i class="fa fa-building"></i> <span>Participants</span></a>
                </li>

                <li>
                    <a href="{{ route('dirigeants.index') }}"><i class="fa fa-building"></i> <span>Dirigants</span></a>
                </li>

                <li>
                    <a href="{{ route('questions.index') }}"><i class="fa fa-building"></i> <span>Questions</span></a>
                </li>


                <li>
                    <a href="{{ route('evenements.index') }}"><i class="fa fa-calendar-o"></i> <span>Événements</span></a>
                </li>

                <li>
                    <a href="{{ route('galeries.index') }}"><i class="fa fa-image"></i> <span>Galerie</span></a>
                </li>

                <li>
                    <a href="{{ route('videos.index') }}"><i class="fa fa-video-camera"></i> <span>Vidéos</span></a>
                </li>

                <li>
                    <a href="{{ route('social-links.index') }}"><i class="fa fa-building"></i> <span>Réseau Sociaux</span></a>
                </li>


                <li class="submenu">
                        <a href="#"><i class="la la-cogs"></i> <span> Paramètres </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            <li><a href="{{route('users.index')}}"> Utilisateurs </a></li>

                        </ul>
                    </li>


            </ul>
        </div>
    </div>
</div>
