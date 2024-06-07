@extends('layouts.app')

@section('title', 'Ubah Kebun')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    {{-- BARU --}}
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">

@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('kebun.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Buat Kebun Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Kebun</a></div>
                    <div class="breadcrumb-item">Buat Kebun</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Buat Kebun</h2>
                <p class="section-lead">
                    Buat data Kebun dan lengkapi semua data yang dibutuhkan.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tulis Kebun Anda</h4>
                            </div>

                            <?php
                                // if (isset($dataPlants) && is_array($dataPlants) && !empty($dataPlants))
                                //     $DBresult = $dataPlants;
                                // else
                                //     $DBresult = 0;


                                // if ($DBresult>0){
                                //     $value=$DBresult[0]
                                    ?>


                                <div class="card-body">
                                    <form method="POST"
                                        action="{{ route('kebun.store') }}"
                                        class="needs-validation"
                                        novalidate="">
                                        @csrf
                                        @method('POST')



                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kebun</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="judul"
                                                    class="form-control" value="" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                                            <div class="col-sm-12 col-md-7">
                                                {{-- <textarea class="summernote-simple"></textarea> --}}
                                                <textarea class="form-control" name="detail_wisata"
                                                data-height="150" required></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kontak</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="Kontak"
                                                class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Wilayah</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select name="wilayah" class="form-control">
                                                    <option value="Kota Bogor" >Kota Bogor</option>
                                                    <option value="Kab. Bogor" >Kab. Bogor</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Langitude</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="lan"
                                                class="form-control " required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Longitude</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="long"
                                                class="form-control " required>
                                            </div>
                                        </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="form-group">
                                                <input type="file" id="image-upload" accept="image/png, image/jpeg"
                                                    class="form-control" required>
                                            </div>
                                            <img class="base64-image" id="image-base64" src="{{ asset('img/ofh/emptyImage.png') }}">
                                            <input type="hidden" name="gambar_Wisata" id="gambar_input">
                                        </div>
                                    </div>







                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button class="btn btn-primary" type="submit">Simpan Kebun</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            <?php
                                // }else{

                                // };
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    {{-- JS Libraies Date Picker --}}
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>


@endpush
