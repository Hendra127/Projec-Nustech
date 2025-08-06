@extends('layouts.user_type.auth')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<style>
  body {
    background: #FEF3E2;
    min-height: 100vh;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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
<div class="container-fluid mt-2 px-0">
    <div class="card shadow-lg border-0 rounded-4 w-100">
        <div class="card-body p-4">
            @php
            $cards = [
                [
                    'label' => 'DONE',
                    'count' => "{$doneCount}/{$totalData}"
                ],
                [
                    'label' => 'PERCENTAGE',
                    'count' => "{$donePercentage}%"
                ]
            ];
            $cardBg = 'linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229))';
        @endphp

        <div class="row justify-content-center text-center mt-2 mb-2">
            <div class="d-flex flex-row gap-2 flex-nowrap overflow-auto mb-2 justify-content-center w-100">
                @foreach($cards as $card)
                    <div class="card" style="min-width:180px; background: {{ $cardBg }}; box-shadow:0 4px 12px 0 rgba(0,0,0,0.12); border-radius:12px;">
                        <a class="d-block text-decoration-none" style="color:inherit;">
                            <div class="card-body p-2 d-flex flex-row align-items-center justify-content-center gap-2">
                                <!-- Label: tebal dan hitam -->
                                <span class="fw-bolder text-capitalize" style="font-size:10px; color:#000;">
                                    {{ $card['label'] }}
                                </span>
                                <!-- Count: angka merah, '/' kecil -->
                                <span class="fw-bolder" style="font-size:1.5rem; color: #ff0000;">
                                    {!! preg_replace(
                                        '/(\d+)(\/)(\d+)/',
                                        '$1<small style="font-size:0.7em; color:#ff0000;">$2$3</small>',
                                        $card['count']
                                    ) !!}
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
          </div>
          @php
                $role = Auth::user()->role;
            @endphp
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2 flex-wrap">
    
                <!-- Tambah Data -->
                <div class="d-flex flex-wrap gap-2">
                    @if (in_array($role, ['admin', 'superadmin']))
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fa fa-plus"></i>
                    </button>
                    <!-- Tombol Export -->
                    <a href="{{ route('pmliberta.export') }}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-upload"></i>
                    </a>
                    @endif
                    <!-- Modal Tambah Data -->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content rounded-4 border-0">
                        <div class="modal-header bg-white justify-content-center position-relative border-bottom">
                            <h5 class="modal-title text-dark fw-bold" id="createModalLabel">Tambah Data PM</h5>
                            <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <form action="{{ route('pmliberta.store') }}" method="POST">
                            @csrf
                            <div class="modal-body row g-3 px-4 py-3">
                            <div class="col-md-6">
                                <label class="form-label">Site ID</label>
                                <input type="text" name="site_id" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lokasi</label>
                                <input type="text" name="nama_lokasi" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kabupaten/Kota</label>
                                <input type="text" name="kabupaten_kota" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">PIC CE</label>
                                <input type="text" name="pic_ce" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Month</label>
                                <input type="text" name="month" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Week</label>
                                <input type="text" name="week" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-select">
                                <option value="SL">SL</option>
                                <option value="BMN">BMN</option>
                                <option value="BMN PAPUA">BMN PAPUA</option>
                                <option value="BMN NON PAPUA">BMN NON PAPUA</option>
                                </select>
                            </div>
                            </div>
                            <div class="modal-footer px-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>

                    <!-- Tombol Import -->
                    <form action="{{ route('pmliberta.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="importFile" class="btn btn-outline-success btn-sm mb-0">
                            <i class="fa fa-download"></i>
                        </label>
                        <input id="importFile" type="file" name="file" onchange="this.form.submit()" accept=".xlsx,.xls,.csv" hidden>
                    </form>
                </div>

                <!-- Form Filter dan Pencarian -->
                <form method="GET" action="{{ route('pmliberta') }}" class="d-flex flex-column flex-md-row align-items-stretch gap-2">
                    <select name="kategori" class="form-select form-select-sm w-100 w-md-auto" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="BMN" {{ request('kategori') == 'BMN' ? 'selected' : '' }}>BMN</option>
                        <option value="SL" {{ request('kategori') == 'SL' ? 'selected' : '' }}>SL</option>
                        <option value="BMN PAPUA" {{ request('kategori') == 'BMN PAPUA' ? 'selected' : '' }}>BMN PAPUA</option>
                        <option value="BMN NON PAPUA" {{ request('kategori') == 'BMN NON PAPUA' ? 'selected' : '' }}>BMN NON PAPUA</option>
                    </select>

                    <div class="input-group input-group-sm w-100 w-md-auto" style="max-width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Site ID, Nama Lokasi, Provinsi, Kabupaten/Kota" value="{{ request('search') }}">
                        <span class="input-group-text" style="cursor: pointer;" onclick="this.closest('form').submit()">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm text-nowrap align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>SITE ID</th>
                            <th>NAMA LOKASI</th>
                            <th>PROVINSI</th>
                            <th>KABUPATEN/KOTA</th>
                            <th>PIC CE</th>
                            <th>MONTH</th>
                            <th>DATE</th>
                            <th>STATUS</th>
                            <th>WEEK</th>
                            <th>KATEGORI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item->site_id }}</td>
                            <td>{{ $item->nama_lokasi }}</td>
                            <td>{{ $item->provinsi }}</td>
                            <td>{{ $item->kabupaten_kota }}</td>
                            <td>{{ $item->pic_ce }}</td>
                            <td class="text-center">{{ $item->month }}</td>
                            <td class="text-center">{{ $item->date }}</td>
                            <td class="text-center">{{ $item->status }}</td>
                            <td class="text-center">{{ $item->week }}</td>
                            <td class="text-center">{{ $item->kategori }}</td>
                            @php
                                $role = Auth::user()->role;
                            @endphp
                            <td>
                                <!-- Tombol Edit -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</button>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                  <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0">
                                      <div class="modal-header bg-warning">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="{{ route('pmliberta.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body row g-3 px-4 py-3">
                                          <div class="col-md-6">
                                            <label class="form-label">Site ID</label>
                                            <input type="text" name="site_id" class="form-control" value="{{ $item->site_id }}" required>
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">Nama Lokasi</label>
                                            <input type="text" name="nama_lokasi" class="form-control" value="{{ $item->nama_lokasi }}" required>
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">Provinsi</label>
                                            <input type="text" name="provinsi" class="form-control" value="{{ $item->provinsi }}">
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">Kabupaten/Kota</label>
                                            <input type="text" name="kabupaten_kota" class="form-control" value="{{ $item->kabupaten_kota }}">
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">PIC CE</label>
                                            <input type="text" name="pic_ce" class="form-control" value="{{ $item->pic_ce }}">
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">Month</label>
                                            <input type="text" name="month" class="form-control" value="{{ $item->month }}">
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">Date</label>
                                            <input type="date" name="date" class="form-control" value="{{ $item->date }}">
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">Status</label>
                                            <input type="text" name="status" class="form-control" value="{{ $item->status }}">
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">Week</label>
                                            <input type="text" name="week" class="form-control" value="{{ $item->week }}">
                                          </div>
                                          <div class="col-md-6">
                                            <label class="form-label">Kategori</label>
                                            <select name="kategori" class="form-select">
                                              <option value="SL" {{ $item->kategori == 'SL' ? 'selected' : '' }}>SL</option>
                                              <option value="BMN" {{ $item->kategori == 'BMN' ? 'selected' : '' }}>BMN</option>
                                              <option value="BMN SORONG" {{ $item->kategori == 'BMN SORONG' ? 'selected' : '' }}>BMN SORONG</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer px-4">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" class="btn btn-warning">Perbarui</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                @if (in_array($role, ['admin', 'superadmin']))
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->id }}">Hapus</button>    
                                <!-- Form delete tersembunyi -->
                                <form id="delete-form-{{ $item->id }}" action="{{ route('pmliberta.destroy', $item->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="12" class="text-center">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault(); // Cegah form langsung submit

    const kategori = document.querySelector('[name="kategori"]').value || 'Semua';
    const search = document.querySelector('[name="search"]').value || '-';

    Swal.fire({
        title: 'Anda akan menambahkan data baru dengan kategori berikut:',
        html: `<b>KATEGORI:</b> ${kategori}<br><b>SEARCH:</b> ${search}`,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Lanjutkan',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit(); // Submit form jika user setuju
        }
    });
});
</script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section ('scripts'
)
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    </script>
@endif
<script>
// Konfirmasi Delete
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.dataset.id;
            const form = document.getElementById('delete-form-' + id);

            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Notifikasi Sukses
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    // Notifikasi Error
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    @endif
});
</script>
@endsection
