@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
  }
  .table thead th {
    background-color: #343a40;
    color: #ffffff;
    text-align: center;
    vertical-align: middle;
  }
  .btn-custom-download {
    background: #0d6efd;
    color: white;
    border-radius: 25px;
    padding: 5px 20px;
    transition: background 0.3s;
  }
  .btn-custom-download:hover {
    background: #0b5ed7;
    color: white;
  }
  .btn-danger {
    background-color: #e74c3c;
    border-color: #c0392b;
    color: white;
  }
  .btn-danger:hover {
    background-color: #c0392b;
    border-color: #a93226;
  }
</style>

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Tombol Operasional -->
<div class="d-flex justify-content-center align-items-center mb-3" style="position: absolute; top: 10px; left: 50%; transform: translateX(-50%); z-index: 10;">
  <a href="#" data-bs-toggle="modal" data-bs-target="#operasionalModal" style="text-decoration: none; color: #000;">
    <h6 class="mb-0"><strong>Operasional</strong></h6>
  </a>
</div>

<!-- Modal Operasional -->
<div class="modal fade" id="operasionalModal" tabindex="-1" aria-labelledby="operasionalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header">
                <div class="w-100 text-center mt-2 ">
                    <h5 class="modal-title" id="operasionalModalLabel">Daftar Halaman Operasional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-wrap gap-3 justify-content-start ps-6" style="flex-wrap: wrap;">
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Data Site</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('datapass') }}" class="text-decoration-none">Manajemen Password</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Tiket</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('tiket') }}" class="text-decoration-none d-block">Open Tiket</a>
                            <a href="{{ url('close/tiket') }}" class="text-decoration-none d-block">Close Tiket</a>
                            <a href="{{ url('dashboard') }}" class="text-decoration-none d-block">Detail Tiket</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Log Perangkat</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('log_perangkat') }}" class="text-decoration-none d-block">Log Perangkat</a>
                            <a href="{{ url('sparetracker') }}" class="text-decoration-none d-block">Spare Tracker</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Download</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('download_file') }}" class="text-decoration-none d-block">Download File</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Rekap SLA</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('rekap-bmn') }}" class="text-decoration-none d-block">BMN</a>
                            <a href="{{ url('rekap-sl') }}" class="text-decoration-none d-block">SL</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">To Do List</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('todolist') }}" class="text-decoration-none d-block">My Todo list</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end" style="border-top: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; filter: invert(1);"></button></div>
        </div>
    </div>
</div>
<div class="container py-4">
    <h2 class="mb-4">Download File</h2>

    {{-- Flash message with SweetAlert --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @elseif(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif

    {{-- Tombol Export Data --}}
     <div class="mb-3 d-flex flex-wrap gap-2">
        <a href="{{ route('download.tiket', ['status_tiket' => 'open']) }}" class="btn btn-outline-secondary" title="Download Tiket (OPEN)">
            <i class="fas fa-download"></i> Tiket OPEN
        </a>
        <a href="{{ route('download.tiket', ['status_tiket' => 'close']) }}" class="btn btn-outline-secondary" title="Download Tiket (CLOSE)">
            <i class="fas fa-download"></i> Tiket CLOSE
        </a>
        <a href="{{ route('export.datasite') }}" class="btn btn-outline-secondary" title="Download Semua Data Site">
            <i class="fas fa-download"></i> Site ALL
        </a>
        <a href="{{ route('download.log_perangkat') }}" class="btn btn-outline-secondary" title="Download Log Pergantian Perangkat">
            <i class="fas fa-download"></i> Log Perangkat
        </a>
        <a href="{{ route('download.datapass') }}" class="btn btn-outline-secondary" title="Download Data Password">
            <i class="fas fa-download"></i> Password
        </a>
    </div>

    {{-- Upload File (Hanya untuk superadmin) --}}
    @if(Auth::user()->role === 'superadmin')
    <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="form-group">
            <input type="file" name="file" required class="form-control-file">
        </div>
        <button type="submit" class="btn btn-info mt-2">Upload</button>
    </form>
    @endif

    {{-- Tabel File --}}
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 50px;">NO</th>
                <th>Nama File</th>
                <th style="width: 120px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($files as $file)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $file->nama_file }}</td>
                    <td class="text-center">
                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Download
                        </a>

                        @if(Auth::user()->role === 'superadmin')
                        <form action="{{ route('file.destroy', $file->id) }}" method="POST" class="d-inline form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-hapus">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada file</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Script Konfirmasi Hapus --}}
<script>
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "File yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
