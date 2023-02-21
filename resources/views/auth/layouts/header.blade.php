<header class="header-top bg-dark justify-content-between navigation-dark">
    <nav class="navbar navbar-expand-lg navigation ">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{asset('images/settings/'.$setting->logo)}}" alt="logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul id="menu" class="menu navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            Home
                        </a>
                    </li>
                    @foreach ($categories as $category)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{route('category', $category->id)}}" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{$category->title}}
                        </a>
                        @if($category->getChildren)
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($category->getChildren as $child)
                            <a class="dropdown-item" href="{{route('category', $child->id)}}">{{$child->title}}</a>
                        @endforeach
                        </div>
                        @endif
                    </li>
                    @endforeach

                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{LaravelLocalization::getCurrentLocaleNative()}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach (LaravelLocalization::getSupportedLocales() as $lang => $inner)
                            <a class="dropdown-item" href="{{LaravelLocalization::getLocalizedURL($lang)}}">
                                {{$inner["native"]}}
                            </a>
                        @endforeach
                        </div>
                    </li>

                </ul>
                <ul class="list-inline mb-0 d-block d-lg-none dark-header-socials">
                    <li class="list-inline-item"><a href="{{$setting->facebook}}"><i class="ti-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="{{$setting->twitter}}"><i class="ti-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="{{$setting->instagram}}"><i class="ti-instagram"></i></a></li>
                </ul>
            </div>

            <ul class="header-socials-2 text-right d-none d-lg-block mb-0">
                <li class="list-inline-item"><a href="{{$setting->facebook}}"><i class="ti-facebook"></i></a></li>
                <li class="list-inline-item"><a href="{{$setting->twitter}}"><i class="ti-twitter"></i></a></li>
                <li class="list-inline-item"><a href="{{$setting->instagram}}"><i class="ti-instagram"></i></a></li>
            </ul>
        </div>
    </nav>
</header>
{{-- <div class="header-logo py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <a class="navbar-brand d-none d-lg-block" href="/">
                    <img src="{{asset('images/settings/'.$setting->logo)}}" alt="logo" class="img-fluid">
                </a>
            </div>
        </div>
    </div>
</div> --}}