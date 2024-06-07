@extends('layouts.app')

@section('title', 'Ubah Berita')

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
                    <a href="features-posts.html"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Buat Berita Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Berita</a></div>
                    <div class="breadcrumb-item">Ubah Berita</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Ubah Berita</h2>
                <p class="section-lead">
                    Ubah berita dan lengkapi semua data yang dibutuhkan.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tulis Berita Anda</h4>
                            </div>

                            <?php
                                if (isset($dataGorBoen) && is_array($dataGorBoen) && !empty($dataGorBoen))
                                    $newsDB = $dataGorBoen;
                                else
                                    $newsDB = 0;


                                if ($newsDB>0){
                                    $value=$newsDB[0]
                                    ?>


                                <div class="card-body">
                                    <form method="POST"
                                        action="{{ route('gorboen.update', $value->_id) }}"
                                        class="needs-validation"
                                        novalidate="">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Berita</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="judul_berita"
                                                    class="form-control" value="{{ $value->judul }}" /required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Detail Berita</label>
                                            <div class="col-sm-12 col-md-7">
                                                {{-- <textarea class="summernote-simple"></textarea> --}}
                                                <textarea class="form-control" name="detail_berita"
                                                data-height="150" /required> {{ $value->detail_berita }} </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Berita</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="tanggal_berita" value="{{ date('Y-m-d', strtotime($value->tanggal)) }}"
                                                class="form-control datepicker" /required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="form-group">
                                                    <input type="file" id="image-upload" accept="image/png, image/jpeg"
                                                        class="form-control" />
                                                </div>
                                                {{-- <img class="base64-image" id="image-base64" src="{{ !empty($value->gambar) ? $value->gambar : asset('img/ofh/emptyImage.png') }}"> --}}
                                                <?php             
                                                $imageSrc = 'data:image/png;base64,'. $value->gambar;
                                                ?>
                                                @if (isset($imageSrc) && is_string($imageSrc) && strpos($imageSrc, 'data:image') === 0)
                                                    <img class="base64-image" id="image-base64" src="{{ $imageSrc }}">  
                                                @else
                                                    <img class="base64-image" id="image-base64" src="{{ asset('img/ofh/emptyImage.png') }}">
                                                @endif


                                                <input type="hidden" name="gambar_berita" id="gambar_berita" value="{{ $value->gambar }}" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button class="btn btn-primary" type="submit">Simpan Berita</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            <?php
                                }else{

                                };
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

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>


@endpush
