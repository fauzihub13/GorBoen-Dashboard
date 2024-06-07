@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Daftar Akun</h4>
        </div>

        <div class="card-body">
            <form method="POST"
                action="{{ route('register') }}"
                class="needs-validation"
                novalidate="">
            @csrf
            @method('POST')

                <div class="row">
                    <div class="form-group col-12">
                        <label for="frist_name">Nama Lengkap</label>
                        <input id="frist_name"
                            type="text"
                            class="form-control"
                            name="nama_lengkap"
                            autofocus required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="frist_name">Nama Pengguna</label>
                        <input id="frist_name"
                            type="text"
                            class="form-control"
                            name="username"
                            autofocus required>
                    </div>
                    <div class="form-group col-6">
                        <label for="last_name">Alamat Email</label>
                        <input id="email"
                            type="email"
                            class="form-control"
                            name="email" required>
                            <div class="invalid-feedback">
                     </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-6">
                        <label for="password"
                            class="d-block">Kata Sandi</label>
                        <input id="password"
                            type="password"
                            class="form-control pwstrength"
                            data-indicator="pwindicator"
                            name="password" required>
                        <div id="pwindicator"
                            class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="password2"
                            class="d-block">Ulangi Kata Sandi</label>
                        <input id="password2"
                            type="password"
                            class="form-control"
                            name="password-confirm" required>
                    </div>
                </div>



                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="agree"
                            class="custom-control-input"
                            id="agree" required>
                        <label class="custom-control-label"
                            for="agree">Saya setuju dengan syarat dan ketentuan yang berlaku.</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-muted mt-5 text-center">
        Sudah Punya Akun? <a href="/login">Masuk</a>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @include('scripts.swal-pop-up')
@endpush
