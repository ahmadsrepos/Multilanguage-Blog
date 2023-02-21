@extends('website.layouts.app')
@section('content')
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

    <div class="row">
        @foreach($posts as $post)
        @if($loop->index % 3 == 0 || $loop->index == 0)
        <div class="col-lg-12">
            <article class="post-grid mb-5">
                <a class="post-thumb mb-4 d-block" href="{{route('post', $post->id)}}">
                    <img src="{{asset('images/posts/'.$post->image)}}" alt="" class="img-fluid w-100">
                </a>
                <span class="font-sm text-color letter-spacing text-uppercase post-meta font-extra">{{$post->category->title}}</span>
                <h2 class="mb-1 mt-2 post-title"><a href="{{route('post',$post->id)}}">{{$post->title}}</a></h2>
        
                <div class="post-content mt-4"><p>{!!$post->content!!}</p></div>
                <a href="{{route('post',$post->id)}}" class="read-more btn btn-primary mt-3">{{__('words.read_more')}}</a>
            </article>
        </div>
        @else
        <div class="col-lg-6">
            <article class="post-grid mb-5">
                <a class="post-thumb mb-4 d-block" href="{{route('post', $post->id)}}">
                    <img src="{{asset('images/posts/'.$post->image)}}" alt="" class="img-fluid">
                </a>
                <span class="font-sm text-color letter-spacing text-uppercase post-meta font-extra">{{$post->category->title}}</span>
                <h3 class="post-title mb-1 mt-2"><a href="{{route('post', $post->id)}}">{{$post->title}}</a></h3>

                <div class="post-content mt-4">
                    <p>{!! $post->content !!}</p>
                </div>
                <a href="{{route('post',$post->id)}}" class="read-more btn btn-primary mt-3">{{__('words.read_more')}}</a>
            </article>
        </div>
        @endif
        @endforeach
    </div>


    <div class="pagination mt-5 pt-4">
        {{$posts->links()}}
    </div>
</div>
@endsection