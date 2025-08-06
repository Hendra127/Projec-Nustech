@extends('layouts.user_type.auth')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
  }
    table thead th {
        background-color: #1a2b49; /* biru tua */
        color: white;
        vertical-align: middle;
        text-align: center;
    }

    table td {
        vertical-align: middle;
        font-size: 14px;
    }

    .table td, .table th {
        padding: 10px 12px;
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f2f4f7;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
                            <a href="{{ url('tables') }}" class="text-decoration-none d-block">Data Site</a>
                            <a href="{{ url('datapass') }}" class="text-decoration-none">Manajemen Password</a>
                            <a href="{{ url('LaporanPM') }}?type=site" class="text-decoration-none d-block">Laporan PM</a>
                            <a href="{{ url('pmliberta') }}?type=asset" class="text-decoration-none d-block">Pm Liberta</a>
                            <a href="{{ url('summary') }}?type=site" class="text-decoration-none d-block">Summary</a>
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
                            <a href="{{ url('log_perangkat') }}" class="text-decoration-none d-block">Pergantian Perangkat</a>
                            <a href="{{ url('sparetracker') }}" class="text-decoration-none d-block">Log Perangkat</a>
                            <a href="{{ url('logtracker') }}" class="text-decoration-none d-block">Spare Tracker</a>
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
                            <a href="{{ url('#') }}" class="text-decoration-none d-block">BMN</a>
                            <a href="{{ url('#') }}" class="text-decoration-none d-block">SL</a>
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

<!-- Sisa kode lama -->
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
                    <a class="dropdown-item" href="{{ url('users') }}">
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
                    <a href="{{ url('log_perangkat') }}"
                        class="btn-custom {{ Request::is('log_perangkat') ? 'btn-active' : 'btn-inactive' }}">
                        Pergantian Perangkat
                    </a>

                    <a href="{{ url('sparetracker') }}"
                        class="btn-custom {{ Request::is('sparetracker') ? 'btn-active' : 'btn-inactive' }}">
                        Log Pergantian
                    </a>

                    <a href="{{ url('logtracker') }}"
                        class="btn-custom {{ Request::is('logtracker') ? 'btn-active' : 'btn-inactive' }}">
                        Spare Tracker
                    </a>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid mt-2 px-0">
    <div class="card shadow-lg border-0 rounded-4 w-100">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2 flex-wrap">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fa fa-plus"></i>
                    </button>

                    <form action="{{ route('logtracker.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="importFile" class="btn btn-outline-success btn-sm mb-0">
                            <i class="fa fa-download"></i>
                        </label>
                        <input id="importFile" type="file" name="file" onchange="this.form.submit()" accept=".xlsx,.xls,.csv" hidden>
                    </form>

                    <a href="{{ route('logtracker.export') }}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-upload"></i>
                    </a>
                </div>

                <form method="GET" action="{{ route('sparetracker') }}" class="d-flex flex-column flex-md-row align-items-stretch gap-2">
                        <a href="#" class="btn btn-outline-warning btn-sm disabled-edit" id="editSelectedBtn" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fa fa-pencil"></i>
                        </a>    
                        <a href="#" class="btn btn-outline-danger btn-sm disabled-delete" id="deleteSelectedBtn" onclick="handleDeleteSelected()">
                            <i class="fa fa-trash"></i>
                        </a>
                   <div class="input-group input-group-sm" style="max-width: 180px;">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control form-control-sm" 
                            placeholder="Cari SN / Nama Perangkat..." 
                            value="{{ request('search') }}" 
                            style="height: 26px; font-size: 0.75rem;"
                        >
                        <button type="submit" class="input-group-text" style="cursor: pointer; height: 26px; padding: 0 8px;">
                            <i class="fa fa-search" style="font-size: 0.75rem;"></i>
                        </button>
                    </div>
                </form>
            </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-sm align-middle">
      <thead class="table-dark">
            <tr class="text-center">
                <th><input type="checkbox" id="select-all"></th>
                <th>NO</th>
                <th>SN</th>
                <th>NAMA PERANGKAT</th>
                <th>JENIS</th>
                <th>TYPE</th>
                <th>KONDISI</th>
                <th>PENGADAAN BY</th>
                <th>LOKASI ASAL</th>
                <th>LOKASI</th>
                <th>TANGGAL MASUK</th>
                <th>TANGGAL KELUAR</th>
                <th>STATUS PENGGUNAAN</th>
                <th>LOKASI REALTIME</th>
                <th>KABUPATEN</th>
                <th>LAYANAN AI</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td class="text-center">
            <input type="checkbox" class="select-item" data-id="{{ $item->id }}"
              data-sn="{{ $item->sn }}"
              data-nama="{{ $item->nama_perangkat }}"
              data-jenis="{{ $item->jenis }}"
              data-type="{{ $item->type }}"
              data-kondisi="{{ $item->kondisi }}"
              data-pengadaan="{{ $item->pengadaan_by }}"
              data-asal="{{ $item->lokasi_asal }}"
              data-lokasi="{{ $item->lokasi }}"
              data-masuk="{{ $item->tanggal_masuk }}"
              data-keluar="{{ $item->tanggal_keluar }}"
              data-status="{{ $item->status_penggunaan_sparepart }}"
              data-realtime="{{ $item->lokasi_realtime }}"
              data-kab="{{ $item->kabupaten }}"
              data-ai="{{ $item->layanan_ai }}">
          </td>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->sn }}</td>
          <td>{{ $item->nama_perangkat }}</td>
          <td>{{ $item->jenis }}</td>
          <td>{{ $item->type }}</td>
          <td>{{ $item->kondisi }}</td>
          <td>{{ $item->pengadaan_by }}</td>
          <td>{{ $item->lokasi_asal }}</td>
          <td>{{ $item->lokasi }}</td>
          <td>{{ $item->tanggal_masuk }}</td>
          <td>{{ $item->tanggal_keluar ?? '-' }}</td>
          <td>{{ $item->status_penggunaan_sparepart }}</td>
          <td>{{ $item->lokasi_realtime }}</td>
          <td>{{ $item->kabupaten }}</td>
          <td>{{ $item->layanan_ai ?? '-' }}</td>
            <td>{{ $item->keterangan ?? '-' }}</td>
        </tr>
        @empty
        <tr><td colspan="16" class="text-center">Tidak ada data tersedia.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <!-- PAGINATION -->
