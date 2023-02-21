@extends('dashboard.layouts.layout')
@section('content')
<!-- Breadcrumb -->
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a class="breadcrumb-btn" href="{{route('dashboard.index')}}">
                {{__('words.dashboard')}}
            </a>
        </li>
        <li class="breadcrumb-item">
            <a class="breadcrumb-btn" href="{{route('pages.index')}}">
                {{__('words.pages')}}
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a class="breadcrumb-btn active" href="#">
                {{__('words.create')}}
            </a>
        </li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{__('words.create_new_page')}}</strong>
                        </div>
                        <div class="card-block">
                            <form action="{{route('pages.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('words.name')}}</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong>{{__('words.translations')}}</strong>
                                            </div>
                                            <div class="card-block">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    @foreach(config('app.languages') as $key=>$lang)
                                                    <li class="nav-item">
                                                        <a class="nav-link @if($loop->index == 0)active @endif" id="{{$key}}-tab" data-toggle="tab" href="#{{$key}}" role="tab" aria-controls="{{$key}}" aria-selected="true">{{$lang}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    @foreach(config('app.languages') as $key=>$lang)
                                                    <div class="tab-pane @if($loop->index == 0)show active @endif" id="{{$key}}" role="tabpanel" aria-labelledby="{{$key}}-tab">
                                                        <br>
                                                        <div class="form-group">
                                                            <label>{{__('words.title')}}</label>
                                                            <input type="text" class="form-control" name="{{$key}}[title]" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{__('words.content')}}</label>
                                                            <textarea class="form-control summernote" name="{{$key}}[content]"></textarea>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <button type="submit" class="btn btn-primary">{{__('words.create')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@push('js')
<script>
$(document).ready(function() {
  $('.summernote').summernote();
});
</script>
@endpush