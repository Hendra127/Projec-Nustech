@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
  }
</style>
<div class="container-fluid mt-4">
    <div class="card shadow-sm p-4">

        <h4 class="mb-4" style="text-align: center;">Data Password ALL Site</h4>
        
        {{-- Tombol Aksi dan Pencarian --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('datapass.export') }}" class="btn btn-success btn-sm">EXPORT</a>

                <!-- Tombol untuk membuka modal import -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                    IMPORT
                </button>

                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
            </div>

            <form action="{{ route('datapass.search') }}" method="GET" class="d-flex gap-2 mt-2 mt-sm-0">
                <input type="text" name="query" class="form-control form-control-sm" placeholder="Search by Site Name or Province">
                <button type="submit" class="btn btn-magenta btn-sm">SEARCH</button>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">SITE ID</th>
                        <th class="text-center">NAMA LOKASI</th>
                        <th class="text-center">KABUPATEN</th>
                        <th class="text-center">ADOP</th>
                        <th class="text-center">PASS AP1</th>
                        <th class="text-center">PASS AP2</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datapass as $index => $data)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $data->site_id }}</td>
                        <td>{{ $data->nama_lokasi }}</td>
                        <td>{{ $data->kabupaten }}</td>
                        <td class="text-center">{{ $data->adop }}</td>
                        <td>{{ $data->pass_ap1 }}</td>
                        <td>{{ $data->pass_ap2 }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">Edit</button>
                            <form action="{{ route('datapass.destroy', $data->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-name="{{ $data->site_id }}">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('datapass.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="site_id" class="form-control mb-2" value="{{ $data->site_id }}" required>
                                        <input type="text" name="nama_lokasi" class="form-control mb-2" value="{{ $data->nama_lokasi }}">
                                        <input type="text" name="kabupaten" class="form-control mb-2" value="{{ $data->kabupaten }}">
                                        <input type="text" name="adop" class="form-control mb-2" value="{{ $data->adop }}">
                                        <input type="text" name="pass_ap1" class="form-control mb-2" value="{{ $data->pass_ap1 }}">
                                        <input type="text" name="pass_ap2" class="form-control mb-2" value="{{ $data->pass_ap2 }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('datapass.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="site_id" class="form-control mb-2" placeholder="SITE ID" required>
                    <input type="text" name="nama_lokasi" class="form-control mb-2" placeholder="NAMA LOKASI">
                    <input type="text" name="kabupaten" class="form-control mb-2" placeholder="KABUPATEN">
                    <input type="text" name="adop" class="form-control mb-2" placeholder="ADOP">
                    <input type="text" name="pass_ap1" class="form-control mb-2" placeholder="PASS AP1">
                    <input type="text" name="pass_ap2" class="form-control mb-2" placeholder="PASS AP2">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Import --}}
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('datapass.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="file" class="form-label">Pilih File Excel</label>
                    <input type="file" name="file" class="form-control" id="file" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .btn-magenta {
        background-color: #d200aa;
        color: white;
    }
</style>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
@endif
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2500
        });
    });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const siteName = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Data dengan SITE ID ${siteName} akan dihapus dan tidak dapat dipulihkan kembali!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
