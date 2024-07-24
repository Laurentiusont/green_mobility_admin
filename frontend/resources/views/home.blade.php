@extends('layouts.template')

@section('vendor-css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>
<style>
    #map { height: 80vh; }
</style>
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body mx-5 ">
                            <div class="row d-flex justify-content-center align-items-center h-auto" >
                                <div class="col-md-12">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('vendor-javascript')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
crossorigin=""></script>
@endsection
@section('custom-javascript')
    <script type="text/javascript">
    const map = L.map('map').setView([-7.330206979726604, 110.50427647041089], 14);

    const tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>'
    }).addTo(map);

    const markers = [
        {coords: [-7.311182832632899, 110.49081023087008], popup: 'Alfamart'},
        {coords: [-7.329440271177454, 110.50070579104012], popup: 'Alfamart Adi Sucipto'},
        // Add more markers as needed
    ];

    markers.forEach(markerData => {
        const marker = L.marker(markerData.coords).addTo(map);
        marker.bindPopup(markerData.popup).openPopup();
    });

    // Define a custom icon for the user's location
    const userIcon = L.icon({
            iconUrl: '{{ asset("images/icon.png") }}', // Replace with the path to your custom icon
            iconSize: [64, 64], // size of   the icon
            iconAnchor: [32, 32], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -20] // point from which the popup should open relative to the iconAnchor
        });

        // Add user's current live location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const userCoords = [position.coords.latitude, position.coords.longitude];
                const userMarker = L.marker(userCoords, { icon: userIcon }).addTo(map);
                userMarker.bindPopup("You are here").openPopup();
                map.setView(userCoords, 14);  // Adjust the map view to the user's location
            }, error => {
                console.error("Error obtaining location", error);
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
        }

        map.on('click', function(e) {
            const latLng = e.latlng;
            const userAddedMarker = L.marker([latLng.lat, latLng.lng]).addTo(map);
            userAddedMarker.bindPopup("New Marker at (" + latLng.lat + ", " + latLng.lng + ")").openPopup();
        });
        </script>
    </script>
@endsection