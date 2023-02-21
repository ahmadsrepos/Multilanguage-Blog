<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.2
 * @link http://coreui.io
 * Copyright (c) 2016 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
 <!DOCTYPE html>
<html lang="IR-fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <link rel="shortcut icon" href="{{asset('images/settings/'.$setting->favicon)}}"> -->

    <title>{{$setting->title}}</title>
    <!-- Icons -->
    <link href="{{asset('cp/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('cp/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{asset('cp/libs/fontawesome6.2.1/css/all.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{asset('cp/dest/style.css')}}" rel="stylesheet">
</head>
<body class="navbar-fixed sidebar-nav fixed-nav">
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <a class="navbar-brand" href="/dashboard">
                <img class="img-responsive img-fluid" src="{{asset('/images/settings/'.$setting->logo)}}" alt="">
            </a>
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-left upper-lang">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span>{{LaravelLocalization::getCurrentLocaleNative()}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach (LaravelLocalization::getSupportedLocales() as $lang => $inner)
                        <a class="dropdown-item text-center" href="{{LaravelLocalization::getLocalizedURL($lang)}}" style="text-align: center !important">{{$inner["native"]}}</a>  
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link aside-toggle" href="#"></a>
                </li>
            </ul>
        </div>
    </header>
    <div class="container-fluid lang-bar lower-lang">
        <ul class="nav navbar-nav pull-left">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span>{{LaravelLocalization::getCurrentLocaleNative()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach (LaravelLocalization::getSupportedLocales() as $lang => $inner)
                    <a class="dropdown-item text-center" href="{{LaravelLocalization::getLocalizedURL($lang)}}" style="text-align: center !important">{{$inner["native"]}}</a>  
                    @endforeach
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link aside-toggle" href="#"></a>
            </li>
        </ul>
    </div>
    @include('dashboard.layouts.sidebar')
    <!-- Main content -->
    
    <main class="main">
        @yield('content')
    </main>
    
    <footer class="footer">
        <span class="text-left">
            <a href="{{URL::to('/')}}">{{$setting->title}}</a> &copy; <script>document.write(new Date().getFullYear())</script> {{__('words.copyright')}}.
        </span>
    </footer>
    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('cp/js/libs/jquery.min.js')}}"></script>
    <script src="{{asset('cp/js/libs/tether.min.js')}}"></script>
    <script src="{{asset('cp/js/libs/bootstrap.min.js')}}"></script>
    <script src="{{asset('cp/js/libs/pace.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('cp/js/libs/Chart.min.js')}}"></script>

    <!-- CoreUI main scripts -->
    <script src="{{asset('cp/js/app.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- Plugins and scripts required by this views -->
    <!-- Custom scripts required by this view -->
    <script src="{{asset('cp/js/views/main.js')}}"></script>

    <!-- Grunt watch plugin -->
    <script src="//localhost:35729/livereload.js"></script>
{{--     <script>
        $(document).ready( function () {
            $('.datatableActivate').DataTable();
        } );
    </script> --}}
    @stack('js');
</body>
</html>