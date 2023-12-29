@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a> <a
            href="/engines">Data Mesin</a> / {{ isset($data) ? "Edit Data / $data->nama_mesin" : 'Buat Baru' }}</h6>

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ isset($data) ? 'Edit' : 'Buat' }} Data Mesin</h5>
        </div>
        <div class="card-body">
            <form action="/engines/{{ isset($data) ? $data?->id : '' }}" method="POST">
                @csrf

                @if (isset($data))
                    @method('PUT')
                @endif

                <div class="form-group row">
                    <label for="staticNama" class="col-sm-2 col-form-label">Nama Mesin</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_mesin" class="form-control @error('nama_mesin') is-invalid @enderror"
                            id="staticNama" value="{{ isset($data) ? $data?->nama_mesin : old('nama_mesin') }}">
                        @error('nama_mesin')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticJabatan" class="col-sm-2 col-form-label">Gudang</label>
                    <div class="col-sm-10">
                        <select name="id_gudang"
                            class="custom-select @error('id_gudang') is-invalid @enderror" id="staticJabatan">
                            <option selected disabled>Pilih Gudang</option>
                            @foreach ($gudang as $item)
                                <option @selected(isset($data) ? $item->id == $data->id_gudang : $item->id == old('id_gudang')) value="{{ $item->id }}">{{ $item->nama_gudang }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_gudang')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <a href="/engines" class="btn-sm btn btn-secondary ml-auto mr-3">Batal</a>
                    <button type="submit" class="btn-sm btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
