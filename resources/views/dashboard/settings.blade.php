@extends('dashboard.layouts.layout')
@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a class="breadcrumb-btn" href="{{route('dashboard.index')}}">
            {{__('words.dashboard')}}
        </a>
    </li>
    <li class="breadcrumb-item active">
        <a class="breadcrumb-btn active" href="#">
            {{__('words.settings')}}
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
            <form action="{{route('dashboard.settings.update')}}" method="post" enctype="multipart/form-data">
                @CSRF
                <div class="col-sm-6">
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
                                        <label>{{__('words.sitename')}}</label>
                                        <input type="text" class="form-control" name="{{$key}}[title]" value="{{$setting->translate($key)->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('words.sitedescription')}}</label>
                                        <textarea class="form-control" name="{{$key}}[description]">{{$setting->translate($key)->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('words.address')}}</label>
                                        <textarea class="form-control" name="{{$key}}[address]">{{$setting->translate($key)->address}}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong>{{__('words.images')}}</strong>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <h6>{{__('words.logo')}}</h6>
                                        <img style="max-width:200px" src="{{asset('images/settings/'.$setting->logo)}}" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{__('words.logo')}}</label>
                                        <input type="file" class="form-control" name="logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <h6>{{__('words.favicon')}}</h6>
                                        <img style="max-width:200px" src="{{asset('images/settings/'.$setting->favicon)}}" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{__('words.favicon')}}</label>
                                        <input type="file" class="form-control" name="favicon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{__('words.contactinfo')}}</strong>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{__('words.email')}}</label>
                                        <input type="text" class="form-control" name="email" value="{{$setting->email}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{__('words.phone')}}</label>
                                        <input type="text" class="form-control" name="phone" value="{{$setting->phone}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong>{{__('words.socialmediainfo')}}</strong>
                        </div>
                        <div class="card-block">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('words.facebook')}}</label>
                                            <input type="text" class="form-control" name="facebook" value="{{$setting->facebook}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('words.twitter')}}</label>
                                            <input type="text" class="form-control" name="twitter" value="{{$setting->twitter}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('words.instagram')}}</label>
                                            <input type="text" class="form-control" name="instagram" value="{{$setting->instagram}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong>{{__('words.comments')}}</strong>
                        </div>
                        <div class="card-block">
                            <div class="card-block">
                                <div class="row">
                                    <label class="col-sm-7 form-control-label">السماح بالتعليقات</label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" id="checkbox1" name="allow_comments" {{($setting->allow_comments)? 'checked' : ''}}>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <label class="col-sm-7 form-control-label">مراجعة التعليقات</label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" id="checkbox2" name="revise_comments" {{($setting->revise_comments)? 'checked' : ''}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card-footer col-12">
                        <button type="submit" class="btn btn-md btn-primary gen-btn">{{__('words.submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection