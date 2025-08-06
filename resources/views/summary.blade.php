@extends('layouts.user_type.auth')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
        min-height: 100vh;
        font-family: Cambria, "Times New Roman", serif;
    }
    #doneChart {
        width: 100% !important;
        height: 100% !important;
    }
    .scrollable-card {
        max-height: 400px;
        overflow-y: auto;
        overflow-x: auto;
    }

    table {
        border-collapse: collapse !important;
    }

    .table th,
    .table td {
        border: 1px solid #dee2e6 !important;
        padding: 0.5rem !important;
        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    .table thead th {
        background-color: #2f416d !important;
        color: white !important;
    }

    .table tbody tr:last-child td {
        border-bottom: 1px solid #dee2e6 !important;
    }

    .table-hover tbody tr:hover td {
        background-color: #f0f8ff;
    }

    .card-header {
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
        background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    }
    
    .card-header span {
        font-weight: bold;
    }
    
    .card-header form {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0;
    }

    .card-header select {
        min-width: 100px;
        height: 30px;
    }
    .centered-header {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70px;
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
            <div class="row row-cols-1 row-cols-md-3 g-4 ps-5 pe-4">
                    <div class="col">
                        <div class="fw-bold mb-1">Data Site</div>
                        <div class="ms-2">
                            <a href="{{ url('tables') }}" class="text-decoration-none d-block">Data Site</a>
                            <a href="{{ url('datapass') }}" class="text-decoration-none d-block">Manajemen Password</a>
                            <a href="{{ url('LaporanPM') }}?type=site" class="text-decoration-none d-block">Laporan PM</a>
                            <a href="{{ url('pmliberta') }}?type=asset" class="text-decoration-none d-block">Pm Liberta</a>
                            <a href="{{ url('summary') }}?type=site" class="text-decoration-none d-block">Summary</a>
                        </div>
                        </div>

                        <div class="col">
                        <div class="fw-bold mb-1">Tiket</div>
                        <div class="ms-2">
                            <a href="{{ url('tiket') }}" class="text-decoration-none d-block">Open Tiket</a>
                            <a href="{{ url('close/tiket') }}" class="text-decoration-none d-block">Close Tiket</a>
                            <a href="{{ url('dashboard') }}" class="text-decoration-none d-block">Detail Tiket</a>
                        </div>
                        </div>

                        <div class="col">
                        <div class="fw-bold mb-1">Log Perangkat</div>
                        <div class="ms-2">
                            <a href="{{ url('log_perangkat') }}" class="text-decoration-none d-block">Pergantian Perangkat</a>
                            <a href="{{ url('sparetracker') }}" class="text-decoration-none d-block">Log Perangkat</a>
                            <a href="{{ url('logtracker') }}" class="text-decoration-none d-block">Spare Tracker</a>
                        </div>
                        </div>

                        <div class="col">
                        <div class="fw-bold mb-1">Download</div>
                        <div class="ms-2">
                            <a href="{{ url('download_file') }}" class="text-decoration-none d-block">Download File</a>
                        </div>
                        </div>

                        <div class="col">
                        <div class="fw-bold mb-1">Rekap SLA</div>
                        <div class="ms-2">
                            <a href="{{ url('#') }}" class="text-decoration-none d-block">BMN</a>
                            <a href="{{ url('#') }}" class="text-decoration-none d-block">SL</a>
                        </div>
                        </div>

                        <div class="col">
                        <div class="fw-bold mb-1">To Do List</div>
                        <div class="ms-2">
                            <a href="{{ url('todolist') }}" class="text-decoration-none d-block">My Todo list</a>
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
<div class="container-fluid mt-4"> 
    {{-- ROW: Grafik + Summary --}}
    <div class="row g-4">
        {{-- Grafik --}}
        <div class="col-lg-6 col-12">
            <div class="card shadow h-100 ">
                <div class="card-header centered-header text-dark fw-bold" style="background: white">
                    <span>GRAFIX TOTAL {{ $statusDipilih }} PER TANGGAL</span>
                </div>
                <div class="px-4 pb-2">
                    @php
                        // Jika kategori ALL, tampilkan dua badge: SL dan BMN
                        $kategoriAll = empty($kategoriDipilih);
                        $jumlahDoneBMN = 0;
                        $jumlahDoneSL = 0;

                        foreach ($summaryMonth as $row) {
                            if ($row->kategori == 'BMN') {
                                $jumlahDoneBMN += $row->done;
                            } elseif ($row->kategori == 'SL') {
                                $jumlahDoneSL += $row->done;
                            }
                        }

                        // Jika kategori spesifik, tampilkan hanya satu badge
                        if (!$kategoriAll) {
                            $jumlahDoneSummary = 0;
                            foreach ($summaryMonth as $row) {
                                if ($row->kategori == $kategoriDipilih) {
                                    $jumlahDoneSummary += $row->done;
                                }
                            }
                        }
                    @endphp

                    <div class="row gap-2 justify-content-center">
                        @if ($kategoriAll)
                            <div class="col-auto mb-1">
                                <span class="badge bg-success text-dark fw-bold" style="font-size: 0.95rem;">
                                    BMN: {{ $jumlahDoneBMN }}
                                </span>
                            </div>
                            <div class="col-auto mb-1">
                                <span class="badge bg-success text-dark fw-bold" style="font-size: 0.95rem;">
                                    SL: {{ $jumlahDoneSL }}
                                </span>
                            </div>
                            <div class="col-auto mb-1">
                                <span class="badge bg-success text-dark fw-bold" style="font-size: 0.95rem;">
                                    TOTAL: {{ $jumlahDoneBMN + $jumlahDoneSL }}
                                </span>
                            </div>
                        @else
                            <div class="col-auto mb-1">
                                <span class="badge bg-success text-dark fw-bold" style="font-size: 0.95rem;">
                                    {{ $kategoriDipilih }}: {{ $jumlahDoneSummary }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="doneChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Summary DONE per Bulan --}}
        <div class="col-lg-6 col-12">
            <div class="card shadow h-100">
                <div class="card-header text-white"
                    style="background: white">
                   <span class="text-dark fw-bold">SUMMARY {{ $statusDipilih }} PER BULAN</span>
                    <form action="{{ route('summary') }}" method="GET">
                        <select name="filter_bulan" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">-- All --</option>
                            @foreach ($listBulan as $bulan)
                                <option value="{{ $bulan }}" {{ $bulan == $bulanDipilih ? 'selected' : '' }}>
                                    {{ $bulan }}
                                </option>
                            @endforeach
                        </select>
                
                        <select name="filter_status" class="form-select form-select-sm" onchange="this.form.submit()">
                            @foreach ($listStatus as $status)
                                <option value="{{ $status }}" {{ $status == $statusDipilih ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                
                        <select name="filter_kategori" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">-- All --</option>
                            @foreach ($listKategori as $kategori)
                                <option value="{{ $kategori }}" {{ $kategori == $kategoriDipilih ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="card-body scrollable-card" style="font-family: Cambria, 'Times New Roman', serif;">
                    <table class="table table-bordered table-sm table-hover">
                        <thead class="table-dark text-center text-white fw-bold">
                            <tr>
                                <th>BULAN</th>
                                <th>KATEGORI</th>
                                <th>JUMLAH {{ $statusDipilih }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($summaryMonth as $row)
                            <tr class="text-center align-middle">
                                <td>{{ $row->month }}</td>
                                <td>{{ $row->kategori }}</td>
                                <td class="fw-bold text-success">{{ $row->done }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data untuk bulan ini</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card custom-shadow rounded-4 overflow-hidden mt-4 mb-4">
        <div class="card-header text-white fw-bold py-3 d-flex justify-content-between align-items-center"
             style="background: white">
            <span class="mb-0 text-dark">LIST SITE PM</span>
    
            <!-- Search form -->
            <form action="{{ route('summary') }}" method="GET" class="d-flex gap-2 align-items-center">
                <input type="text" id="live-search" name="search"
                class="form-control form-control-sm"
                placeholder="Cari Site ID / Nama Site / Kabupaten / Provinsi"
                style="max-width: 500px;">
            </form>
        </div>
    
            <div class="card-body bg-white">
                @if ($filteredData->isEmpty())
                    <div class="alert alert-warning mb-0">Tidak ada data yang sesuai filter.</div>
                @else
                <div id="hasil-cari">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm align-middle mb-0">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th>NO</th>
                                    <th>SITE ID</th>
                                    <th>NAMA SITE</th>
                                    <th>PROVINSI</th>
                                    <th>KABUPATEN</th>
                                    <th>MONTH</th>
                                    <th>DATE</th>
                                    <th>Status</th>
                                    <th>KATEGORI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filteredData as $i => $item)
                                    <tr>
                                         <td class="text-center">
                                            {{ $loop->iteration + ($filteredData->firstItem() - 1) }}
                                        </td>
                                        <td>{{ $item->site_id }}</td>
                                        <td class="text-start">{{ $item->nama_lokasi }}</td>
                                        <td class="text-start">{{ $item->provinsi }}</td>
                                        <td class="text-start">{{ $item->kabupaten_kota }}</td>
                                        <td>{{ $item->month }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->kategori }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer bg-white py-2">
                            <div class="d-flex justify-content-center">
                                {!! $filteredData->appends(request()->all())->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    {{-- ROW: TOTAL DOCUMENT PM --}}
    <div class="row mt-4 font-family: Cambria, 'Times New Roman', serif;">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header centered-header text-dark fw-bold"
                    style="background: white">
                    TOTAL DOCUMENT PM
                </div>
                <div class="card-body table-responsive" style="font-family: Cambria, 'Times New Roman', serif;">
                    <table class="table table-bordered table-sm table-hover">
                        <thead class="table-dark text-center text-white fw-bold">
                            <tr>
                                <th>KATEGORI</th>
                                <th>PROVINSI</th>
                                <th>DONE</th>
                                <th>PENDING</th>
                                <th>TOTAL</th>
                                <th>% DONE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalDone = 0;
                                $totalPending = 0;
                                $totalAll = 0;
                            @endphp

                            @foreach ($summaryProvinsi as $row)
                            @php
                                $totalDone += $row->done;
                                $totalPending += $row->pending;
                                $totalAll += $row->total;
                            @endphp
                            <tr class="text-center align-middle">
                                <td>{{ $row->kategori }}</td>
                                <td>{{ $row->provinsi }}</td>
                                <td class="text-success fw-bold">{{ $row->done }}</td>
                                <td class="text-danger fw-bold">{{ $row->pending }}</td>
                                <td class="text-info fw-bold">{{ $row->total }}</td>
                                <td class="fw-bold">{{ number_format($row->persen_done, 2) }}%</td>
                            </tr>
                            @endforeach

                            <tr class="text-center align-middle table-secondary">
                                <td class="text-dark fw-bold" colspan="2">Grand Total</td>
                                <td class="text-dark fw-bold">{{ $totalDone }}</td>
                                <td class="text-dark fw-bold">{{ $totalPending }}</td>
                                <td class="text-dark fw-bold">{{ $totalAll }}</td>
                                <td class="text-dark fw-bold">
                                    {{ $totalAll > 0 ? number_format(($totalDone / $totalAll) * 100, 2) : '0.00' }}%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('live-search');
    const hasilCek = document.getElementById('hasil-cari');

    function fetchData(page = 1, query = '') {
        const bulan = document.querySelector('select[name="filter_bulan"]').value;
        const status = document.querySelector('select[name="filter_status"]').value;
        const kategori = document.querySelector('select[name="filter_kategori"]').value;
    
        const url = `/summary/search?page=${page}&search=${query}&filter_bulan=${bulan}&filter_status=${status}&filter_kategori=${kategori}`;
    
        fetch(url)
            .then(response => response.json())
            .then(data => {
                document.getElementById('hasil-cari').innerHTML = data.html;
            });
    }

    // Live Search
    searchInput.addEventListener('input', function () {
        fetchData(1, this.value);
    });

    // Pagination Click
    document.addEventListener('click', function (e) {
        const link = e.target.closest('.pagination a');
        if (link) {
            e.preventDefault();
            const page = new URL(link.href).searchParams.get('page');
            fetchData(page, searchInput.value);
        }
    });
});
</script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('doneChart');
        if (!ctx) {
            console.error('#doneChart tidak ditemukan');
            return;
        }

        const doneChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($chartDonePerDate->pluck('label')) !!},
                datasets: [{
                    label: 'Jumlah {{ $statusDipilih }}',
                    data: {!! json_encode($chartDonePerDate->pluck('total_done')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: '#198754',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#198754',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 2,
                            color: '#000'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#000',
                            font: { weight: 'bold' }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
