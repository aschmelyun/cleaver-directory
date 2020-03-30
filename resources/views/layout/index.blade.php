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
    <div class="flex flex-wrap h-auto lg:h-full" id="app">
        <main class="w-full h-auto lg:h-full lg:w-1/2 order-last lg:order-first bg-gray-100 overflow-y-auto lg:overflow-y-scroll">
            <div class="bg-white pt-8 lg:pt-24 pb-4 lg:pb-12 px-4 lg:px-8">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full lg:w-1/2 px-4 mb-4 lg:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="search">
                            Search
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="search" type="text" placeholder="Pizza" v-model="search">
                    </div>
                    <div class="w-full lg:w-1/2 px-4">
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
                <div class="flex -mx-4 mt-4 lg:mt-8">
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
            <div class="mt-6 px-4 lg:px-8">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" v-text="'Viewing ' + filteredListings.length + ' of ' + listings.length"></label>
                <div class="bg-white mb-6 px-6 py-4" v-for="(listing, listingIndex) in filteredListings" :key="listingIndex">
                    <div class="flex flex-wrap items-start -mx-4">
                        <div class="w-full lg:w-2/3 px-4">
                            <a
                                :href="listing.path"
                                class="text-pink-600 block text-xl font-medium"
                                v-html="listing.title"
                            ></a>
                            <div class="flex flex-wrap lg:flex-no-wrap">
                                <div
                                    class="block font-medium text-sm mb-1 lg:mb-2 capitalize text-gray-600 whitespace-no-wrap"
                                    style="font-size:0;"
                                    v-for="(tag, tagIndex) in listing.tags"
                                    :key="tagIndex"
                                >
                                    <span class="text-sm" v-text="tag"></span>
                                    <span class="text-sm mx-2" v-if="tagIndex !== (listing.tags.length - 1)">&bull;</span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/3 px-4 mt-2 lg:mt-0">
                            <div class="font-semibold text-gray-700"><span v-text="listing.address"></span><br><span v-text="listing.city + ', ' + listing.state"></span></div>
                        </div>
                    </div>
                    <div class="text-gray-700 leading-relaxed border-t border-gray-200 pt-2 mt-1" v-text="listing.excerpt"></div>
                </div>
            </div>
            <footer class="px-4 lg:px-8 pb-4">
                <p class="text-sm font-medium text-gray-600">Built by <a href="https://twitter.com/aschmelyun" class="text-pink-600 hover:text-pink-500 transition-colors duration-200" target="_blank" rel="noreferrer">Andrew Schmelyun</a> and <a href="https://github.com/aschmelyun/cleaver-directory" class="text-pink-600 hover:text-pink-500 transition-colors duration-200" target="_blank" rel="noreferrer">open sourced</a> under the MIT license</p>
            </footer>
        </main>
        <aside class="w-full lg:w-1/2 h-64 lg:h-full order-first lg:order-last">
            @if($listings->count())
                <gmap-map
                    :center="{lat:{{ $listings->first()->lat }}, lng:{{ $listings->first()->long }}}"
                    :zoom="11"
                    style="width:100%; height:100%"
                    ref="mapRef"
                >
                    <gmap-info-window
                        :options="info.options"
                        :position="info.listing.position"
                        :opened="info.opened"
                        @closeclick="handleInfoWindowClose"
                    >
                        <div class="info-window leading-normal">
                            <h2 class="text-pink-600 block text-xl font-medium" v-html="info.listing.title"></h2>
                            <h4 class="font-semibold mb-2 text-gray-700" v-html="info.listing.address + '<br>' + info.listing.city + ', ' + info.listing.state"></h4>
                            <ul>
                                <li
                                    v-for="(tag, tagIndex) in info.listing.tags"
                                    :key="tagIndex"
                                    v-text="tag"
                                    class="inline-block uppercase tracking-wide text-gray-600 text-xs font-bold mr-3"
                                ></li>
                            </ul>
                        </div>
                    </gmap-info-window>
                    <gmap-marker
                        v-for="(listing, listingIndex) in filteredListings"
                        :key="listingIndex"
                        :position="listing.position"
                        :clickable="true"
                        :draggable="false"
                        @click="handleMarkerClicked(listing)"
                    ></gmap-marker>
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
                    info: {
                        opened: false,
                        listing: {},
                        options: {
                            pixelOffset: {
                                width: 0,
                                height: -35
                            }
                        }
                    },
                    search: '',
                    city: '',
                    tags: [],
                    listings: [
                        @foreach($listings as $listing)
                            @php
                                preg_match('/<p>(.*?)<\/p>/s', $listing->body, $match);
                            @endphp
                        {
                            title:"{{ $listing->title }}",
                            path:"{{ $listing->path }}",
                            tags:[@foreach(explode(',', $listing->tags) as $tag)"{{ $tag }}",@endforeach],
                            address:"{{ $listing->address }}",
                            city:"{{ $listing->city }}",
                            state:"{{ $listing->state }}",
                            position:{
                                lat:{{ $listing->lat }},
                                lng:{{ $listing->long }}
                            },
                            excerpt:"{{ $match[1] }}"
                        },
                        @endforeach
                    ]
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
                },
                handleMarkerClicked(listing) {
                    this.info.listing = listing;
                    this.info.opened = true;
                },
                handleInfoWindowClose() {
                    this.info.listing = {};
                    this.info.opened = false;
                }
            },
            computed: {
                filteredListings() {
                    let listings = this.listings;

                    if(this.search) {
                        listings = listings.filter((listing, index) => {
                            return (listing.title.includes(this.search) || listing.city.includes(this.search) || listing.excerpt.includes(this.search));
                        });
                    }

                    if(this.city) {
                        listings = listings.filter((listing, index) => {
                            return listing.city === this.city;
                        });
                    }

                    if(this.tags.length) {
                        listings = listings.filter((listing, index) => {
                            return this.tags.every(tag => listing.tags.includes(tag));
                        });
                    }

                    return listings;
                }
            }
        }).$mount('#app');
    </script>
@endsection