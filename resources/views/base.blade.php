<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">

    <title>Centre</title>


        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/de.jpeg') }}">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">

    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
    <link href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/dataTables.dataTables.min.css')}}" rel="stylesheet" type="text/css">


    <!-- Datetimepicker CSS -->
{{--
    <link rel="stylesheet" href="{{asset('assets')}}/css/bootstrap-datetimepicker.min.css">
--}}
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

{{--


    <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

       <!-- DataTables -->
       <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
--}}


        @yield('styles')

{{--    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->--}}
{{--    <!--[if lt IE 9]>--}}
{{--    <script src="{{asset('assets')}}/js/html5shiv.min.js"></script>--}}
{{--    <script src="{{asset('assets')}}/js/respond.min.js"></script>--}}
    <![endif]-->
</head>

<body>
<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Header -->
    @include('partials.header')
    <!-- /Header -->

    <!-- Sidebar -->
  @include('partials.sidebar')
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
{{--            <div class="page-header">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <h3 class="page-title">Welcome Admin!</h3>--}}
{{--                        <ul class="breadcrumb">--}}
{{--                            <li class="breadcrumb-item active">Dashboard</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- /Page Header -->

            @yield('content')

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{asset('assets')}}/js/jquery-3.5.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('assets')}}/js/popper.min.js"></script>
<script src="{{asset('assets')}}/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="{{asset('assets')}}/js/jquery.slimscroll.min.js"></script>


<!-- Custom JS -->
<script src="{{asset('assets')}}/js/select2.min.js"></script>
<script src="{{asset('assets')}}/js/app.js"></script>

<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->

<!-- Datetimepicker JS -->

<script src="{{asset('assets')}}/js/dataTables.min.js"></script>



@yield('scripts')

</body>
</html>
