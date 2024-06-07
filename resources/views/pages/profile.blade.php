@extends('layouts.app')

@section('title', 'GorBoen')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css\map.css">
    <link rel="stylesheet" href="/qgis/css/leaflet.css">
        <link rel="stylesheet" href="/qgis/css/qgis2web.css">
        <link rel="stylesheet" href="/qgis/css/fontawesome-all.min.css">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>GorBoen</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Peta</h2>
                <div id="map-title">
                    <h2>Map Kebun Bogor</h2>
                </div>
                <div id="map-container">
                    <div id="map"></div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="\qgis\js\qgis2web_expressions.js"></script>
        <script src="\qgis\js\leaflet.js"></script>
        <script src="\qgis\js\leaflet.rotatedMarker.js"></script>
        <script src="\qgis\js\leaflet.pattern.js"></script>
        <script src="\qgis\js\leaflet-hash.js"></script>
        <script src="\qgis\js\Autolinker.min.js"></script>
        <script src="\qgis\js\rbush.min.js"></script>
        <script src="\qgis\js\labelgun.min.js"></script>
        <script src="\qgis\js\labels.js"></script>
        <script src="\qgis\data\kebunbogor_1.js"></script>
    <script src="js\custom.js"></script>
@endpush
