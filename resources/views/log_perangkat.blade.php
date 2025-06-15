@extends('layouts.user_type.auth')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
        min-height: 100vh;
    }

    table.table.table-hover tbody tr:hover {
        background-color: transparent !important;
    }

    .card {
        overflow-x: auto;
    }

    table.table {
        min-width: 1000px;
    }

    .btn-magenta {
        background-color: #d200aa;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: inherit !important;
    }
</style>

<div class="container-fluid mt-4">
    <div class="card shadow-sm p-4">
        <h4 class="mb-4" style="text-align: center;">Data Log Pergantian Perangkat</h4>

        {{-- Tombol dan Pencarian --}}
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            {{-- Tombol kiri --}}
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ url('/log_perangkat/export') }}" class="btn btn-success">
                    <i class="fa fa-file-excel-o"></i> Export Excel
                </a>
                <a href="{{ route('logperangkat.export.pdf') }}" class="btn btn-danger">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fa fa-upload"></i> Import Excel
                </button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>

            {{-- Form pencarian kanan --}}
            <form method="GET" action="{{ route('log_perangkat') }}" class="d-flex mb-3">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari Nama Site..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-magenta btn-sm mb-0">Search</button>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">SITE ID</th>
                        <th class="text-center">NAMA SITE</th>
                        <th class="text-center">PERANGKAT</th>
                        <th class="text-center">TANGGAL</th>
                        <th class="text-center">SN LAMA</th>
                        <th class="text-center">SN BARU</th>
                        <th class="text-center">KETERANGAN</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                        <td class="text-center">{{ $row->id }}</td>
                        <td class="text-center">{{ $row->site_id }}</td>
                        <td>{{ $row->nama }}</td>
                        <td class="text-center">{{ $row->perangkat }}</td>
                        <td class="text-center">{{ $row->tanggal_pergantian }}</td>
                        <td class="text-center">{{ $row->sn_lama }}</td>
                        <td class="text-center">{{ $row->sn_baru }}</td>
                        <td>{{ $row->keterangan }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <a href="{{ url('/log_perangkat/delete/'.$row->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ url('/log_perangkat/update/'.$row->id) }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="site_id" class="form-control mb-2" value="{{ $row->site_id }}">
                                        <input type="text" name="sitename" class="form-control mb-2" value="{{ $row->nama }}">
                                        <input type="text" name="perangkat" class="form-control mb-2" value="{{ $row->perangkat }}">
                                        <input type="date" name="tanggal_pergantian" class="form-control mb-2" value="{{ $row->tanggal_pergantian }}">
                                        <input type="text" name="sn_lama" class="form-control mb-2" value="{{ $row->sn_lama }}">
                                        <input type="text" name="sn_baru" class="form-control mb-2" value="{{ $row->sn_baru }}">
                                        <textarea name="keterangan" class="form-control">{{ $row->keterangan }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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

    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ url('/log_perangkat/store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Tambah Data Pergantian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="site_id" class="form-control mb-2" placeholder="Site ID">
                        <input type="text" name="sitename" class="form-control mb-2" placeholder="Nama Site">
                        <input type="text" name="perangkat" class="form-control mb-2" placeholder="Perangkat">
                        <input type="date" name="tanggal_pergantian" class="form-control mb-2">
                        <input type="text" name="sn_lama" class="form-control mb-2" placeholder="SN Lama">
                        <input type="text" name="sn_baru" class="form-control mb-2" placeholder="SN Baru">
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan (opsional)"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Import --}}
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ url('/log_perangkat/import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Import Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="file" class="form-control" required accept=".xls,.xlsx">
                        <small class="text-muted">File harus dalam format Excel (.xls atau .xlsx)</small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script Tambahan --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
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
