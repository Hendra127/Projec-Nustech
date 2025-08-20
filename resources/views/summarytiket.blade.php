@extends('layouts.user_type.auth')

@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Tombol Operasional -->
<div class="d-flex justify-content-center align-items-center mb-3" style="position: absolute; top: 10px; left: 50%; transform: translateX(-50%); z-index: 10;">
  <a href="#" data-bs-toggle="modal" data-bs-target="#operasionalModal" style="text-decoration: none; color: #000;">
    <h6 class="mb-0"><strong>Operasional</strong></h6>
  </a>
</div>

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
                            <a href="{{ url('laporanPM') }}" class="text-decoration-none d-block">Laporan PM</a>
                            <a href="{{ url('pmliberta') }}" class="text-decoration-none d-block">Pm Liberta</a>
                            <a href="{{ url('summary') }}" class="text-decoration-none d-block">Summary</a>
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
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="content">
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 d-flex justify-content gap-3" style="font-family: 'Quicksand', sans-serif;">
                    <a href="{{ url('tiket') }}"
                        class="btn-custom {{ Request::is('tiket') ? 'btn-active' : 'btn-inactive' }}">
                        Open Tiket
                    </a>
                    <a href="{{ route('close.tiket') }}"
                        class="btn-custom {{ request()->routeIs('close.tiket') ? 'btn-active' : 'btn-inactive' }}">
                        Close Tiket
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="btn-custom {{ request()->routeIs('dashboard') ? 'btn-active' : 'btn-inactive' }}">
                        Detail Tiket
                    </a>
                    <a href="{{ route('summarytiket') }}"
                        class="btn-custom {{ request()->routeIs('summarytiket') ? 'btn-active' : 'btn-inactive' }}">
                        Summary Tiket
                    </a>    
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid">
    <div class="row">
        <!-- Bagian tabel -->
        <div class="col-md-6">

            <!-- Open & Close tiket / bulan -->
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>OPEN & CLOSE TIKET / BULAN</th>
                                <th colspan="2" class="text-start">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                        <span>STATUS TIKET</span>
                                        <form method="GET" action="" style="margin: 0;">
                                            <label for="bulan_open" style="margin-right: 5px;" </label>
                                            <style>
                                                .custom-select {
                                                    padding: 5px 10px;
                                                    border-radius: 6px;
                                                    border: 1px solid #6c63ff;
                                                    background-color: #fff;
                                                    font-size: 14px;
                                                    font-weight: 500;
                                                    color: #333;
                                                    cursor: pointer;
                                                    transition: all 0.2s ease-in-out;
                                                }

                                                .custom-select:hover {
                                                    border-color: #4e44d4;
                                                    box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
                                                }

                                                .custom-select:focus {
                                                    outline: none;
                                                    border-color: #4e44d4;
                                                    box-shadow: 0 0 8px rgba(108, 99, 255, 0.7);
                                                }
                                            </style>

                                            <select name="bulan_open" onchange="this.form.submit()" class="custom-select">
                                                <option value="">-- Semua Bulan --</option>
                                                @foreach($bulanList as $bulan)
                                                    <option value="{{ $bulan }}" {{ request('bulan_open') == $bulan ? 'selected' : '' }}>
                                                        {{ ucfirst(strtolower($bulan)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>KATEGORI</th>
                                <th class="text-center">CLOSE</th>
                                <th class="text-center">OPEN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalClose = 0;
                                $totalOpen = 0;
                            @endphp
                            @foreach($perBulan->groupBy('kategori') as $kategori => $items)
                                @php
                                    $close = $items->where('status_tiket','CLOSE')->sum('total');
                                    $open = $items->where('status_tiket','OPEN')->sum('total');
                                    $totalClose += $close;
                                    $totalOpen += $open;
                                @endphp
                                <tr>
                                    <td>{{ $kategori }}</td>
                                    <td class="text-center">{{ $close }}</td>
                                    <td class="text-center">{{ $open }}</td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td>Grand Total</td>
                                <td class="text-center">{{ $totalClose }}</td>
                                <td class="text-center">{{ $totalOpen }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Open tiket / hari -->
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>OPEN TIKET / HARI</th>
                                <th class="text-center">OPEN</th>
                                <th class="text-center">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotalOpen = $openPerHari->sum('total'); @endphp
                            @foreach($openPerHari as $row)
                                <tr>
                                    <td>{{ $row->kategori }}</td>
                                    <td class="text-center">{{ $row->total }}</td>
                                    <td class="text-center">{{ number_format(($row->total / max($grandTotalOpen, 1)) * 100, 2) }}%</td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td>Grand Total</td>
                                <td class="text-center">{{ $grandTotalOpen }}</td>
                                <td class="text-center">{{ number_format(($grandTotalOpen / max($grandTotalOpen, 1)) * 100, 2) }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Close tiket / hari -->
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>CLOSE TIKET / HARI</th>
                                <th class="text-center">CLOSE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotalClose = $closePerHari->sum('total'); @endphp
                            @foreach($closePerHari as $row)
                                <tr>
                                    <td>{{ $row->kategori }}</td>
                                    <td class="text-center">{{ $row->total }}</td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td>Grand Total</td>
                                <td class="text-center">{{ $grandTotalClose }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kabupaten -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>KABUPATEN</th>
                                <th class="text-center">STATUS TIKET</th>
                                <th class="text-center">DURASI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perKabupaten as $row)
                                <tr>
                                    <td>{{ $row->kabupaten }}</td>
                                    <td class="text-center">{{ $row->total }}</td>
                                    <td class="text-center">{{ $row->durasi_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

       <!-- Bagian Chart -->
            <div class="col-md-6">
                <!-- Chart Open Ticket -->
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="text-center">CHART OPEN TICKET</h5>
                        <canvas id="openTicketChart"></canvas>
                    </div>
                </div>

                <!-- Chart Durasi Open Tiket -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="text-center">CHART DURASI OPEN TIKET</h5>
                        <canvas id="durasiOpenTicketChart"></canvas>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    const ctx = document.getElementById('openTicketChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($perKabupaten->pluck('kabupaten')) !!},
            datasets: [{
                label: 'Open Ticket',
                data: {!! json_encode($perKabupaten->pluck('total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.8)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { ticks: { autoSkip: false, maxRotation: 60, minRotation: 60 } },
                y: { beginAtZero: true }
            }
        }
    });
</script>
<script>
    // Chart 2 (Durasi Open Tiket)
    const ctx2 = document.getElementById('durasiOpenTicketChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: {!! json_encode($durasiOpenTiket->pluck('kabupaten')) !!},
            datasets: [{
                label: 'Durasi Open Tiket',
                data: {!! json_encode($durasiOpenTiket->pluck('durasi_total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.8)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    color: '#fff',
                    font: { weight: 'bold' },
                    formatter: Math.round
                }
            },
            scales: {
                x: { ticks: { autoSkip: false, maxRotation: 60, minRotation: 60 } },
                y: { beginAtZero: true }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>
@endsection
