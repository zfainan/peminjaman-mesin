@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a>Riwayat Peminjaman</h6>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary mb-2 my-sm-auto">History Table</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-0">No.</th>
                            <th class="border-0">Mesin</th>
                            <th class="border-0">Tanggal Pinjam</th>
                            <th class="border-0">Tanggal Kembali</th>
                            <th class="border-0">Gudang</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration + $data->perPage() * ($data->currentPage() - 1) }}</td>
                                <td>{{ $item->mesin?->nama_mesin }}</td>
                                <td>{{ $item->tgl_pinjam->diffForHumans() }}</td>
                                <td>{{ $item->tgl_kembali?->diffForHumans() ?? '-' }}</td>
                                <td>{{ $item->mesin?->gudang?->nama_gudang }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    @if ($item->tgl_kembali == null)
                                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#kembaliModal"
                                            onclick="setPeminjaman({{ $item }}, '{{ route('borrow.return', ['id' => $item->id]) }}')">Kembalikan</button>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>

    <!-- confirm Modal-->
    <div class="modal fade" id="kembaliModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pengembalian Mesin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin mengembalikan <strong><span id="textNamaMesin"></span></strong>?
                </div>
                <form id="formKembali" class="modal-footer" method="POST">
                    @csrf

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Kembalikan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const formKembali = document.getElementById('formKembali');
        const text = document.getElementById('textNamaMesin');

        const setPeminjaman = (data, link) => {
            formKembali.setAttribute('action', link)
            text.innerHTML = data.mesin.nama_mesin;
        }
    </script>
@endsection
