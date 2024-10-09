@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a>Data Peminjaman</h6>

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
    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between flex-wrap py-3">
            <h5 class="font-weight-bold text-primary my-sm-auto m-0 mb-2">Loan Table</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-0">No.</th>
                            <th class="border-0">Mesin</th>
                            <th class="border-0">Peminjam</th>
                            <th class="border-0">Tanggal Pinjam</th>
                            <th class="border-0">Tanggal Kembali</th>
                            <th class="border-0">Gudang</th>
                            <th class="border-0">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration + $data->perPage() * ($data->currentPage() - 1) }}</td>
                                <td>{{ $item->mesin?->nama_mesin }}</td>
                                <td>{{ $item->peminjam?->nama }}</td>
                                <td>{{ $item->tgl_pinjam->isoFormat('DD MMMM Y - HH:mm') }}</td>
                                <td>{{ $item->tgl_kembali?->isoFormat('DD MMMM Y - HH:mm') ?? '-' }}</td>
                                <td>{{ $item->mesin?->gudang?->nama_gudang }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>
@endsection
