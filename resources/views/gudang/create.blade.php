@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a> <a
            href="/warehouses">Daftar Gudang</a> / {{ isset($data) ? "Edit Data / $data->nama_gudang" : 'Buat Baru' }}</h6>

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ isset($data) ? 'Edit' : 'Buat' }} Data Gudang</h5>
        </div>
        <div class="card-body">
            <form action="/warehouses/{{ isset($data) ? $data?->id : '' }}" method="POST">
                @csrf

                @if (isset($data))
                    @method('PUT')
                @endif

                <div class="form-group row">
                    <label for="staticNama" class="col-sm-2 col-form-label">Nama Gudang</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_gudang" class="form-control @error('nama_gudang') is-invalid @enderror"
                            id="staticNama" value="{{ isset($data) ? $data?->nama_gudang : old('nama_gudang') }}">
                        @error('nama_gudang')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticLokasi" class="col-sm-2 col-form-label">Lokasi Gudang</label>
                    <div class="col-sm-10">
                        <input type="text" name="lokasi_gudang" class="form-control @error('lokasi_gudang') is-invalid @enderror"
                            id="staticLokasi" value="{{ isset($data) ? $data?->lokasi_gudang : old('lokasi_gudang') }}">
                        @error('lokasi_gudang')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticJabatan" class="col-sm-2 col-form-label">Petugas</label>
                    <div class="col-sm-10">
                        <select name="id_petugas_gudang"
                            class="custom-select @error('id_petugas_gudang') is-invalid @enderror" id="staticJabatan">
                            <option selected disabled>Pilih Petugas</option>
                            @foreach ($petugas as $item)
                                <option @selected(isset($data) ? $item->id == $data->id_petugas_gudang : $item->id == old('id_petugas_gudang')) value="{{ $item->id }}">{{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_petugas_gudang')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <a href="/warehouses" class="btn-sm btn btn-secondary ml-auto mr-3">Batal</a>
                    <button type="submit" class="btn-sm btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
