@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h6 class="my-4 text-gray-800"><a href="/"><i class="fas fa-home fa-sm fa-fw mr-2"></i> </a>Data Karyawan</h6>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary mb-2 my-sm-auto">Tabel Karyawan</h5>
            <a href="/users/create" class="btn btn-primary btn-sm my-auto">Buat Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-0">No.</th>
                            <th class="border-0">Nama</th>
                            <th class="border-0">Username</th>
                            <th class="border-0">Jabatan</th>
                            <th class="border-0">Lane</th>
                            <th class="border-0"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                            <tr>
                                <td>{{ $loop->iteration + $data->perPage() * ($data->currentPage() - 1) }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->nama_jabatan }}</td>
                                <td>{{ $user->lane ?? '-' }}</td>
                                <td>
                                    <a href="/users/{{ $user->id }}/edit"><i
                                            class="fas fa-pen fa-sm fa-fw mr-2 text-warning"></i> </a>
                                    <i role="button" onclick="setUser({{ $user }})"
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Karyawan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data karyawan <strong><span id="textDeleteUser"></span></strong>?
                    <br>
                    <br>
                    <span><i class="fas fa-info-circle fa-sm mr-2"></i>Tindakan ini tidak dapat dibatalkan.</span>
                </div>
                <form id="formDeleteUser" class="modal-footer" method="POST">
                    @csrf
                    @method('delete')

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let user = {};
        const formDelete = document.getElementById('formDeleteUser');
        const text = document.getElementById('textDeleteUser');

        const setUser = (userData) => {
            user = userData;

            formDeleteUser.setAttribute('action', `/users/${user.id}`)
            text.innerHTML = user.nama;
        }
    </script>
@endsection
