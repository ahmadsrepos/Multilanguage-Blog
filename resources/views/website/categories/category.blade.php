@extends('website.layouts.app')
@section('title')
{{$category->title}} | {{$setting->title}}
@endsection
@section('content')
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

    <div class="row">
        <div class="col-12 mb-3">
            <h1>Category: {{$category->title}}</h1>
        </div>
        @if($posts->count() != 0)
        @foreach($posts as $post)
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
        @endforeach
        @else
        <div class="no-posts col-12">
            <p>{{__('words.no_posts_in_category')}}</p>
        </div>
        @endif
    </div>


    <div class="pagination mt-5 pt-4">
        {{$posts->appends(request()->input())->links()}}
    </div>
</div>
@endsection