<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="sidebar sidebar-right">
        <div class="sidebar-wrap mt-5 mt-lg-0">

            <div class="sidebar-widget follow mb-5 text-center">
                <form action="{{route('search')}}" method="get">
                    <div class="input-group sidesearch">
                        <input type="search" class="form-control" name="search" placeholder="{{__('words.search')}}" aria-label="Search" aria-describedby="search-addon" />
                        <button type="submit" class="btn btn-outline-primary aded">{{__('words.search')}}</button>
                    </div>
                </form>
            </div>

            <div class="sidebar-widget follow mb-5 text-center">
                <h4 class="text-center widget-title">{{__('words.folow_us')}}</h4>
                <div class="follow-socials">
                    <a href="{{$setting->facebook}}"><i class="ti-facebook"></i></a>
                    <a href="{{$setting->twitter}}"><i class="ti-twitter"></i></a>
                    <a href="{{$setting->instagram}}"><i class="ti-instagram"></i></a>
                </div>
            </div>

            <div class="sidebar-widget mb-5 ">
                <h4 class="text-center widget-title">{{__('words.trending_posts')}}</h4>
                @foreach($latestPosts as $post)

                <div class="media py-3 sidebar-post-item">
                    <a href="{{route('post', $post->id)}}"><img class="mr-4" src="{{asset('images/posts/'.$post->image)}}" alt=""></a>
                    <div class="media-body">
                        <h4><a href="{{route('post', $post->id)}}">{{$post->title}}</a></h4>
                        <span class="text-muted letter-spacing text-uppercase font-sm">{{$post->created_at}}</span>
                    </div>
                </div>

                
                @endforeach

            </div>


            <div class="sidebar-widget category mb-5">
                <h4 class="text-center widget-title">{{__('words.categories')}}</h4>
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                    <li class="align-items-center d-flex justify-content-between">
                        <a href="{{route('category', $category->id)}}">{{$category->title}}</a>
                    </li>
                    @if($category->getChildren)
                    @foreach ($category->getChildren as $child)
                    <li class="align-items-center d-flex justify-content-between">
                        <a href="{{route('category', $child->id)}}">{{$child->title}}</a>
                    </li>
                    @endforeach
                    @endif
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-widget sidebar-adv mb-5">
                <a href="#"><img src="images/sidebar-banner3.png" alt="" class="img-fluid w-100"></a>
            </div>

        </div>
    </div>
</div>