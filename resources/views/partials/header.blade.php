<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="" class="logo">
{{--            <img src="{{asset('assets/img/AA+.svg')}}" width="40" height="40" alt="">--}}
Booking app        </a>
    </div>
    <!-- /Logo -->

    <a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
    </a>

    <!-- Header Title -->
    <div class="page-title-box">
        <h3> Paneau Administrateur </h3>
    </div>
    <!-- /Header Title -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

    <!-- Header Menu -->
    <ul class="nav user-menu">

        <!-- Search -->
        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="">
                    <input class="form-control" type="text" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </li>
        <!-- /Search -->

        <!-- Flag -->
{{--        <li class="nav-item dropdown has-arrow flag-nav">--}}
{{--            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">--}}
{{--                <img src="assets/img/flags/us.png" alt="" height="20"> <span>English</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu dropdown-menu-right">--}}
{{--                <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                    <img src="assets/img/flags/us.png" alt="" height="16"> English--}}
{{--                </a>--}}
{{--                <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                    <img src="assets/img/flags/fr.png" alt="" height="16"> French--}}
{{--                </a>--}}
{{--                <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                    <img src="assets/img/flags/es.png" alt="" height="16"> Spanish--}}
{{--                </a>--}}
{{--                <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                    <img src="assets/img/flags/de.png" alt="" height="16"> German--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </li>--}}
        <!-- /Flag -->

        <!-- Notifications -->
{{--        <li class="nav-item dropdown">--}}
{{--            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
{{--                <i class="fa fa-bell-o"></i> <span class="badge badge-pill"></span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu notifications">--}}
{{--                <div class="topnav-dropdown-header">--}}
{{--                    <span class="notification-title">Notifications</span>--}}
{{--                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>--}}
{{--                </div>--}}
{{--                <div class="noti-content">--}}
{{--                    <ul class="notification-list">--}}
{{--                        <li class="notification-message">--}}

{{--                            <ul class="list-group">--}}

{{--                            </ul>--}}

{{--                            --}}{{--                            @if (count($notifications) > 0)--}}
{{--                                <ul class="list-group">--}}
{{--                                    @foreach ($notifications as $notification)--}}
{{--                                        <li class="list-group-item">--}}
{{--                                            @if ($notification->type === 'App\Notifications\OrderAccepted')--}}
{{--                                                Votre commande {{ $notification->data['order_id'] }} a été acceptée !--}}
{{--                                            @endif--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            @else--}}
{{--                                <p>Aucune notification pour l'instant.</p>--}}
{{--                            @endif--}}
{{--                            <a href="activities.html">--}}
{{--                                <div class="media">--}}
{{--												<span class="avatar">--}}
{{--													<img alt="" src="assets/img/profiles/avatar-02.jpg">--}}
{{--												</span>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <p class="noti-details"><span class="noti-title">Admin</span> added new task <span class="noti-title">Patient appointment booking</span></p>--}}
{{--                                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}

{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </div>--}}

{{--                <div class="topnav-dropdown-footer">--}}
{{--                    <a href="">View all Notifications</a>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </li>--}}
        <!-- /Notifications -->

        <!-- Message Notifications -->
{{--        <li class="nav-item dropdown">--}}
{{--            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
{{--                <i class="fa fa-comment-o"></i> <span class="badge badge-pill">8</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu notifications">--}}
{{--                <div class="topnav-dropdown-header">--}}
{{--                    <span class="notification-title">Messages</span>--}}
{{--                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>--}}
{{--                </div>--}}
{{--                <div class="noti-content">--}}
{{--                    <ul class="notification-list">--}}
{{--                        <li class="notification-message">--}}
{{--                            <a href="chat.html">--}}
{{--                                <div class="list-item">--}}
{{--                                    <div class="list-left">--}}
{{--													<span class="avatar">--}}
{{--														<img alt="" src="{{asset('assets')}}/img/profiles/avatar-09.jpg">--}}
{{--													</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="list-body">--}}
{{--                                        <span class="message-author">Richard Miles </span>--}}
{{--                                        <span class="message-time">12:28 AM</span>--}}
{{--                                        <div class="clearfix"></div>--}}
{{--                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="notification-message">--}}
{{--                            <a href="chat.html">--}}
{{--                                <div class="list-item">--}}
{{--                                    <div class="list-left">--}}
{{--													<span class="avatar">--}}
{{--														<img alt="" src="assets/img/profiles/avatar-02.jpg">--}}
{{--													</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="list-body">--}}
{{--                                        <span class="message-author">Admin</span>--}}
{{--                                        <span class="message-time">6 Mar</span>--}}
{{--                                        <div class="clearfix"></div>--}}
{{--                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="notification-message">--}}
{{--                            <a href="chat.html">--}}
{{--                                <div class="list-item">--}}
{{--                                    <div class="list-left">--}}
{{--													<span class="avatar">--}}
{{--														<img alt="" src="assets/img/profiles/avatar-03.jpg">--}}
{{--													</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="list-body">--}}
{{--                                        <span class="message-author"> Tarah Shropshire </span>--}}
{{--                                        <span class="message-time">5 Mar</span>--}}
{{--                                        <div class="clearfix"></div>--}}
{{--                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="notification-message">--}}
{{--                            <a href="chat.html">--}}
{{--                                <div class="list-item">--}}
{{--                                    <div class="list-left">--}}
{{--													<span class="avatar">--}}
{{--														<img alt="" src="assets/img/profiles/AA+.svg">--}}
{{--													</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="list-body">--}}
{{--                                        <span class="message-author">Mike Litorus</span>--}}
{{--                                        <span class="message-time">3 Mar</span>--}}
{{--                                        <div class="clearfix"></div>--}}
{{--                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="notification-message">--}}
{{--                            <a href="chat.html">--}}
{{--                                <div class="list-item">--}}
{{--                                    <div class="list-left">--}}
{{--													<span class="avatar">--}}
{{--														<img alt="" src="assets/img/profiles/AA+.svg">--}}
{{--													</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="list-body">--}}
{{--                                        <span class="message-author"> Catherine Manseau </span>--}}
{{--                                        <span class="message-time">27 Feb</span>--}}
{{--                                        <div class="clearfix"></div>--}}
{{--                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="topnav-dropdown-footer">--}}
{{--                    <a href="chat.html">View all Messages</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </li>--}}
        <!-- /Message Notifications -->

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img src="assets/img/user.jpg" alt="">
							<span class="status online"></span></span>
                <span>{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="">Profile</a>
{{--                <a class="dropdown-item" href="">Settings</a>--}}
{{--                <a class="dropdown-item" href="">Deconnexion</a>--}}
                <!-- Authentication -->
                <form method="POST" action="{{route('logout')}}">
                    @csrf

                    <a class="dropdown-item" href=""
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
{{--                        {{ __('Log Out') }}--}}
                        Deconnexion
                    </a>
                </form>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href=""> Profile</a>
{{--            <a class="dropdown-item" href="">Settings</a>--}}
{{--            <a class="dropdown-item"  href="">Deconnexion</a>--}}
            <!-- Authentication -->
            <form method="POST" action="{{route('logout')}}">
                @csrf

                <a class="dropdown-item" href=""
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
{{--                    {{ __('Log Out') }}--}}
                    Deconnexion
                </a>
            </form>
        </div>
    </div>
    <!-- /Mobile Menu -->

</div>
