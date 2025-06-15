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

    {{-- Upload File --}}
    <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="form-group">
            <input type="file" name="file" required class="form-control-file">
        </div>
        <button type="submit" class="btn btn-info mt-2">Upload</button>
    </form>

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
                        <form action="{{ route('file.destroy', $file->id) }}" method="POST" class="d-inline form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-hapus">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
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
