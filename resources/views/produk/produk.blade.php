@extends('produk.main')


@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ url('') }}/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Produk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
        </div>
        @if (session()->has('Sukses'))
            <div class="col-12 mt-2">
                <div class="alert alert-success" role="alert">
                    {{ session('Sukses') }}
                </div>
            </div>
        @endif
        <div class="col-2 mt-1">
            <!-- Button trigger modal -->
            <a class="btn btn-primary" href="/produk/create">
                Tambah
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Jenis Kemasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($produk as $b)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    @if ($b->image)
                                        <img src="{{ asset('storage/' . $b->image) }}" class="img-thumbnail" width="100"
                                            height='110' alt="">
                                    @else
                                        <img src="{{ asset('storage/produk-images/default.png') }}" class="img-thumbnail"
                                            width="100" height='110' alt="">
                                    @endif
                                </td>
                                <td>{{ $b->nama }}</td>
                                <td>{{ $b->deskripsi }}</td>
                                <td>{{ $b->harga }}</td>
                                <td>{{ $b->berat }}</td>

                                <td>
                                    <a href="/produk/{{ $b->id }}/edit" class="btn btn-info"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="/produk/{{ $b->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Benar ingin menghapus data?')"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ url('') }}/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('') }}/assets/admin/js/demo/datatables-demo.js"></script>
@endsection
