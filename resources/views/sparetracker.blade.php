

@extends('layouts.user_type.auth')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
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
                            <a href="{{ url('tables') }}" class="text-decoration-none d-block">Data Site</a>
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
                            <a href="{{ url('log_perangkat') }}" class="text-decoration-none d-block">Pergantian Perangkat</a>
                            <a href="{{ url('sparetracker') }}" class="text-decoration-none d-block">Log Pergantian</a>
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

    @php
        $jumlah = $logPerangkatTeknisi->count();
    @endphp

    <form method="GET" class="d-flex align-items-center mb-4" style="gap: 10px;">
        <select name="keterangan" class="form-select" style="width: 250px;" onchange="this.form.submit()">
            <option value="">-- Semua Keterangan --</option>
            @foreach($keteranganList as $keterangan)
                <option value="{{ $keterangan }}" {{ $selectedKeterangan == $keterangan ? 'selected' : '' }}>
                    {{ $keterangan }}
                </option>
            @endforeach
        </select>
        <span class="badge bg-fuchsia text-white" style="font-size: 1rem;">{{ $jumlah }}</span>
    </form>

    <div class="d-flex justify-content-center">
        <div class="card shadow-lg mb-4" style="width: 100%;">
            <div class="card-body overflow-auto flex-grow-5">
                <div class="row justify-content-center text-center mt-2 mb-2">
                    @php
                        $deviceCards = [
                            ['label' => 'Router', 'filter' => 'router', 'count' => $routerCount],
                            ['label' => 'Modem', 'filter' => 'modem', 'count' => $modemCount],
                            ['label' => 'Tranciever', 'filter' => 'tranciever', 'count' => $transceiverCount], // pakai ejaan yang ada di database
                            ['label' => 'Access Point', 'filter' => 'accesspoint', 'count' => $accessPointCount],
                        ];
                    @endphp

                    <div class="d-flex flex-row gap-2 flex-nowrap overflow-auto mb-2 justify-content-center w-100">
                        @foreach($deviceCards as $card)
                            <div class="card" style="min-width:180px; background: #35486b; box-shadow:0 4px 12px 0 rgba(0,0,0,0.12); border-radius:12px;">
                                <a href="{{ url('/sparetracker') }}?perangkat={{ strtolower($card['label']) }}" class="text-decoration-none" style="color:inherit;">
                                    <div class="card-body p-2 d-flex flex-row align-items-center justify-content-center gap-2">
                                        <!-- Label hitam pekat dan bold -->
                                        <span class="fw-bolder text-capitalize" style="font-size:12px; color:#FFFFFF;">{{ $card['label'] }}</span>
                                        <!-- Jumlah perangkat warna abu gelap -->
                                        <span class="fw-bolder" style="font-size:1.5rem; color:#FFFFFF;">{{ $card['count'] }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @php
                    // Membagi data menjadi baris dengan 4 item per baris
                    $chunks = $logPerangkatTeknisi->chunk(3);
                @endphp
                <div class="card-body mt-5">
                <!-- Tabel dengan scroll horizontal -->
                <div class="table-responsive" style="margin-top: -60px; font-family: Cambria, 'Times New Roman', serif;">
                    <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                        <thead class="table-dark">
                            <tr class="text-center align-middle">
                                <th>NO</th>
                                <th>SITE ID</th>
                                <th>NAMA SITE</th>
                                <th>PERNGKAT</th>
                                <th>SN LAMA</th>
                                <th>SN BARU</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logPerangkatTeknisi as $row)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                                    <td class="text-center">{{ $row->id }}</td>
                                    <td class="text-center">{{ $row->site_id }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td class="text-center">{{ $row->perangkat }}</td>
                                    <td class="text-center">{{ $row->sn_lama }}</td>
                                    <td class="text-center">{{ $row->sn_baru }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
  @endsection
