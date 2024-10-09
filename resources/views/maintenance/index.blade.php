@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a>Data Pemeliharaan Mesin
    </h6>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between flex-wrap py-3">
            <h5 class="font-weight-bold text-primary my-sm-auto m-0 mb-2">Tabel Pemeliharaan Mesin</h5>
            <a href="{{ route('maintenances.create') }}" class="btn btn-primary btn-sm my-auto">Buat Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-0">No.</th>
                            <th class="border-0">Nama Mesin</th>
                            <th class="border-0">Deskripsi</th>
                            <th class="border-0">Gudang</th>
                            <th class="border-0">Status</th>
                            <th class="border-0"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration + $data->perPage() * ($data->currentPage() - 1) }}</td>
                                <td>{{ $item->mesin?->nama_mesin }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->mesin?->gudang?->nama_gudang }}</td>
                                <td>{{ $item->in_progress ? 'In Progress' : 'Selesai' }}</td>
                                <td>
                                    <a href="{{ route('maintenances.edit', $item) }}">
                                        <button class="border-0 mr-2">
                                            <i class="fas fa-pen fa-sm fa-fw text-warning"></i>
                                        </button>
                                    </a>

                                    <button
                                        onclick="setSelected({{ $item->toJson() }}, '{{ route('maintenances.destroy', $item) }}')"
                                        class="border-0" data-toggle="modal" data-target="#deleteModal">
                                        <i class="fas fa-trash fa-sm fa-fw text-danger"></i>
                                    </button>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pemeliharaan Mesin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data pemeliharaan mesin <strong><span id="textDelete"></span></strong>?
                    <br>
                    <br>
                    <span><i class="fas fa-info-circle fa-sm mr-2"></i>Tindakan ini tidak dapat dibatalkan.</span>
                </div>
                <form id="formDelete" class="modal-footer" method="POST">
                    @csrf
                    @method('delete')

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const formDelete = document.getElementById('formDelete');
        const text = document.getElementById('textDelete');

        const setSelected = (data, urlAction) => {
            formDelete.setAttribute('action', urlAction)
            text.innerHTML = data.mesin.nama_mesin;
        }
    </script>
@endsection
