@extends('layouts.app')

@section('title', 'Ubah Data Admin')

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
                    <a href="{{ route('user.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Ubah Data Admin</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Admin</a></div>
                    <div class="breadcrumb-item">Ubah Data Set</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Ubah Data Admin</h2>
                <p class="section-lead">
                    Buat data Data Set dan lengkapi semua data yang dibutuhkan.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Ubah Data Admin</h4>
                            </div>

                            <?php
                                if (isset($dataUser) && is_array($dataUser) && !empty($dataUser))
                                    $DBresult = $dataUser;
                                else
                                    $DBresult = 0;


                                if ($DBresult>0){
                                    $value=$DBresult[0]
                                    ?>


                                <div class="card-body">
                                    <form method="POST"
                                        action="{{ route('user.update', $value->_id) }}"
                                        class="needs-validation"
                                        novalidate="">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="nama_lengkap"
                                                    class="form-control" value="{{ $value->nama_lengkap }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="username"
                                                    class="form-control" value="{{ $value->username }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="email" name="email"
                                                    class="form-control" value="{{ $value->email }}" required>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="role"
                                                    class="form-control" value="{{ $value->role }}" required>
                                            </div>
                                        </div> --}}



                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select name="role" class="form-control">
                                                    <option value="user" {{ $value->role === 'user' ? 'selected' : '' }}>User</option>
                                                    <option value="admin" {{ $value->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                </select>
                                            </div>
                                        </div>






                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button class="btn btn-primary" type="submit">Simpan Data Set</button>
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
