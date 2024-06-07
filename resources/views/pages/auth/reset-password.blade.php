@extends('layouts.auth')

@section('title', 'Reset Password')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Atur Ulang Password</h4>
        </div>

        <div class="card-body">
            <p class="text-muted">Kami Akan Mengirim Link Untuk Mengatur Ulang Password Anda</p>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input id="email"
                        type="email"
                        class="form-control"
                        name="email"
                        tabindex="1"
                        required
                        autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi Baru</label>
                    <input id="password"
                        type="password"
                        class="form-control pwstrength"
                        data-indicator="pwindicator"
                        name="password"
                        tabindex="2"
                        required>
                    <div id="pwindicator"
                        class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm">Ulangi Kata Sandi</label>
                    <input id="password-confirm"
                        type="password"
                        class="form-control"
                        name="confirm-password"
                        tabindex="2"
                        required>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
