@extends('layout.index')
@section('title', 'Map')
{{-- @section('menuTrack', 'active') --}}

@section('head')
    {{-- Template Routing Machine Leaflet --}}
    <link rel="stylesheet" href="{{ url('assets/js/leaflet-routing-machine/dist/leaflet-routing-machine.css') }}" />

    {{-- Template Leaflet Maps --}}
    <link rel="stylesheet" href="{{ url('https://unpkg.com/leaflet@1.9.3/dist/leaflet.css') }}"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>

    {{-- Template CSS Leaflet Maps --}}
    <style>
        #map {
            height: 600px;
        }

        #map-container {
            height: 610px;
            width: 100%;
            position: static;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(13, 80, 174, 0.2); /* Menambahkan bayangan */
            background-clip: border-box;
            border-radius: 10px;
        }
    </style>

    {{-- Template Boostrap --}}
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">

    {{-- Template Leaflet CSS JS --}}
    <script src="{{ url('https://unpkg.com/leaflet@1.9.3/dist/leaflet.js') }}"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin=""></script>

    {{-- Template Routing Machine Leaflet CSS JS --}}
    <script src="{{ url('assets/js/leaflet-routing-machine/dist/leaflet-routing-machine.js') }}"></script>

    {{-- Template Geocoder --}}
    <script src="{{ url('assets/js/leaflet-routing-machine/examples/Control.Geocoder.js') }}"></script>

    {{-- Template Jquery --}}
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js') }}"></script>

@section('content')
    <div class="container" style="padding-top: 10px;">
        <h1 style="text-align: center;">Map</h1>
    </div>
    <div class="container mt-3" id="map-container" style="padding-bottom:100px;">
        <div id="map"></div>
    </div>
    <div class="container" style="padding-bottom: 30px;"></div>

    <script src="assets/geojson/map.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <script>
        // Menampilkan maps
        var map = L.map('map').setView([-7.9933885, 112.6079343], 15);

        // // Menambahkan tile layer
        googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);

        // Mengaktifkan fitur geolocation
        map.locate({setView: true, maxZoom:18});

        // Menampilkan marker untuk menunjukkan lokasi user saat ini
        var marker = L.marker([0,0]).addTo(map);

        // Fungsi untuk menambahkan titik pada polyline
        function addLatLng(latlng) {
            polyline.addLatLng(latlng);
        }

        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Anda menekan map di titik " + e.latlng.toString())
                .openOn(map);
        }

        map.on('click', onMapClick);

        // Menambahkan geojson
        L.geoJSON(coordinates).addTo(map);
        L.geoJSON(coordinates, {
            onEachFeature: function (feature, layer) {
                if (feature.properties) {
                    layer.bindPopup("<b>Lubang Berada Disini").openPopup();
                }
            }
        }).addTo(map);

    // Menggunakan Leaflet Routing Machine
    var router = L.Routing.control({
        waypoints: [
            L.latLng(0, 0), // Ganti dengan titik awal yang sesuai
            L.latLng(0, 0)  // Ganti dengan titik akhir yang sesuai
        ],
        routeWhileDragging: true
    }).addTo(map);

    </script>

</section>
@endsection