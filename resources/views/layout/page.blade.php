@extends('common.default')
@section('content')
    <div class="h-full bg-gray-100 pt-8 lg:pt-24">
        <main class="w-full max-w-lg bg-white px-8 py-6 mx-auto">
            <h2 class="text-gray-700 block text-xl font-medium">{{ $title }}</h2>
            <div class="text-gray-600 pt-2 mt-1 listing-body">{!! $body !!}</div>
        </main>
    </div>
@endsection