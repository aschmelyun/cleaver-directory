@extends('common.default')
@php
    $listings = $content->filter(function($item, $key) {
        return $item->view === 'layout.listing';
    });
    $tags = $listings->map(function($item, $key) {
        return explode(',', $item->tags);
    })
        ->flatten()
        ->unique();
@endphp
@section('content')
    @foreach($listings as $listing)
        <h1>{{ $listing->title }}</h1>
    @endforeach
    @foreach($tags as $tag)
        <a href="#">{{ $tag }}</a>
    @endforeach
@endsection