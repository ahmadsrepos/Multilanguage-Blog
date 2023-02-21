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
            <a class="breadcrumb-btn" href="{{route('users.index')}}">
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
                            <strong>{{__('words.create_new_user')}}</strong>
                        </div>
                        <div class="card-block">
                            <form action="{{route('users.store')}}" method="post">
                            @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('words.name')}}</label>
                                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('words.email')}}</label>
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>{{__('words.status')}}</label>
                                        <select class="form-control" name="status">
                                            @if(old('status') == "admin")

                                            <option value="user">{{__('words.user')}}</option>
                                            <option value="admin" selected>{{__('words.admin')}}</option>
                                            <option value="">{{__('words.not_activated')}}</option>

                                            @elseif(old('status') == "user")

                                            <option value="user" selected>{{__('words.user')}}</option>
                                            <option value="admin">{{__('words.admin')}}</option>
                                            <option value="">{{__('words.not_activated')}}</option>

                                            @else

                                            <option value="user">{{__('words.user')}}</option>
                                            <option value="admin">{{__('words.admin')}}</option>
                                            <option value="" selected>{{__('words.not_activated')}}</option>

                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('words.password')}}</label>
                                            <input type="password" class="form-control" name="password" value="{{old('password')}}">
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