<div class="mt-3">
    {{ $data->links() }}
</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('logtracker.update') }}" method="POST">
      @csrf @method('PUT')
      <input type="hidden" name="id" id="edit-id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Spare Tracker</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <div class="col-md-6"><label>SN</label><input type="text" class="form-control" name="sn" id="edit-sn"></div>
          <div class="col-md-6"><label>Nama Perangkat</label><input type="text" class="form-control" name="nama_perangkat" id="edit-nama"></div>
          <div class="col-md-4"><label>Jenis</label><input type="text" class="form-control" name="jenis" id="edit-jenis"></div>
          <div class="col-md-4"><label>Type</label><input type="text" class="form-control" name="type" id="edit-type"></div>
          <div class="col-md-4"><label>Kondisi</label><input type="text" class="form-control" name="kondisi" id="edit-kondisi"></div>
          <div class="col-md-6"><label>Pengadaan By</label><input type="text" class="form-control" name="pengadaan_by" id="edit-pengadaan"></div>
          <div class="col-md-6"><label>Lokasi Asal</label><input type="text" class="form-control" name="lokasi_asal" id="edit-asal"></div>
          <div class="col-md-6"><label>Lokasi</label><input type="text" class="form-control" name="lokasi" id="edit-lokasi"></div>
          <div class="col-md-6"><label>Tanggal Masuk</label><input type="date" class="form-control" name="tanggal_masuk" id="edit-masuk"></div>
          <div class="col-md-6"><label>Tanggal Keluar</label><input type="date" class="form-control" name="tanggal_keluar" id="edit-keluar"></div>
          <div class="col-md-6"><label>Status Penggunaan</label><input type="text" class="form-control" name="status_penggunaan_sparepart" id="edit-status"></div>
          <div class="col-md-6"><label>Lokasi Realtime</label><input type="text" class="form-control" name="lokasi_realtime" id="edit-realtime"></div>
          <div class="col-md-6"><label>Kabupaten</label><input type="text" class="form-control" name="kabupaten" id="edit-kab"></div>
          <div class="col-md-6"><label>Layanan AI</label><input type="text" class="form-control" name="layanan_ai" id="edit-ai"></div>
            <div class="col-md-12"><label>Keterangan</label><textarea class="form-control" name="keterangan" id="edit-keterangan"></textarea></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('logtracker.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Spare Tracker</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6"><label>SN</label><input type="text" class="form-control" name="sn" required></div>
          <div class="col-md-6"><label>Nama Perangkat</label><input type="text" class="form-control" name="nama_perangkat"></div>
          <div class="col-md-4"><label>Jenis</label><input type="text" class="form-control" name="jenis"></div>
          <div class="col-md-4"><label>Type</label><input type="text" class="form-control" name="type"></div>
          <div class="col-md-4"><label>Kondisi</label><input type="text" class="form-control" name="kondisi"></div>
          <div class="col-md-6"><label>Pengadaan By</label><input type="text" class="form-control" name="pengadaan_by"></div>
          <div class="col-md-6"><label>Lokasi Asal</label><input type="text" class="form-control" name="lokasi_asal"></div>
          <div class="col-md-6"><label>Lokasi</label><input type="text" class="form-control" name="lokasi"></div>
          <div class="col-md-6"><label>Tanggal Masuk</label><input type="date" class="form-control" name="tanggal_masuk"></div>
          <div class="col-md-6"><label>Tanggal Keluar</label><input type="date" class="form-control" name="tanggal_keluar"></div>
          <div class="col-md-6"><label>Status Penggunaan</label><input type="text" class="form-control" name="status_penggunaan_sparepart"></div>
          <div class="col-md-6"><label>Lokasi Realtime</label><input type="text" class="form-control" name="lokasi_realtime"></div>
          <div class="col-md-6"><label>Kabupaten</label><input type="text" class="form-control" name="kabupaten"></div>
          <div class="col-md-6"><label>Layanan AI</label><input type="text" class="form-control" name="layanan_ai"></div>
          <div class="col-md-12"><label>Keterangan</label><textarea class="form-control" name="keterangan" rows="2"></textarea></div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function handleDeleteSelected() {
  const checked = document.querySelector('.select-item:checked');
  if (!checked) return;

  const id = checked.dataset.id;

  Swal.fire({
    title: 'Yakin ingin hapus data?',
    text: 'Data ini akan dihapus permanen!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e3342f',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Ya, hapus!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit form manual via hidden form
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = `/sparetracker/${id}`;

      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      form.innerHTML = `
        <input type="hidden" name="_token" value="${csrf}">
        <input type="hidden" name="_method" value="DELETE">
      `;

      document.body.appendChild(form);
      form.submit();
    }
  });
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2500
        });
    @endif
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const checkAll = document.getElementById('select-all');
  const checkboxes = document.querySelectorAll('.select-item');
  const editBtn = document.getElementById('editSelectedBtn');
  const deleteBtn = document.getElementById('deleteSelectedBtn');
  const deleteForm = document.getElementById('deleteForm');

  checkAll.addEventListener('change', function () {
    checkboxes.forEach(cb => cb.checked = this.checked);
    updateEditDeleteButtons();
  });

  checkboxes.forEach(cb => {
    cb.addEventListener('change', updateEditDeleteButtons);
  });

  function updateEditDeleteButtons() {
    const checkedItems = [...checkboxes].filter(cb => cb.checked);

    // Toggle tombol Edit
    editBtn.disabled = checkedItems.length !== 1;
    editBtn.style.pointerEvents = checkedItems.length === 1 ? 'auto' : 'none';
    editBtn.style.opacity = checkedItems.length === 1 ? '1' : '0.6';

    // Toggle tombol Delete
    deleteBtn.style.pointerEvents = checkedItems.length === 1 ? 'auto' : 'none';
    deleteBtn.style.opacity = checkedItems.length === 1 ? '1' : '0.6';

    if (checkedItems.length === 1) {
      const item = checkedItems[0];

      // Isi form edit
      document.getElementById('edit-id').value = item.dataset.id;
      document.getElementById('edit-sn').value = item.dataset.sn;
      document.getElementById('edit-nama').value = item.dataset.nama;
      document.getElementById('edit-jenis').value = item.dataset.jenis;
      document.getElementById('edit-type').value = item.dataset.type;
      document.getElementById('edit-kondisi').value = item.dataset.kondisi;
      document.getElementById('edit-pengadaan').value = item.dataset.pengadaan;
      document.getElementById('edit-asal').value = item.dataset.asal;
      document.getElementById('edit-lokasi').value = item.dataset.lokasi;
      document.getElementById('edit-masuk').value = item.dataset.masuk;
      document.getElementById('edit-keluar').value = item.dataset.keluar;
      document.getElementById('edit-status').value = item.dataset.status;
      document.getElementById('edit-realtime').value = item.dataset.realtime;
      document.getElementById('edit-kab').value = item.dataset.kab;
      document.getElementById('edit-ai').value = item.dataset.ai;
      document.getElementById('edit-keterangan').value = item.dataset.keterangan || '';

      // Set action form hapus
      if (deleteForm) {
        deleteForm.action = `/sparetracker/${item.dataset.id}`;
      }
    }
  }
});
</script>

@endsection