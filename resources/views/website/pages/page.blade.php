@extends('website.layouts.app')
@section('title')
{{$page->title}} | {{$setting->title}}
@endsection
@section('content')
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$page->title}}</h1>
            <div>{!!$page->content!!}</div>
        </div>
    </div>
</div>
@push('js')
@endpush
@endsection