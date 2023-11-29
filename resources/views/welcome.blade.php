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








{{--    <div class="banner-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                @foreach ($banners as $banner)--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="banner">--}}
{{--                            @if (is_object($banner) && $banner->image)--}}
{{--                                <img src="{{ asset('storage/' . $banner->image->url) }}" alt="{{ $banner->title }}" class="img-fluid">--}}
{{--                            @else--}}
{{--                                <p>No Image Available</p>--}}
{{--                            @endif--}}
{{--                            <h2>{{ $banner->title ?? 'Default Title' }}</h2>--}}
{{--                            <p>{{ $banner->text ?? 'Default Text' }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



{{--    @foreach ($banners as $banner)--}}
{{--<div class="banner">--}}
{{--    @if (!empty($banner->image))--}}
{{--        <img src="{{ asset('storage/' . $banner->image->url) }}" class="img-fluid">--}}
{{--    @else--}}
{{--        <p>No Image Available</p>--}}
{{--    @endif--}}
{{--    <h2>{{ $banner->title ?? 'Default Title' }}</h2>--}}
{{--    <p>{{ $banner->text ?? 'Default Text' }}</p>--}}
{{--</div>--}}
{{--    @endforeach--}}






    <div id="bannerContainer">
    @foreach ($banners as $banner)
        <div class="banner" style="background-color: {{ $banner->background_color }}">
            @if (!empty($banner->image))
                <img src="{{ asset('storage/' . $banner->image->url) }}" alt="{{ $banner->title }}" class="img-fluid" width="100" height="50" style="border: 2px solid {{ $banner->border_color }}" >
            @else
                <p style="color: {{ $banner->text_color }}">No Image Available</p>
            @endif
            <h2 style="color: {{ $banner->title_color }}">{{ $banner->title ?? 'Default Title' }}</h2>
            <p style="color: {{ $banner->text_color }}">{{ $banner->text ?? 'Default Text' }}</p>
        </div>
    @endforeach
        </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                var banners = @json($banners); // تبدیل آرایه بنرها به JSON
                var bannerContainer = $('#bannerContainer');
                var currentBannerIndex = 0;

                function displayBanner() {
                    var banner = banners[currentBannerIndex];

                    var bannerHtml = '<div class="banner">';
                    if (banner.image) {
                        bannerHtml += '<img src="' + banner.image.url + '" alt="' + banner.title + '" class="img-fluid">';
                    } else {
                        bannerHtml += '<p>No Image Available</p>';
                    }
                    bannerHtml += '<h2 style="color: ' + banner.title_color + '">' + (banner.title || 'Default Title') + '</h2>';
                    bannerHtml += '<p style="color: ' + banner.text_color + '">' + (banner.text || 'Default Text') + '</p>';
                    bannerHtml += '</div>';

                    bannerContainer.html(bannerHtml);

                    currentBannerIndex++;
                    if (currentBannerIndex >= banners.length) {
                        currentBannerIndex = 0;
                    }

                    setTimeout(displayBanner, 5000); // تاخیر برای نمایش بعدی
                }

                // اجرای اولیه
                displayBanner();
            });
        </script>
    @endpush





    <footer class="bg-gray-200">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
            <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
        </div>
    </footer>
</div>
