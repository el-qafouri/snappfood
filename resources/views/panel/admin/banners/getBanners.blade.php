@section('banner')

    <!-- Existing content ... -->

    <!-- Banner Section -->
    <div class="banner-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner">
                        @if ($banner->image)
                            <img src="{{ asset('storage/' . $banner->image->url) }}" class="img-fluid">
                        @else
                            <p>No Image Available</p>
                        @endif
                        <h2>{{ $banner->title }}</h2>
                        <p>{{ $banner->text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ajax Banner Section -->
    <div id="ajaxBannerSection" class="text-center mt-5"></div>

    <!-- Existing content ... -->

@endsection





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
