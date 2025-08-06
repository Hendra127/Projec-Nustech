@extends('layouts.user_type.auth')

@section('content')
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
                    <a href="{{ url('newproject') }}"
                        class="btn-custom {{ Request::is('newproject') ? 'btn-active' : 'btn-inactive' }}">
                        New Project
                    </a>
                    <a href="{{ url('sitereview') }}"
                        class="btn-custom {{ Request::is('sitereview') ? 'btn-active' : 'btn-inactive' }}">
                        Site Review
                    </a>
                    <a href="{{ url('laporaninstalasi') }}"
                        class="btn-custom {{ Request::is('laporaninstalasi') ? 'btn-active' : 'btn-inactive' }}">
                        Laporan Instalasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <h5>DATA SITE PENYEDIA : CV. NUSTECH</h5>

    <div class="card mb-3">
        <div class="card-body">
            <!-- Project Phase & Activity Filters -->
            <div class="mb-3">
                <label>PROJECT PHASE</label>
                <select class="form-control select2" id="projectPhaseFilter" multiple>
                    @foreach ($batchList as $batch)
                        <option value="{{ $batch }}">{{ $batch }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md-3">
                    <select class="form-select" id="activityFilter">
                        <option value="">ALL</option>
                        <option value="act1">Activity 1</option>
                        <option value="act2">Activity 2</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="provinsiFilter" name="provinsi">
                        <option value="">SEMUA PROVINSI</option>
                        @foreach ($provinsiList as $provinsi)
                            <option value="{{ $provinsi }}">{{ $provinsi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="kabupatenFilter" name="kabupaten">
                        <option value="">SEMUA KABUPATEN</option>
                        @foreach ($kabupaten as $kab)
                            <option value="{{ $kab }}">{{ $kab }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="kabupatenFilter" name="kabupaten">
                        <option value="">SEMUA KABUPATEN</option>
                        @foreach ($kecamatan as $kecamatan)
                            <option value="{{ $kecamatan }}">{{ $kecamatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 text-end">
                <button class="btn btn-info btn-sm">🔽 Manual Bulk Report</button>
                <button class="btn btn-success btn-sm">📥 Export Site Milestone</button>
                <button class="btn btn-primary btn-sm">📤 Export Site Information</button>
            </div>
        </div>
    </div>

    <!-- Tabel -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm align-middle text-nowrap">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Site ID</th>
                        <th>Site</th>
                        <th>Kota</th>
                        <th>Provinsi</th>
                        <th>Batch</th>
                        <th>Unprocess</th>
                    </tr>
                </thead>
                <tbody id="siteTableBody">
                    @foreach ($sites as $index => $site)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $site->site_id }}</td>
                        <td>{{ $site->sitename }}</td>
                        <td>{{ $site->kab }}</td>
                        <td>{{ $site->provinsi }}</td>
                        <td>{{ $site->batch }}</td>
                        <td class="text-center"><span class="badge bg-success">act</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Project Phase",
            width: '100%'
        });
    });
</script>
<!-- Script untuk mengambil data provinsi -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/get-provinsi')
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('provinsiFilter');
                data.forEach(prov => {
                    const option = document.createElement('option');
                    option.value = prov;
                    option.text = prov;
                    select.appendChild(option);
                });
            })
            .catch(() => {
                console.error('Gagal mengambil data provinsi.');
            });
    });
</script>
<script>
    $('#provinsi').on('change', function() {
        var provinsi = $(this).val();
        if (provinsi !== "") {
            $.ajax({
                url: '/get-kabupaten/' + provinsi,
                type: 'GET',
                success: function(data) {
                    $('#kab').empty().append('<option value="">SEMUA KABUPATEN</option>');
                    $.each(data, function(index, value) {
                        $('#kab').append('<option value="' + value + '">' + value + '</option>');
                    });
                    $('#kecamatan').empty().append('<option value="">SEMUA KECAMATAN</option>');
                }
            });
        } else {
            $('#kab').empty().append('<option value="">SEMUA KABUPATEN</option>');
            $('#kecamatan').empty().append('<option value="">SEMUA KECAMATAN</option>');
        }
    });

    $('#kab').on('change', function() {
        var kabupaten = $(this).val();
        if (kabupaten !== "") {
            $.ajax({
                url: '/get-kecamatan/' + kabupaten,
                type: 'GET',
                success: function(data) {
                    $('#kecamatan').empty().append('<option value="">SEMUA KECAMATAN</option>');
                    $.each(data, function(index, value) {
                        $('#kecamatan').append('<option value="' + value + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('#kecamatan').empty().append('<option value="">SEMUA KECAMATAN</option>');
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#projectPhaseFilter').on('change', function () {
            let selectedBatches = $(this).val(); // Ambil batch terpilih

            $.ajax({
                url: "{{ route('filter.batch') }}",
                type: "GET",
                data: {
                    batches: selectedBatches
                },
                success: function (response) {
                    $('#siteTableBody').html(response);
                },
                error: function () {
                    alert('Gagal mengambil data. Coba lagi.');
                }
            });
        });
    });
</script>
<!-- Script untuk filter data berdasarkan provinsi, kabupaten, kecamatan, dan batch -->
<script>
function applyFilter() {
    var provinsi = $('#provinsiFilter').val();
    var kabupaten = $('#kabupatenFilter').val();
    var kecamatan = $('#kecamatanFilter').val();
    var batches = $('#projectPhaseFilter').val();

    $.ajax({
        url: "{{ route('sitereview.filter') }}",
        type: "GET",
        data: {
            provinsi: provinsi,
            kabupaten: kabupaten,
            kecamatan: kecamatan,
            batches: batches
        },
        success: function(response) {
            let rows = '';

            if (response.length === 0) {
                rows = `
                    <tr>
                        <td colspan="7" class="text-center text-danger">
                            ⚠️ Data tidak ditemukan. Kombinasi filter tidak kompatibel.
                        </td>
                    </tr>
                `;
            } else {
                let compatible = false;
                $.each(response, function(index, site) {
                    // Cek kompatibilitas filter
                    if (
                        (!provinsi || site.provinsi === provinsi) &&
                        (!kabupaten || site.kab === kabupaten) &&
                        (!kecamatan || site.kecamatan === kecamatan)
                    ) {
                        compatible = true;
                        rows += `
                            <tr>
                                <td class="text-center">${index + 1}</td>
                                <td>${site.site_id}</td>
                                <td>${site.sitename}</td>
                                <td>${site.kab}</td>
                                <td>${site.provinsi}</td>
                                <td>${site.batch}</td>
                                <td class="text-center"><span class="badge bg-success">ACT</span></td>
                            </tr>
                        `;
                    }
                });
                if (!compatible) {
                    rows = `
                        <tr>
                            <td colspan="7" class="text-center text-danger">
                                ⚠️ Data yang di-filter tidak kompatibel.
                            </td>
                        </tr>
                    `;
                }
            }
            $('#siteTableBody').html(rows);
        },
        error: function() {
            $('#siteTableBody').html(`
                <tr>
                    <td colspan="7" class="text-center text-danger">
                        ⚠️ Gagal mengambil data.
                    </td>
                </tr>
            `);
        }
    });
}

$('#provinsiFilter, #kabupatenFilter, #kecamatanFilter, #projectPhaseFilter').on('change', function () {
    applyFilter();
});
</script>
@endsection
