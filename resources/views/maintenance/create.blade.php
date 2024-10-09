@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a> <a
            href="{{ route('maintenances.index') }}">Data Pemeliharaan Mesin</a> /
        {{ isset($data) ? 'Edit Data' : 'Buat Baru' }}</h6>

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header py-3">
            <h5 class="font-weight-bold text-primary m-0">{{ isset($data) ? 'Edit' : 'Buat' }} Data Pemeliharaan Mesin</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($data) ? route('maintenances.update', $data) : route('maintenances.store') }}"
                method="POST">
                @csrf

                @if (isset($data))
                    @method('PUT')
                @endif

                <div class="form-group row">
                    <label for="staticJabatan" class="col-sm-2 col-form-label">Mesin</label>
                    <div class="col-sm-10">
                        <select name="id_mesin" class="custom-select @error('id_mesin') is-invalid @enderror"
                            id="staticJabatan">
                            <option selected disabled>Pilih Mesin</option>
                            @foreach ($mesin as $item)
                                <option @selected(isset($data) ? $item->id == $data->id_mesin : $item->id == old('id_mesin')) value="{{ $item->id }}">{{ $item->nama_mesin }} -
                                    {{ $item->gudang?->nama_gudang }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_mesin')
                            <span class="text-danger text-xs" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi Perbaikan</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                            rows="3">{{ isset($data) ? $data->description : old('description') }}</textarea>

                        @error('description')
                            <span class="text-danger text-xs" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="in_progress" class="col-sm-2 col-form-label">Status Perbaikan</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="in_progress" id="in_progress1"
                                @checked(isset($data) ? $data->in_progress : true) value="1">
                            <label class="form-check-label" for="in_progress1">
                                In Progress
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="in_progress" id="in_progress2"
                                @checked(isset($data) ? !$data->in_progress : false) value="0">
                            <label class="form-check-label" for="in_progress2">
                                Selesai
                            </label>
                        </div>

                        @error('in_progress')
                            <span class="text-danger text-xs" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <a href="{{ route('maintenances.index') }}" class="btn-sm btn btn-secondary ml-auto mr-3">Batal</a>
                    <button type="submit" class="btn-sm btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
