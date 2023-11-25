<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <title>Location</title>
</head>
<body>
<div>
<h2>Select Restaurant Location</h2>

{{--<form id="locationForm" action="{{ route('restaurant.store') }}" method="post">--}}
<form id="locationForm" action="{{ route('restaurant.setLocation') }}" method="post">
    @csrf
    <input type="text" name="title" id="title" placeholder="Title"/>
    <input type="text" name="address" id="address" placeholder="Address"/>
    <input type="hidden" name="latitude" id="latitude" />
    <input type="hidden" name="longitude" id="longitude" />
    <button type="submit">save</button>
</form>
</div>
<div id="map" style="height: 400px;"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>

    var defaultLocation = [35.6895, 51.3890];

    var mymap = L.map('map').setView(defaultLocation, 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mymap);

    var marker = L.marker(defaultLocation, {
        draggable: true // قابل جابجایی با موس
    }).addTo(mymap);

    // رویداد تغییر موقعیت نشانگر
    marker.on('dragend', function (event) {
        var marker = event.target;
        var position = marker.getLatLng();
        document.getElementById("latitude").value = position.lat;
        document.getElementById("longitude").value = position.lng;
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("مرورگر شما از ویژگی موقعیت جغرافیایی پشتیبانی نمی‌کند.");
        }
    }

    function showPosition(position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;

        // حذف نشانگر قبلی (اگر وجود داشته باشد)
        if (marker) {
            mymap.removeLayer(marker);
        }

        // نمایش موقعیت بر روی نقشه با نشانگر
        marker = L.marker([position.coords.latitude, position.coords.longitude], {
            draggable: true // قابل جابجایی با موس
        }).addTo(mymap);

        // رویداد تغییر موقعیت نشانگر
        marker.on('dragend', function (event) {
            var marker = event.target;
            var position = marker.getLatLng();
            document.getElementById("latitude").value = position.lat;
            document.getElementById("longitude").value = position.lng;
        });

        // زوم به موقعیت فعلی
        mymap.setView([position.coords.latitude, position.coords.longitude], mymap.getZoom());
    }



</script>
<style>
    /* Style for your custom form */
    #locationForm input,
    #locationForm button {
        margin-bottom: 1rem;
        padding: 0.75rem;
        font-size: 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
    }

    #locationForm button {
        background-color: #4a5568;
        color: #ffffff;
        cursor: pointer;
    }

    #locationForm button:hover {
        background-color: #2d3748;
    }
</style>
</body>
</html>



