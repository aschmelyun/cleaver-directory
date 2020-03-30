@extends('common.default')
@section('content')
    <div class="flex h-full" id="app">
        <main class="w-1/2 bg-gray-100 overflow-y-scroll">
            <div class="mt-24 px-8">
                <div class="bg-white mb-6 px-6 py-4">
                    <div class="flex items-start -mx-4">
                        <div class="w-2/3 px-4">
                            <h2 class="text-pink-600 block text-xl font-medium">{{ $title }}</h2>
                            <div class="flex">
                                @foreach(explode(',', $tags) as $tag)
                                    <span class="block font-medium text-sm mb-2 capitalize text-gray-600">{{ $tag }}@if(!$loop->last)<span class="mx-2">&bull;</span>@endif</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="w-1/3 px-4">
                            <div class="font-semibold text-gray-700">{{ $address }}<br>{{ $city }}, {{ $state }}</div>
                        </div>
                    </div>
                    <div class="text-gray-700 border-t border-gray-200 pt-2 mt-1 listing-body">{!! $body !!}</div>
                </div>
            </div>
        </main>
        <aside class="w-1/2">
            <gmap-map
                :center="{lat:{{ $lat }}, lng:{{ $long }}}"
                :zoom="16"
                style="width:100%; height:100%"
                ref="mapRef"
            >
                <gmap-info-window
                    :options="info.options"
                    :position="{lat:{{ $lat }}, lng:{{ $long }}}"
                    :opened="true"
                >
                    <div class="info-window leading-normal">
                        <h2 class="text-pink-600 block text-xl font-medium">{{ $title }}</h2>
                        <h4 class="font-semibold mb-2 text-gray-700">{{ $address }}<br>{{ $city }}, {{ $state }}</h4>
                        <ul>
                            @foreach(explode(',', $tags) as $tag)
                                <li class="inline-block uppercase tracking-wide text-gray-600 text-xs font-bold mr-3">{{ $tag }}</li>
                            @endforeach
                        </ul>
                    </div>
                </gmap-info-window>
                <gmap-marker
                    :position="{lat:{{ $lat }}, lng:{{ $long }}}"
                    :clickable="true"
                    :draggable="false"
                ></gmap-marker>
            </gmap-map>
        </aside>
    </div>
@endsection
@section('bottom-scripts')
    <script type="text/javascript">
        const app = new Vue({
            data() {
                return {
                    info: {
                        options: {
                            pixelOffset: {
                                width: 0,
                                height: -35
                            }
                        }
                    }
                }
            },
            created() {

            },
            methods: {
                handleMarkerClicked(listing) {
                    this.info.opened = true;
                },
                handleInfoWindowClose() {
                    this.info.opened = false;
                }
            }
        }).$mount('#app');
    </script>
@endsection