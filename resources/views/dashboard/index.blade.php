@extends('dashboard.layouts.layout')
@section('content')
<style>
  

</style>
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item active">
        <a class="breadcrumb-btn active" href="#">
            {{__('words.dashboard')}}
        </a>
    </li>
</ol>

<div class="container-fluid">

    <div class="animated fadeIn">
        <div class="row index-stats">

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col text-center">
                      <h5 class="card-title text-uppercase text-muted mb-0">{{__('words.posts')}}</h5>
                      <span class="h2 font-weight-bold mb-0">{{$posts}}</span>
                    </div>

                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fa-solid fa-note-sticky"></i>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col text-center">
                      <h5 class="card-title text-uppercase text-muted mb-0">{{__('words.comments')}}</h5>
                      <span class="h2 font-weight-bold mb-0">{{$comments}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fa-solid fa-comments"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col text-center">
                      <h5 class="card-title text-uppercase text-muted mb-0">{{__('words.views')}}</h5>
                      <span class="h2 font-weight-bold mb-0">{{$views}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fa-solid fa-eye"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col text-center">
                      <h5 class="card-title text-uppercase text-muted mb-0">{{__('words.categories')}}</h5>
                      <span class="h2 font-weight-bold mb-0">{{$categories}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fa-solid fa-tags"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

</div>
<!--/.container-fluid-->
@endsection

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">



