@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a> <a href="/users">Data
            Karyawan</a> / {{ isset($data) ? "Edit Data / $data->nama" : 'Buat Baru' }}</h6>

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ isset($data) ? 'Edit' : 'Buat' }} Data Karyawan</h5>
        </div>
        <div class="card-body">
            <form action="/users/{{ isset($data) ? $data?->id : '' }}" method="POST">
                @csrf

                @if (isset($data))
                    @method('PUT')
                @endif

                <div class="form-group row">
                    <label for="staticNama" class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            id="staticNama" value="{{ isset($data) ? $data?->nama : old('nama') }}">
                        @error('nama')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticJabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <select name="id_jabatan" class="custom-select @error('id_jabatan') is-invalid @enderror"
                            id="staticJabatan" onchange="toggleJabatanInput()">
                            <option selected disabled>Pilih Jabatan</option>
                            @foreach ($jabatan as $item)
                                <option @selected(isset($data) ? $item->id_ == $data->id_jabatan : $item->id_ == old('id_jabatan')) value="{{ $item->id_ }}">{{ $item->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_jabatan')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticUsername" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="staticUsername" value="{{ isset($data) ? $data->username : old('username') }}">
                        @error('username')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="inputPassword">
                        @error('password')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                        @if (isset($data))
                            <span class="text-xs" role="alert">Kosongkan jika tidak ingin mengubah password</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row" id="staticLane">
                    <label for="inputLane" class="col-sm-2 col-form-label">Lane</label>
                    <div class="col-sm-10">
                        <input type="text" name="lane" class="form-control @error('lane') is-invalid @enderror"
                            id="inputLane" value="{{ isset($data) ? $data->lane : old('lane') }}">
                        @error('lane')
                            <span class="text-xs text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <a href="/users" class="btn-sm btn btn-secondary ml-auto mr-3">Batal</a>
                    <button type="submit" class="btn-sm btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const selectElement = document.getElementById('staticJabatan');
        const additionalInputElement = document.getElementById('staticLane');
        const laneInput = document.getElementById('inputLane');

        function toggleJabatanInput() {

            if (selectElement.value ==
                {{ $jabatan->firstWhere('nama_jabatan', 'Kepala Lane')?->id_ }}) {
                additionalInputElement.style.display = 'flex';
                laneInput.removeAttribute('disabled')
            } else {
                additionalInputElement.style.display = 'none';
                laneInput.setAttribute('disabled', '')
            }
        }

        toggleJabatanInput()
    </script>
@endsection
