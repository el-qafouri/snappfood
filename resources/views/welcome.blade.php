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








        <div class="banner-section">
            <div class="container">
                <div class="row">
                    @foreach ($banners as $banner)
                        <div class="col-md-12">
                            <div class="banner">
                                @if (is_object($banner) && $banner->image)
                                    <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" class="img-fluid">
                                @else
                                    <p>No Image Available</p>
                                @endif
                                <h2>{{ $banner->title ?? 'Default Title' }}</h2>
                                <p>{{ $banner->text ?? 'Default Text' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        @push('scripts')
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                $(document).ready(function () {
                    // Ajax request to get banners
                    $.ajax({
                        url: "{{ route('get.banners') }}",
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            // Display banners
                            displayBanners(data);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });

                    // Function to display banners
                    function displayBanners(banners) {
                        var bannerSection = $('#ajaxBannerSection');

                        // Loop through banners
                        $.each(banners, function (index, banner) {
                            var bannerHtml = '<div class="banner">';
                            bannerHtml += '<img src="' + banner.image + '" alt="' + banner.title + '" class="img-fluid">';
                            bannerHtml += '<h2>' + banner.title + '</h2>';
                            bannerHtml += '<p>' + banner.text + '</p>';
                            bannerHtml += '</div>';

                            // Append banner to bannerSection
                            bannerSection.append(bannerHtml);
                        });
                    }
                });
            </script>
        @endpush









    </main>

    <footer class="bg-gray-200">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
            <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
        </div>
    </footer>
</div>
