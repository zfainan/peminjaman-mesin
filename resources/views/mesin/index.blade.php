@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a>Data Mesin</h6>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary mb-2 my-sm-auto">Tabel Mesin</h5>
            <a href="/engines/create" class="btn btn-primary btn-sm my-auto">Tambah Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-0">No.</th>
                            <th class="border-0">QR</th>
                            <th class="border-0">Nama Mesin</th>
                            <th class="border-0">Gudang</th>
                            <th class="border-0"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $mesin)
                            <tr>
                                <td>{{ $loop->iteration + $data->perPage() * ($data->currentPage() - 1) }}</td>
                                <td>
                                    <button onclick="generateQr({{ $mesin }})" data-toggle="modal"
                                        data-target="#qrModal" class="btn btn-sm btn-light">
                                        <i class="fas fa-qrcode"></i>
                                    </button>
                                </td>
                                <td>{{ $mesin->nama_mesin }}</td>
                                <td>{{ $mesin->gudang?->nama_gudang }}</td>
                                <td>
                                    <a href="/engines/{{ $mesin->id }}/edit"><i
                                            class="fas fa-pen fa-sm fa-fw mr-2 text-warning"></i> </a>
                                    <i role="button" onclick="setMesin({{ $mesin }})"
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Mesin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus <strong><span id="textDeleteGudang"></span></strong>?
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

    <!-- QR Modal-->
    <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QR Code Mesin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalQrBody">
                        <div id="qrcode" class="d-flex p-4 justify-content-center"></div>
                        <p class="text-center text-dark" id="text-mesin"></p>
                    </div>

                    <div class="d-flex">
                        <button class="btn btn-primary mx-auto" id="printButton" type="button">Cetak</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ Vite::asset('resources/js/vendor/qrcode.min.js') }}"></script>

    <script>
        const formDelete = document.getElementById('formDeleteGudang');
        const text = document.getElementById('textDeleteGudang');

        const setMesin = (data) => {
            formDelete.setAttribute('action', `/engines/${data.id}`)
            text.innerHTML = data.nama_mesin;
        }

        const qrcode = new QRCode("qrcode");
        let selectedMesin = {};
        let textMesin = document.getElementById('text-mesin');

        const generateQr = (mesin) => {
            selectedMesin = mesin;
            qrcode.makeCode(mesin.id);
            textMesin.innerHTML = mesin.nama_mesin;
        }
    </script>
@endsection

@section('script')
    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            // Salin konten modal ke elemen cetak sementara
            const printContent = document.getElementById('modalQrBody').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Cetak Modal</title></head><body>');
            printWindow.document.write(printContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
@endsection
