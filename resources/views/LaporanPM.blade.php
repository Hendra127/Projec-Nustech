@extends('layouts.user_type.auth')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
        min-height: 100vh;
    }
    .btn-magenta {
        background-color: #d200aa;
        color: white;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
        text-align: center;
        padding: 10px 15px;
        font-size: 14px;
        white-space: nowrap;
    }

    .table thead th {
        background-color: #2c3e50;
        color: #fff;
    }

    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }
</style>

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
                            <a href="{{ url('tables') }}" class="text-decoration-none d-block">Data All Sites</a>
                            <a href="{{ route('laporanPM') }}" class="text-decoration-none d-block">Laporan PM</a>
                            <a href="{{ route('pmliberta') }}" class="text-decoration-none d-block">PM Liberta 2025</a>
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
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-end align-items-center mb-3" style="position: absolute; top: 10px; right: 30px; z-index: 10;">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User Menu">
                <i class="fa fa-user-circle fa-2x text-primary"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ url('user-profile') }}">
                        <i class="fa fa-user me-2"></i> User Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ url('logout') }}">
                        <i class="fa fa-sign-out me-2"></i> Logout
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ url('logout') }}">
                        <i class="fa fa-sign-out me-2"></i> Users Managemen
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <style>
        .btn-custom {
            font-size: 0.75rem;
            padding: 0.3rem 1rem;           /* <--- ini yang bikin lebih kecil */
            border-radius: 12px;
            transition: all 0.2s ease-in-out;
        }

        .btn-inactive {
            background-color: transparent;
            border: 2px solid #c026d3;
            color: black;
        }

        .btn-active {
            background-color: #22c55e;
            color: black;
            border: 2px solid #22c55e;
        }

        .btn-inactive:hover {
            background-color: #f0f0f0;
        }
    </style>
    <div class="content"> 
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12 col-md-12 d-flex justify-content gap-3" style="font-family: 'Quicksand', sans-serif;">
                    <a href="{{ url('tables') }}"
                        class="btn-custom {{ Request::is('tables') ? 'btn-active' : 'btn-inactive' }}">
                        Data All Sites
                    </a>

                    <a href="{{ url('datapass') }}"
                        class="btn-custom {{ Request::is('datapass') ? 'btn-active' : 'btn-inactive' }}">
                        Data Manajemen Password
                    </a>

                    <a href="{{ route('laporanPM') }}"
                        class="btn-custom {{ Request::routeIs('laporanPM') ? 'btn-active' : 'btn-inactive' }}">
                        Laporan PM
                    </a>

                    <a href="{{ route('pmliberta') }}"
                        class="btn-custom {{ Request::routeIs('pmliberta') ? 'btn-active' : 'btn-inactive' }}">
                        PM Liberta 2025
                    </a>
                    <a href="{{ route('summary') }}"
                        class="btn-custom {{ Request::routeIs('summary') ? 'btn-active' : 'btn-inactive' }}">
                        Summary PM
                    </a>
                </div>
            </div>
        </div>
    </div>
    @php
        $role = Auth::user()->role;
    @endphp
    <div class="card shadow-sm p-4">
        {{-- Tombol dan Search --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <!-- Tombol Export, Import, Tambah -->
            <div class="d-flex gap-2 mb-2">
                @if (in_array($role, ['admin', 'superadmin']))
                <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal" title="Tambah Data">
                    <i class="fa fa-plus"></i>
                </a>
                <a href="#" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#importModal" title="Import Data">
                    <i class="fa fa-upload"></i>
                </a>
                @endif
                <a href="{{ route('laporanPM.export') }}" class="btn btn-outline-success btn-sm" title="Export Data">
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <!-- Form Search -->
            <form action="{{ route('laporanPM') }}" method="GET">
                <div class="input-group input-group-sm" style="width: 220px;">
                    <input type="text" name="search" class="form-control" placeholder="Site ID, Lokasi Site, Kab, Prov, PM Bulan, Teknisi" value="{{ request()->query('search') }}">
                    <span class="input-group-text" style="cursor: pointer;" onclick="this.closest('form').submit()">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </form>

        {{-- Tabel --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>TANGGAL SUBMIT</th>
                        <th>SITE ID</th>
                        <th>LOKASI SITE</th>
                        <th>KABUPATEN/KOTA</th>
                        <th>PROVINSI</th>
                        <th>PM BULAN</th>
                        <th>LAPORAN BA PM</th>
                        <th>TEKNISI</th>
                        <th>KENDALA</th>
                        <th>ACTION</th>
                        <th>KET. TAMBAHAN</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $row)
                    <tr>
                        <td>{{ $loop->iteration + ($laporan->currentPage() - 1) * $laporan->perPage() }}</td>
                        <td>{{ $row->tanggal_submit }}</td>
                        <td>{{ $row->site_id }}</td>
                        <td class="text-start">{{ $row->lokasi_site }}</td>
                        <td>{{ $row->kabupaten_kota }}</td>
                        <td>{{ $row->provinsi }}</td>
                        <td>{{ $row->pm_bulan }}</td>
                        <td>{{ $row->laporan_ba_pm }}</td>
                        <td>{{ $row->teknisi }}</td>
                        <td class="text-start">{{ $row->masalah_kendala }}</td>
                        <td>{{ $row->action }}</td>
                        <td>{{ $row->ket_tambahan }}</td>
                        <td>{{ $row->status_laporan }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('laporanPM.update', $row->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Laporan PM</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="date" name="tanggal_submit" class="form-control mb-2" required value="{{ $row->tanggal_submit }}">
                                            <input type="text" name="site_id" class="form-control mb-2" required value="{{ $row->site_id }}">
                                            <input type="text" name="lokasi_site" class="form-control mb-2" required value="{{ $row->lokasi_site }}">
                                            <input type="text" name="kabupaten_kota" class="form-control mb-2" required value="{{ $row->kabupaten_kota }}">
                                            <input type="text" name="provinsi" class="form-control mb-2" required value="{{ $row->provinsi }}">
                                            <input type="text" name="pm_bulan" class="form-control mb-2" required value="{{ $row->pm_bulan }}">
                                            <input type="text" name="teknisi" class="form-control mb-2" required value="{{ $row->teknisi }}">
                                            <input type="text" name="status_laporan" class="form-control mb-2" required value="{{ $row->status_laporan }}">
                                            <input type="text" name="laporan_ba_pm" class="form-control mb-2" value="{{ $row->laporan_ba_pm }}" placeholder="Laporan BA PM">
                                            <input type="text" name="masalah_kendala" class="form-control mb-2" value="{{ $row->masalah_kendala }}" placeholder="Kendala">
                                            <input type="text" name="action" class="form-control mb-2" value="{{ $row->action }}" placeholder="Action">
                                            <input type="text" name="ket_tambahan" class="form-control mb-2" value="{{ $row->ket_tambahan }}" placeholder="Keterangan Tambahan">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $laporan->links() }}
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('laporanPM.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Laporan PM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="date" name="tanggal_submit" class="form-control mb-2" required placeholder="Tanggal Submit">
                    <input type="text" name="site_id" class="form-control mb-2" required placeholder="Site ID">
                    <input type="text" name="lokasi_site" class="form-control mb-2" required placeholder="Lokasi Site">
                    <input type="text" name="kabupaten_kota" class="form-control mb-2" required placeholder="Kabupaten/Kota">
                    <input type="text" name="provinsi" class="form-control mb-2" required placeholder="Provinsi">
                    <input type="text" name="pm_bulan" class="form-control mb-2" required placeholder="PM Bulan">
                    <input type="text" name="teknisi" class="form-control mb-2" required placeholder="Teknisi">
                    <input type="text" name="status_laporan" class="form-control mb-2" required placeholder="Status">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Import --}}
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('laporanPM.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Laporan PM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Pilih File Excel (.xlsx/.xls/.csv)</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Import</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('scripts')
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @elseif (session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: '{{ session('warning') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @elseif (session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: '{{ session('info') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>
@endsection
