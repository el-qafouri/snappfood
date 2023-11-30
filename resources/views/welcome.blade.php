<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div x-data="{ cartOpen: false , isOpen: false }" class="bg-white">
    <main class="my-8">
        <div class="container mx-auto px-6">
            <div class="h-64 rounded-md overflow-hidden bg-cover bg-center"
                 style="background-image: url('{{ asset('gallery/1.jpg') }}')">
                <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                    <div class="px-10 max-w-xl">
                        <h2 class="text-2xl text-white font-semibold"> snappfood</h2>
                        <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore
                            facere provident molestias ipsam sint voluptatum pariatur.</p>
                        <button
                            class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <span>Shop Now</span>
                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="md:flex mt-8 md:-mx-4">
                <div class="w-full h-64 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:w-1/2"
                     style="background-image: url('{{ asset('gallery/1.jpg') }}')">
                    <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                        <div class="px-10 max-w-xl">
                            <h2 class="text-2xl text-white font-semibold">foods</h2>
                            <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                            <button
                                class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                <span>Shop Now</span>
                                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full h-64 mt-8 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:mt-0 md:w-1/2"
                     style="background-image: url('{{ asset('gallery/1.jpg') }}')">
                    <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                        <div class="px-10 max-w-xl">
                            <h2 class="text-2xl text-white font-semibold">foods</h2>
                            <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                            <button
                                class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                <span>Shop Now</span>
                                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>













{{--    <div id="bannerContainer" style="background-color: gainsboro ; padding-top: 50px; padding-bottom: 50px ; padding-left: 250px" >--}}
{{--        <div id="bannerContainer">--}}
{{--            @foreach ($banners as $banner)--}}
{{--                <div class="card" style="display: inline-block;">--}}
{{--                    <img src="{{ asset('storage/' . $banner->image->url) }}" alt="{{ $banner->title }}" class="card-img-top" width="200px" height="150px" style="border: 2px solid {{ $banner->border_color }}">--}}
{{--                    <div class="card-body">--}}
{{--                        <h2 class="card-title" style="color: {{ $banner->title_color }}">{{ $banner->title ?? 'Default Title' }}</h2>--}}
{{--                        <p class="card-text" style="color: {{ $banner->text_color }}">{{ $banner->text ?? 'Default Text' }}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}


{{--    <style>--}}
{{--        .card {--}}
{{--            width: 200px;--}}
{{--            height: 150px;--}}
{{--            margin: 10px;--}}
{{--        }--}}

{{--        .card-img-top {--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--        }--}}

{{--        .card {--}}
{{--            background-color: #ccc;--}}
{{--        }--}}
{{--    </style>--}}





{{--    <footer class="bg-gray-200">--}}
{{--        <div class="container mx-auto px-6 py-3 flex justify-between items-center">--}}
{{--            <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>--}}
{{--            <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>--}}
{{--        </div>--}}
{{--    </footer>--}}
</div>





<div>
    <div id="bannerContainer" style="background-color: gainsboro ; padding-top: 50px; padding-bottom: 50px ; padding-left: 250px" >
        <div id="bannerContainer">
            @foreach ($banners as $banner)
                <div class="card" style="display: inline-block;">
                    <img src="{{ asset('storage/' . $banner->image->url) }}" alt="{{ $banner->title }}" class="card-img-top" width="200px" height="150px" style="border: 2px solid {{ $banner->border_color }}">
                    <div class="card-body">
                        <h2 class="card-title" style="color: {{ $banner->title_color }}">{{ $banner->title ?? 'Default Title' }}</h2>
                        <p class="card-text" style="color: {{ $banner->text_color }}">{{ $banner->text ?? 'Default Text' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

        <style>
            .card {
                width: 200px;
                height: 150px;
                margin: 10px;
            }

            .card-img-top {
                width: 100%;
                height: 100%;
            }

            .card {
                display: none;
                background-color: #ccc;
            }

            #bannerContainer {
                display: flex;
                flex-wrap: nowrap;
                justify-content: center;
                overflow-x: auto;
                padding: 50px 0;
                background-color: gainsboro;
            }

        </style>

{{--        <script>--}}
{{--            const bannerContainer = document.getElementById('bannerContainer');--}}
{{--            const cards = bannerContainer.querySelectorAll('.card');--}}

{{--            let currentCardIndex = 0;--}}

{{--            function showNextCard() {--}}
{{--                cards[currentCardIndex].style.display = 'none';--}}
{{--                currentCardIndex++;--}}
{{--                if (currentCardIndex >= cards.length) {--}}
{{--                    currentCardIndex = 0;--}}
{{--                }--}}
{{--                cards[currentCardIndex].style.display = 'block';--}}
{{--            }--}}

{{--            setInterval(showNextCard, 5000);--}}
{{--        </script>--}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bannerContainer = document.getElementById('bannerContainer');
            const cards = bannerContainer.querySelectorAll('.card');

            let currentCardIndex = 0;
            cards[currentCardIndex].style.display = 'block';

            function showNextCard() {
                cards[currentCardIndex].style.display = 'none';
                currentCardIndex = (currentCardIndex + 1) % cards.length;
                cards[currentCardIndex].style.display = 'block';
            }

            setInterval(showNextCard, 5000);
        });
    </script>

</div>
