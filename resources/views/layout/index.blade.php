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
        <main class="w-1/2 bg-gray-100 overflow-y-scroll">
            <div class="bg-white pt-24 pb-12 px-8">
                <div class="flex -mx-4">
                    <div class="w-1/2 px-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="search">
                            Search
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="search" type="text" placeholder="Pizza" v-model="search">
                    </div>
                    <div class="w-1/2 px-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
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
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
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
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" v-text="'Viewing ' + filteredListings.length + ' of ' + listings.length"></label>
                @foreach($listings as $listing)
                    <div class="bg-white mb-6 px-6 py-4">
                        <div class="flex items-start -mx-4">
                            <div class="w-2/3 px-4">
                                <a
                                    href="{{ $listing->path }}"
                                    class="text-pink-600 block text-xl font-medium"
                                >{{ $listing->title }}</a>
                                <div class="flex">
                                    @foreach(explode(',', $listing->tags) as $tag)
                                        <span class="block font-medium text-sm mb-2 capitalize text-gray-600">{{ $tag }}@if(!$loop->last)<span class="mx-2">&bull;</span>@endif</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="w-1/3 px-4">
                                <div class="font-semibold text-gray-700">{{ $listing->address }}<br>{{ $listing->city }}, {{ $listing->state }}</div>
                            </div>
                        </div>
                        @php
                            preg_match('/<p>(.*?)<\/p>/s', $listing->body, $match);
                        @endphp
                        <div class="text-gray-700 leading-relaxed border-t border-gray-200 pt-2 mt-1">{!! $match[0] !!}</div>
                    </div>
                @endforeach
            </div>
        </main>
        <aside class="w-1/2">
            @if($listings->count())
                <gmap-map
                    :center="{lat:{{ $listings->first()->lat }}, lng:{{ $listings->first()->long }}}"
                    :zoom="11"
                    style="width:100%; height:100%"
                    ref="mapRef"
                >
                    @foreach($listings as $listing)
                        <gmap-marker
                            :position="{lat:{{ $listing->lat }}, lng:{{ $listing->long }}}"
                            :clickable="true"
                            :draggable="false"
                        ></gmap-marker>
                    @endforeach
                </gmap-map>
            @endif
        </aside>
    </div>
@endsection
@section('bottom-scripts')
    <script type="text/javascript">
        const app = new Vue({
            data() {
                return {
                    search: '',
                    city: '',
                    tags: [],
                    listings: []
                }
            },
            created() {

            },
            methods: {
                handleTag(tag) {
                    console.log('handle tag');
                    if(!this.tags.includes(tag)) {
                        this.tags.push(tag);
                    } else {
                        this.tags.splice(this.tags.indexOf(tag), 1);
                    }
                }
            },
            computed: {
                filteredListings() {
                    if(!this.tags.length) {
                        return this.listings;
                    }

                    return this.listings.filter((listing, index) => {
                        return this.tags.every(tag => listing.tags.includes(tag));
                    });
                }
            }
        }).$mount('#app');
    </script>
@endsection