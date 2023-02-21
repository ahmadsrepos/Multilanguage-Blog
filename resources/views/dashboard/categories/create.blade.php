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
            <a class="breadcrumb-btn" href="{{route('categories.index')}}">
                {{__('words.posts')}}
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
                            <strong>{{__('words.create_new_category')}}</strong>
                        </div>
                        <div class="card-block">
                            <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label>{{__('words.parent_category')}}</label>
                                        <select class="form-control" name="parent">
                                            <option value="">{{__('words.without')}}</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('words.image')}}</label>
                                            <input type="file" class="form-control" name="image">
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