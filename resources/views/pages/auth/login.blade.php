

@extends('layouts.auth')

@section('title', 'Login Admin GorBoen')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')

    <div class="card card-primary">
        <div class="card-header">
            <h4>Masuk</h4>
        </div>


        <div class="card-body">
            <form method="POST"
                action="/login"
                class="needs-validation"
                novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input id="email"
                        type="email"
                        class="form-control"
                        name="email"
                        tabindex="1"
                        required
                        autofocus>
                    <div class="invalid-feedback">
                        Masukan Email Anda
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password"
                            class="control-label">Password</label>
                        <div class="float-right">
                            {{-- <a href="/forgot-password"
                                class="text-small">
                                Lupa Kata Sandi?
                            </a> --}}
                        </div>
                    </div>
                    <input id="password"
                        type="password"
                        class="form-control"
                        name="password"
                        tabindex="2"
                        required>
                    <div class="invalid-feedback">
                        Masukan Kata Sandi Anda
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4">
                        Masuk
                    </button>
                </div>
            </form>

        </div>
    </div>
    



@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @include('scripts.swal-pop-up')

@endpush
