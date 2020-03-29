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
    $cities = $listings->map(function($item, $key) {
        return $item->city;
    })
        ->flatten()
        ->unique();
@endphp
@section('content')
    <div class="flex h-full" id="app">
        <main class="w-1/2 bg-gray-100">
            <div class="bg-white pt-24 pb-12 px-8">
                <div class="flex -mx-4">
                    <div class="w-1/2 px-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                            Search
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="search" type="text" placeholder="Pizza" v-model="search">
                    </div>
                    <div class="w-1/2 px-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                            City
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="city" v-model="city">
                                <option value="">Select A City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex -mx-4 mt-8">
                    <div class="w-full px-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                            Filter By Tag
                        </label>
                        <div>
                            @foreach($tags as $tag)
                                <button
                                    class="inline-block font-medium text-sm mb-2 py-1 px-3 capitalize rounded border border-gray-600 mr-2 hover:bg-gray-600 hover:text-white transition duration-200 focus:outline-none"
                                    :class="{'bg-gray-600': tags.includes('{{ $tag }}'), 'text-white': tags.includes('{{ $tag }}'), 'bg-white': !tags.includes('{{ $tag }}'), 'text-gray-600': !tags.includes('{{ $tag }}')}"
                                    @click.prevent="handleTag('{{ $tag }}')"
                                >{{ $tag }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 px-8">
                @foreach($listings as $listing)
                    <div class="bg-white mb-6">
                        <h3>{{ $listing->title }}</h3>
                    </div>
                @endforeach
            </div>
        </main>
        <aside class="w-1/2">
            <gmap-map
                :center="{lat:10, lng:10}"
                :zoom="7"
                style="width:100%; height:100%"
                ref="mapRef"
            ></gmap-map>
        </aside>
    </div>
@endsection
