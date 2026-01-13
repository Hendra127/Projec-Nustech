@extends('layouts.user_type.auth')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<style>
   body {
    background: #FEF3E2;
    min-height: 100vh;
    font-family: 'Quicksand', sans-serif;
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
                    <a href="{{ route('summaryspare') }}"
                       class="btn-custom {{ Request::is('summaryspare') ? 'btn-active' : 'btn-inactive' }}">
                       Summary Spare
                    </a>

                </div>
            </div>
        </div>
    </div>
    
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5 class="mb-0 text-center"> STOCK PERANGKAT</h5>
            </div>
            <div class="card-body px-4 pt-0 pb-2 mt-3">
                <div class="table-responsive p-0" style="overflow-x:auto; max-width:100%;">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th style="position: sticky; center: 0; background: #343a40; z-index: 2; color: white;">
                                    Jenis
                                </th>
                                @foreach($lokasiList as $lokasi)
                                    <th>{{ $lokasi }}</th>
                                @endforeach
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jenisList as $jenis)
                                <tr>
                                    <td style="position: sticky; left: 0; background: white; z-index: 1;">
                                        {{ $jenis }}
                                    </td>
                                    @php $rowTotal = 0; @endphp
                                    @foreach($lokasiList as $lokasi)
                                        @php
                                            $count = $stock->where('jenis', $jenis)->where('lokasi_realtime', $lokasi)->first()->total ?? 0;
                                            $rowTotal += $count;
                                        @endphp
                                        <td class="text-center align-middle">{{ $count }}</td>
                                    @endforeach
                                    <td class="text-center align-middle"><b>{{ $rowTotal }}</b></td>
                                </tr>
                            @endforeach
                            <tr class="table-secondary fw-bold text-center align-middle">
                                <td style="position: sticky; left: 0; background: #f8f9fa;">Grand Total</td>
                                @foreach($lokasiList as $lokasi)
                                    <td>{{ $stock->where('lokasi_realtime', $lokasi)->sum('total') }}</td>
                                @endforeach
                                <td>{{ $stock->sum('total') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        {{-- Card Kondisi Rusak --}}
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5 class="mb-0 text-center">⚠️ KONDISI PERANGKAT (RUSAK)</h5>
            </div>
            <div class="card-body px-4 pt-0 pb-2 mt-3">
                    <div class="table-responsive p-0">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr class="text-center align-middle">
                                    <th>Jenis</th>
                                    @foreach($kondisiList as $kondisi)
                                        <th>{{ strtoupper($kondisi) }}</th>
                                    @endforeach
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; $totalPerKondisi = []; @endphp
                                @foreach($jenisList as $jenis)
                                    @php $rowTotal = 0; @endphp
                                    <tr>
                                        <td>{{ $jenis }}</td>
                                        @foreach($kondisiList as $kondisi)
                                            @php
                                                $count = $kondisiData
                                                    ->where('jenis', $jenis)
                                                    ->where('kondisi', $kondisi)
                                                    ->first()->total ?? 0;
                                                $rowTotal += $count;
                                                $totalPerKondisi[$kondisi] = ($totalPerKondisi[$kondisi] ?? 0) + $count;
                                            @endphp
                                            <td class="text-center align-middle">{{ $count }}</td>
                                        @endforeach
                                        <td class="text-center align-middle fw-bold">{{ $rowTotal }}</td>
                                        @php $grandTotal += $rowTotal; @endphp
                                    </tr>
                                @endforeach
                
                                {{-- Baris total --}}
                                <tr class="table-secondary fw-bold text-center align-middle">
                                    <td>Grand Total</td>
                                    @foreach($kondisiList as $kondisi)
                                        <td>{{ $totalPerKondisi[$kondisi] ?? 0 }}</td>
                                    @endforeach
                                    <td>{{ $grandTotal }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
