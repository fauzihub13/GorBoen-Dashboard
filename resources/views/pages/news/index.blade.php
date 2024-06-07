@extends('layouts.app')

@section('title', 'Berita')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css"> --}}

    {{-- <link rel="stylesheet" href="{{ asset('library/datatables/update/DataTables-1.10.16/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/update/Select-1.2.4/css/select.bootstrap4.min.css') }}"> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">




@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Berita</h1>
                <div class="section-header-button">
                    <a href="{{ route('news.create') }}" class="btn btn-primary">Tambah Berita</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Berita</a></div>
                    <div class="breadcrumb-item">Semua Berita</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        {{-- @include('layouts.alert') --}}
                    </div>
                </div>
                <h2 class="section-title">Berita</h2>
                <p class="section-lead">
                    Anda bisa melihat, mengedit, menghapus, dan lainnya.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Semua Berita</h4>
                            </div>
                            <div class="">
                                {{-- <div class="clearfix mb-3"></div> --}}
                                <div class="table-responsive card-body ">
                                    <table class=" table" id="table-news">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Judul</th>
                                                <th>Detail Berita</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php

                                            if (isset($dataNews) && is_array($dataNews) && !empty($dataNews))
                                                $newsDB = $dataNews;
                                            else
                                                $newsDB = 0;

                                            $counter = 0;
                                            $activeRow = "active";

                                            if($newsDB>0){
                                                foreach ($newsDB as $value) {
                                                    $counter +=1;

                                                    // var_dump($newsDB);?>

                                                        <tr class="mt-2">
                                                            <td>{{ $counter }}
                                                            </td>
                                                            <td>


                                                                {{($value->tanggal) }}
                                                            </td>
                                                            <td>
                                                                {{ substr($value->judul,0, 32) }}
                                                            </td>
                                                            <td>{{ substr($value->detail_berita, 0,26) }}</td>
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    <a href='{{ route('news.edit', $value->_id) }}'
                                                                        class="btn btn-sm btn-info btn-icon">
                                                                        <i class="fas fa-edit"></i>
                                                                        Edit
                                                                    </a>

                                                                    {{-- <form action="{{ route('news.destroy', $value->_id) }}" method="POST"
                                                                        class="ml-2">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}" />
                                                                        <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                            <i class="fas fa-times"></i> Delete
                                                                        </button>
                                                                    </form> --}}

                                                                    <form id="deleteForm{{ $value->_id }}" action="{{ route('news.destroy', $value->_id) }}" method="POST" class="ml-2"
                                                                        onsubmit="return confirmDelete(event, '{{ $value->_id }}')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                                        <button type="submit" class="btn btn-sm btn-danger btn-icon">
                                                                            <i class="fas fa-times"></i> Delete
                                                                        </button>
                                                                    </form>


                                                                </div>
                                                            </td>
                                                        </tr>

                                            <?php

                                                }
                                            } else{
                                                echo
                                                    "<div class='row'>
                                                        <h2>Maaf, tidak ada produk untuk saat ini...</h2>
                                                    </div>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- {{ $news->withQueryString()->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js')  }}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>


    {{-- <script src="{{ asset('library/datatables/update/datatables.min.js') }}"></script>
    <script src="{{ asset('library/datatables/update/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables/update/Select-1.2.4/js/dataTables.select.min.js') }}"></script> --}}


    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script>
        let table = new DataTable('#table-news');
        $(document).ready(function(){

        })
    </script>
@endpush