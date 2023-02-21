@extends('website.layouts.app')
@section('title')
{{$post->title}} | {{$setting->title}}
@endsection
@section('meta_description')
{{$post->translate(app()->getLocale())->smalldesc}}
@endsection
@section('meta_keywords')
{{$post->tags}}
@endsection
@section('content')

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-md-12">
            <article class="post">

                <div class="post-header mb-5 text-center">
                    <div class="meta-cat">
                        <a class="post-category font-extra text-color text-uppercase font-sm letter-spacing-1" href="#">
                            {{$post->category->title}}
                        </a>
                    </div>
                    <h2 class="post-title mt-2">
                        {{$post->title}}
                    </h2>

                    <div class="post-meta">
                        <span class="text-uppercase font-sm letter-spacing-1 mr-3">{{$post->user->name}}</span>
                        <span class="text-uppercase font-sm letter-spacing-1">{{$post->created_at}}</span>
                    </div>
                </div>

                <!--quote post-->
                <article class="post post-quote"
                    style="background-image: url('{{asset('images/posts/'.$post->image)}}')">
                    <h3>{{$post->smalldesc}}</h3>
                </article>
                <!--quote post-->


                <div class="post-body mt-5">
                    <div class="entry-content">
                        {!!$post->content!!}
                    </div>

                    <div class="post-tags py-4">
                        @foreach(explode(',', $post->tags) as $tag)
                        <a href="#">#{{$tag}}</a>
                        @endforeach
                    </div>


                    <div
                        class="tags-share-box center-box d-flex text-center justify-content-between border-top border-bottom py-3">

                        <span class="single-comment-o"><i class="fa fa-comment-o"></i>{{$comments->count()}} {{__('words.abs_comments')}}</span>

                        <div class="list-posts-share">
                            <a target="_blank" rel="nofollow" href="#"><i class="ti-facebook"></i></a>
                            <a target="_blank" rel="nofollow" href="#"><i class="ti-twitter"></i></a>
                            <a target="_blank" rel="nofollow" href="#"><i class="ti-pinterest"></i></a>
                            <a target="_blank" rel="nofollow" href="#"><i class="ti-linkedin"></i></a>
                            <div class="fb-share-button" 
                            data-href="https://www.your-domain.com/your-page.html" 
                            data-layout="button_count">
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <nav class="post-pagination clearfix border-top border-bottom py-4">
        @if($next)
        <div class="prev-post">
            <a href="{{route('post', $next->id)}}">
                <span class="text-uppercase">{{__('words.next')}}</span>
                <h4 class="mt-3">{{$next->title}}</h4>
            </a>
        </div>
        @endif
        @if($previous)
        <div class="next-post">
            <a href="{{route('post', $previous->id)}}">
                <span class="text-uppercase">{{__('words.previous')}}</span>
                <h4 class="mt-3">{{$previous->title}}</h4>
            </a>
        </div>
        @endif
    </nav>
    <div class="related-posts-block mt-5">
        <h3 class="news-title mb-4 text-center">
            {{__('words.similar_posts')}}
        </h3>
        <div class="row">
            @foreach($similars as $similar)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="post-block-wrapper mb-4 mb-lg-0">
                    <a href="{{route('post', $similar->id)}}">
                        <img class="img-fluid" src="{{asset('images/posts/'.$similar->image)}}" alt="post-thumbnail" />
                    </a>
                    <div class="post-content mt-3">
                        <h5>
                            <a href="{{route('post', $similar->id)}}">{{$similar->title}}</a>
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="comment-area my-5">
        <h3 class="mb-4 text-center">{{$comments->count()}} {{__('words.abs_comments')}}</h3>
        @foreach($comments as $comment)
        <div class="comment-area-box media border mt-2">
            <div class="media-body ml-4 p-2">
                <h4 class="mb-0">{{$comment->name}} </h4>
                <span class="date-comm font-sm text-capitalize text-color"><i
                        class="ti-time mr-2"></i>{{{$comment->created_at}}} </span>

                <div class="comment-content mt-3">
                    <p class="mb-0">{{$comment->comment}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if($setting->allow_comments)
    <form method="post" action="{{route('comment.store', $post->id)}}" class="comment-form mb-5 gray-bg p-5" id="comment-form">
        @csrf
        <h3 class="mb-4 text-center">{{__('words.leave_comment')}}</h3>
        @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        @if(session()->has('success'))
        <p class="alert alert-success">{{ session()->get('success') }}</p>
        @endif
        @if(session()->has('error'))
        <p class="alert alert-danger">{{ session()->get('error') }}</p>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <textarea class="form-control mb-3" name="comment" id="comment" cols="30" rows="5"
                    placeholder="{{__('words.comment')}}"></textarea>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" id="name" placeholder="{{__('words.name')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" type="text" name="email" id="email" placeholder="{{__('words.name')}}">
                </div>
            </div>
        </div>

        <input class="btn btn-primary" type="submit" id="submit_contact" value="{{__('words._submit')}}">
    </form>
    @endif

</div>
@push('js')
@endpush
@endsection