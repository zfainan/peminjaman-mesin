@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a>Pinjam Mesin</h6>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card mb-4 shadow">
        <div class="card-header d-flex flex-wrap py-3">
            <h5 class="font-weight-bold text-primary my-auto mb-2 mr-auto">Pilih Mesin</h5>
            <a href="#" class="btn btn-primary my-auto" data-toggle="modal" data-target="#scanModal">Scan QR</a>
            <form class="form-inline ml-sm-2 my-md-0 mw-100 navbar-search my-2 mt-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light" placeholder="Cari nama mesin..."
                        aria-label="Search" aria-describedby="basic-addon2" value="{{ request()->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-hover table">
                    <thead>
                        <tr>
                            <th class="border-0">No.</th>
                            <th class="border-0">Nama Mesin</th>
                            <th class="border-0">Gudang</th>
                            <th class="border-0">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataMesin as $mesin)
                            <tr
                                @if ($mesin->is_available) role="button" data-toggle="modal" data-target="#pinjamModal"
                                onclick="setSelectedMesin({{ $mesin->toJson() }})" @endif>
                                <td>{{ $loop->iteration + $dataMesin->perPage() * ($dataMesin->currentPage() - 1) }}</td>
                                <td>{{ $mesin->nama_mesin }}</td>
                                <td>{{ $mesin->gudang?->nama_gudang }}</td>
                                <td>
                                    @if ($mesin->is_available)
                                        <span class="badge bg-primary text-light p-2">Tersedia</span>
                                    @else
                                        <span class="badge bg-secondary text-light p-2">Tidak Tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $dataMesin->links() }}
        </div>
    </div>

    <!-- confirm Modal-->
    <div class="modal fade" id="pinjamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pinjam Mesin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin meminjam <strong><span id="textNamaMesin"></span></strong>?
                </div>
                <form id="formPinjam" action="{{ route('borrows.store') }}" class="modal-footer" method="POST">
                    @csrf

                    <input id="inputIdMesin" type="hidden" name="id_mesin">

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Pinjam</button>
                </form>
            </div>
        </div>
    </div>

    <!-- scan Modal-->
    <div class="modal fade" id="scanModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan QR Mesin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="reader"></div>
                    <div id="formScanContainer" class="d-none container py-5">

                        <span>Nama Mesin: </span>
                        <p class="font-weight-bolder text-dark" id="textScanMesin"></p>
                        <span>Gudang: </span>
                        <p class="font-weight-bolder text-dark" id="textScanGudang"></p>
                        <span>Status: </span>
                        <p class="font-weight-bolder text-dark" id="textScanStatus"></p>

                        <form id="formScan" action="{{ route('borrows.store') }}" class="form text-center" method="POST">
                            @csrf

                            <input id="inputScanIdMesin" type="hidden" name="id_mesin">

                            <button class="btn btn-primary" type="submit">Pinjam</button>
                        </form>
                    </div>
                    <div id="textScanUnavailableContainer" class="d-none container text-center">
                        <p class="font-weight-bolder text-dark" id="textScanUnavailable"></p>
                        <button class="btn btn-primary" type="button" onclick="reScan()">Scan Ulang</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        const formPinjam = document.getElementById('formPinjam');
        const text = document.getElementById('textNamaMesin');
        const input = document.getElementById('inputIdMesin');

        const setSelectedMesin = (mesin) => {
            text.innerHTML = mesin.nama_mesin;
            input.value = mesin.id;
        }
    </script>
@endsection

@section('script')
    <script>
        const scanModal = document.getElementById('scanModal')
        const reader = document.getElementById('reader')

        const formScanContainer = document.getElementById('formScanContainer')
        const formScan = document.getElementById('formScan')

        const textScanMesin = document.getElementById('textScanMesin')
        const textScanGudang = document.getElementById('textScanGudang')
        const textScanStatus = document.getElementById('textScanStatus')

        const inputScanIdMesin = document.getElementById('inputScanIdMesin');

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
            },
            /* verbose= */
            false);

        function onScanSuccess(decodedText, decodedResult) {
            axios.get(`/api/machine/${decodedText}`)
                .then((response) => {
                    html5QrcodeScanner.clear();

                    textScanMesin.innerHTML = response.data?.nama_mesin
                    textScanGudang.innerHTML = response.data?.gudang?.nama_gudang
                    textScanStatus.innerHTML = response.data?.is_available ? 'Tersedia' : 'Tidak Tersedia'

                    inputScanIdMesin.value = response.data?.id

                    reader.classList.add('d-none')
                    formScanContainer.classList.remove('d-none')
                })
                .catch((error) => {
                    console.log(error)

                    if (error.response?.data?.is_available == false) {
                        html5QrcodeScanner.clear();
                        reader.classList.add('d-none')

                        document.getElementById('textScanUnavailable').innerHTML =
                            `Mesin ${error.response.data.nama_mesin} tidak tersedia.`;

                        document.getElementById('textScanUnavailableContainer')
                            .classList.remove('d-none')
                    }
                })
        }

        function onScanFailure(error) {}

        $('#scanModal').on('show.bs.modal', function(event) {
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            reader.classList.remove('d-none')
            formScanContainer.classList.add('d-none')
        })

        $('#scanModal').on('hide.bs.modal', function(event) {
            html5QrcodeScanner.clear();
        })

        const reScan = () => {
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);

            reader.classList.remove('d-none')

            formScanContainer.classList.add('d-none')

            document.getElementById('textScanUnavailableContainer')
                .classList.add('d-none')
        }
    </script>
@endsection
