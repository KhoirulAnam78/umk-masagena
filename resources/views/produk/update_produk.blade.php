@extends('produk.main')

@section('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    {{-- <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/admin/css/trix.css">
    <script type="text/javascript" src="{{ url('') }}/assets/admin/js/trix.js"></script>
    <style>
        trix-toolbar [data-trix-button-group=file-tools] {
            display: none;
        }
    </style> --}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Produk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Produk</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="/produk/{{ $produk->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf

                {{-- baris input pertama --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nama">Nama Produk</label>
                            <input required type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ old('nama', $produk->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" required name="deskripsi" id="deskripsi">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                </div>

                {{-- baris ke2 --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="berat">Jenis Kemasan</label>
                            <input required type="text" class="form-control @error('berat') is-invalid @enderror"
                                id="berat" name="berat" value="{{ old('berat', $produk->berat) }}">
                            @error('berat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input required type="number" class="form-control @error('harga') is-invalid @enderror"
                                id="harga" name="harga" value="{{ old('harga', $produk->harga) }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- baris ke3 --}}
                <div class="row">
                    <div class="col-6">

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            @if ($produk->image)
                                <img class="img-preview img-thumbnail col-sm-3 d-block mb-1"
                                    src="{{ asset('/storage/' . $produk->image) }}">
                            @else
                                <img class="img-preview img-thumbnail col-sm-3 d-block mb-1"
                                    src="{{ asset('/storage/produk-images/default.png') }}">
                            @endif
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name='image' onchange="previewImage()">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('script')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    <script>
        // document.addListener('trix-file-accept', function(e) {
        //     e.preventDefault();
        // });

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }

        }
    </script>
@endsection
