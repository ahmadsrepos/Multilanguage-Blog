<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item" style="display:flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 10px;">
                <p class="nav-link text-center" style="margin-bottom: 0">{{auth()->user()->name}}</p>
            </li>
            <hr class="hr hr-blurry" />
            <li class="nav-item">
                <a class="nav-link" href="/dashboard"><i class="icon-speedometer"></i>{{__('words.dashboard')}}</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{route('posts.index')}}"><i class="fa-solid fa-file"></i>{{__('words.posts')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('comments.index')}}"><i class="fa-solid fa-comments"></i>{{__('words.comments')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('categories.index')}}"><i class="fa-solid fa-tags"></i>{{__('words.categories')}}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}"><i class="fa-solid fa-users"></i>{{__('words.users')}}</a>
            </li>
            @can('viewAny', auth()->user())
            <li class="nav-item">
                <a class="nav-link" href="{{route('pages.index')}}"><i class="fa-solid fa-gear"></i>{{__('words.pages')}}</a>
            </li>
            @endcan
            @can('viewAny', auth()->user())
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.settings')}}"><i class="fa-solid fa-gear"></i>{{__('words.settings')}}</a>
            </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> {{ __('words.logout') }}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
    </nav>
</div>