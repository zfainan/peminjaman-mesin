@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a>Data Gudang</h6>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary mb-2 my-sm-auto">Tabel Gudang</h5>
            <a href="/warehouses/create" class="btn btn-primary btn-sm my-auto">Tambah Gudang</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-0">No.</th>
                            <th class="border-0">Nama Gudang</th>
                            <th class="border-0">Lokasi Gudang</th>
                            <th class="border-0">Petugas</th>
                            <th class="border-0"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $gudang)
                            <tr>
                                <td>{{ $loop->iteration + $data->perPage() * ($data->currentPage() - 1) }}</td>
                                <td>{{ $gudang->nama_gudang }}</td>
                                <td>{{ $gudang->lokasi_gudang }}</td>
                                <td>{{ $gudang->nama_petugas }}</td>
                                <td>
                                    <a href="/warehouses/{{ $gudang->id }}/edit"><i
                                            class="fas fa-pen fa-sm fa-fw mr-2 text-warning"></i> </a>
                                    <i role="button" onclick="setGudang({{ $gudang }})"
                                        class="fas fa-trash fa-sm fa-fw mr-2 text-danger" data-toggle="modal"
                                        data-target="#deleteUserModal"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>

    <!-- delete Modal-->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Gudang</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data gudang <strong><span id="textDeleteGudang"></span></strong>?
                    <br>
                    <br>
                    <span><i class="fas fa-info-circle fa-sm mr-2"></i>Tindakan ini tidak dapat dibatalkan.</span>
                </div>
                <form id="formDeleteGudang" class="modal-footer" method="POST">
                    @csrf
                    @method('delete')

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const formDelete = document.getElementById('formDeleteGudang');
        const text = document.getElementById('textDeleteGudang');

        const setGudang = (data) => {
            formDelete.setAttribute('action', `/warehouses/${data.id}`)
            text.innerHTML = data.nama_gudang;
        }
    </script>
@endsection
