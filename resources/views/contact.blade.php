@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $StaticPage->title }}</h1>
        <div>{!! $StaticPage->content !!}</div>
    </div>
@endsection
