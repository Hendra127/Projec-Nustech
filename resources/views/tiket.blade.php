@extends('layouts.user_type.auth')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
    font-family: 'Quicksand', sans-serif;
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
                <div class="row row-cols-1 row-cols-md-3 g-4 ps-4 pe-4">
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
                </div>
            <div class="modal-footer justify-content-end" style="border-top: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; filter: invert(1);"></button></div>
        </div>
    </div>
</div>
<style>
    #operasionalModal .modal-content {
        border: none;
        box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    }
    #operasionalModal .modal-body {
        padding-bottom: 0;
    }
    #operasionalModal .fw-bold {
        color: #344767;
        font-size: 1.05rem;
    }
</style>
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
                </div>
            </div>
        </div>
        
    <div class="d-flex justify-content-end align-items-center mb-3" style="position: absolute; top: 10px; right: 30px; z-index: 10;">
        <div class="dropdown">
            <a class="nav-link d-flex align-items-center gap-1 dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User Menu" style="padding: 0;">
                <span style="position: relative; display: inline-block;">
                    <i class="fa fa-user-circle fa-2x text-primary"></i>
                    <span style="position: absolute; top: 0; right: 0; font-size: 1em;">
                        <i class="fa fa-caret-down text-secondary"></i>
                    </span>
                </span>
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
                        <i class="fa fa-cog me-2"></i> Users Settings
                    </a>
            </ul>
        </div>
    </div>
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row justify-content-center text-center mt-2 mb-2">
                    @php
                        $cards = [
                            ['label' => 'Tiket Open All', 'count' => $tiketOpenCount, 'filter' => 'open_all'],
                            ['label' => 'Tiket Open Yesterday', 'count' => $tiketOpenYesterdayCount, 'filter' => 'open_yesterday'],
                            ['label' => 'Tiket Open Today', 'count' => $tiketOpenTodayCount, 'filter' => 'open_today'],
                        ];
                        $cardBg = '#113F67';
                    @endphp

                    <div class="d-flex flex-row gap-2 flex-nowrap overflow-auto mb-2 justify-content-center w-100">
                        @foreach($cards as $card)
                            <div class="card" style="min-width:180px; background: {{ $cardBg }}; box-shadow:0 4px 12px 0 rgba(0,0,0,0.12); border-radius:12px;">
                                <a href="#" class="show-tiket-filter d-block text-decoration-none" data-filter="{{ $card['filter'] }}" style="color: inherit;">
                                    <div class="card-body p-2 d-flex flex-row align-items-center justify-content-center gap-2">
                                        <!-- Label teks hitam pekat dan bold -->
                                        <span class="fw-bolder text-capitalize" style="font-size:12px; color:#FFFFFF;">
                                            {{ $card['label'] }}
                                        </span>
                                        <!-- Jumlah tiket warna merah -->
                                        <span class="fw-bolder" style="font-size:1.5rem; color: #ff0000;">
                                            {{ $card['count'] }}
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
                <!-- Tombol Tambah, Export, Import -->
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3" style="font-family: 'Quicksand', sans-serif;">
                    <!-- Tombol Tambah, Export, Import -->
                    <div class="d-flex gap-2 mb-2">
                        @if (in_array($role, ['admin', 'superadmin']))
                        <a href="#" class="btn btn-outline-primary btn-sm" title="Tambah Data" data-bs-toggle="modal" data-bs-target="#modalTambahTiket">
                            <i class="fa fa-plus mt-1"></i>
                        </a>
                        <a href="#" class="btn btn-outline-info btn-sm" title="Import" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                            <i class="fa fa-upload mt-1"></i>
                        </a>
                        @endif
                        <a href="{{ route('tiketexport') }}" class="btn btn-outline-success btn-sm" title="Export">
                            <i class="fa fa-download mt-1"></i>
                        </a>
                        <!--<form method="GET" action="{{ route('tiket') }}" class="d-flex align-items-center gap-2 mb-3">
                            <input type="date" id="tanggal_rekap" name="tanggal_rekap"--
                                class="form-control form-control-sm"--
                                value="{{ request('tanggal_rekap') }}"--
                                onchange="this.form.submit()">--

                            @if(request('tanggal_rekap'))
                                <a href="{{ route('tiket') }}" class="btn btn-outline-secondary btn-sm" title="Reset Filter">
                                    <i class="fa fa-clock"></i>
                                </a>
                            @endif
                        </form>-->
                        <form method="GET" action="{{ route('tiket') }}" id="filterRangeForm" class="d-flex align-items-center gap-2 mb-3">
                            <input type="date" name="start_date" class="form-control form-control-sm"
                                value="{{ request('start_date') }}">

                            <span>s/d</span>

                            <input type="date" name="end_date" class="form-control form-control-sm"
                                value="{{ request('end_date') }}"
                                onchange="document.getElementById('filterRangeForm').submit()">

                            @if(request('start_date') || request('end_date'))
                                <a href="{{ route('tiket') }}" class="btn btn-outline-secondary btn-sm" title="Reset Filter">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                   <form method="GET" action="{{ route('tiket') }}" class="d-flex align-items-center gap-2 flex-wrap">
                        <!-- Filter Kategori -->
                        <span class="fw-bold text-white" style="white-space: nowrap; position: relative; top: 6px;">KATEGORI</span>
                        <select name="kategori" class="form-select form-select-sm" style="width: 100px; font-size: 12px;" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="BMN" {{ request('kategori') == 'BMN' ? 'selected' : '' }}>BMN</option>
                            <option value="SL" {{ request('kategori') == 'SL' ? 'selected' : '' }}>SL</option>
                        </select>
                    
                        <!-- Search Input -->
                        <div class="input-group input-group-sm" style="width: 220px; margin-top: -3px;">
                            <input type="text" name="query" class="form-control" placeholder="Site ID, Nama Site, Provinsi, Kabupaten" value="{{ request()->query('query') }}">
                            <span class="input-group-text" style="cursor: pointer;" onclick="this.closest('form').submit()" title="Search">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <style>
                .fake-scrollbar-container {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    height: 20px;
                    overflow-x: auto;
                    overflow-y: hidden;
                    background-color: #f8f9fa;
                    z-index: 9999;
                }

                .fake-scrollbar-content {
                    height: 1px;
                }

                .table-wrapper-real {
                    overflow-x: auto;
                    max-width: 100%;
                    padding-bottom: 25px; /* biar isi gak ketiban scroll */
                }

                .table-wrapper-real table {
                    width: max-content;
                    min-width: 100%;
                    table-layout: auto;
                }

                body {
                    padding-bottom: 60px;
                }
            </style>
            <div class="card-body">
                <!-- Tabel dengan scroll horizontal -->
                <div id="tableScroll" class="table-wrapper-real" style="margin-top: -60px; font-family: 'Quicksand', sans-serif;">
                    <table table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                        <thead class="table-dark text-center align-middle">
                            <tr>
                                @php
                                    $bulan = [
                                        '01' => 'Januari',
                                        '02' => 'Februari',
                                        '03' => 'Maret',
                                        '04' => 'April',
                                        '05' => 'Mei',
                                        '06' => 'Juni',
                                        '07' => 'Juli',
                                        '08' => 'Agustus',
                                        '09' => 'September',
                                        '10' => 'Oktober',
                                        '11' => 'November',
                                        '12' => 'Desember',
                                    ];
                                @endphp
                                <th class="text-center">No</th>
                                <th class="text-center">SITE ID</th>
                                <th>NAMA SITE</th>
                                <th>PROVINSI</th>
                                <th>KABUPATEN</th>
                                <th>
                                    @php
                                        $currentSort = request()->query('sort', 'desc');
                                        $nextSort = $currentSort === 'asc' ? 'desc' : 'asc';
                                    @endphp
                                    <a href="{{ url('tiket') }}?sort={{ $nextSort }}" class="fw-bold text-white">DURASI</a>
                                </th>
                               <th class="text-center"> KATEGORI</th>
                                <th class="text-center">TANGGAL OPEN</th>
                                <!--<th class="text-center">BULAN OPEN</th>
                                <th class="text-center">STATUS TIKET</th>-->
                                <th class="text-center">KENDALA</th>
                                <!--<th class="text-center">TANGGAL CLOSE</th>
                                <th class="text-center">BULAN CLOSE</th>-->
                                <th class="text-center">EVIDENCE</th>
                                <!--<th>DETAIL PROBLEM</th>
                                <th>PLAN ACTIONS</th>-->
                                <th>CE</th>
                                <th class="text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiket as $index => $item)
                            <tr>
                                <td class="text-center">{{ $tiket->firstItem() + $index }}</td>
                                <td class="text-center">{{ $item->site_id }}</td>
                                <td>{{ $item->nama_site }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kabupaten }}</td>
                                <td class="durasi text-center">{{ $item->durasi_terbaru }}</td>
                                <td class="text-center">{{ $item->kategori }}</td>
                                <td class="tanggal-rekap text-center">{{ $item->tanggal_rekap }}</td>
                                <!--<td class="text-center">{{ $item->bulan_open }}</td
                                <td class="text-center">{{ $item->status_tiket }}</td>>-->
                                <td>{{ $item->kendala }}</td>
                                <!--<td class="text-center">
                                    {{ $item->tanggal_close --
                                        ? $bulan[\Carbon\Carbon::parse($item->tanggal_close)->format('m')] 
                                        : 'BELUM CLOSE' }}
                                </td>
                                <td class="text-center">
                                    {{ $item->bulan_close && isset($bulan[$item->bulan_close]) ? $bulan[$item->bulan_close] : ($item->bulan_close ?? 'BELUM CLOSE') }}
                                </td>-->
                                
                                <td class="text-center">
                                    @if ($item->evidence)
                                        <a href="#" onclick="showEvidence('{{ asset('storage/'.$item->evidence) }}')">ADA</a>
                                    @else
                                        TIDAK ADA
                                    @endif
                                </td>
                                <!--<td>{{ $item->detail_problem }}</td>
                                <td>{{ $item->plan_actions }}</td>-->
                                <td>{{ $item->ce }}</td>
                                @php
                                    $role = Auth::user()->role;
                                @endphp

                                <td class="d-flex gap-2">

                                    {{-- Tombol EDIT tampil untuk semua role --}}
                                    

                                    {{-- Jika role admin/superadmin, tampilkan tombol tambahan --}}
                                    @if (in_array($role, ['admin', 'superadmin']))

                                        {{-- Tombol CLOSE hanya jika tiket belum ditutup --}}
                                        @if ($item->status_tiket != 'close')
                                            <form action="{{ route('tiket.updateStatus', ['id' => $item->id]) }}" method="POST" class="form-close-tiket">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="status_tiket" value="CLOSE">
                                                <input type="hidden" name="tanggal_close" id="tanggal_close{{ $item->id }}">
                                                <input type="hidden" name="bulan_close" id="bulan_close{{ $item->id }}">
                                                <button type="submit" class="btn btn-danger mr-3 mb-3 btn-submit-close" data-id="{{ $item->id }}">
                                                    <i class="fa fa-times"></i> Close
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Tombol DELETE --}}
                                        <a href="#" class="btn btn-info action-btn btn-delete" data-id="{{ $item->id }}" data-url="{{ route('tiket.delete', ['id' => $item->id]) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    @endif
					                <a href="#" class="btn btn-primary action-btn" data-toggle="modal" onclick="openEditModal({{ $item->id }})">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                
                                    <a href="#" class="btn btn-info action-btn" onclick="openInfoModal({{ $item->id }})">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
				
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Fake Scrollbar always visible at bottom -->
                    <div id="fakeScroll" class="fake-scrollbar-container">
                        <div id="scrollSpacer" class="fake-scrollbar-content"></div>
                    </div>

                    <!-- Modal untuk menampilkan gambar -->
                    <div class="modal fade" id="evidenceModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                            <div class="modal-body text-center" id="evidenceContent">
                                <!-- Isi evidence akan dimuat via JS -->
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sticky Pagination -->
                <div class="position-sticky bottom-0 end-0 bg-white py-3" style="z-index: 1000;">
                    <div class="d-flex justify-content-end pe-3">
                        {{ $tiket->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Info Tiket -->
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- Ubah ke modal-lg agar lebih lebar -->
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(0); color: #000;"></button>
            </div>
            <div class="modal-body">
                <p><strong>Site ID:</strong> <span id="info-site-id"></span></p>
                <p><strong>Nama Site:</strong> <span id="info-nama-site"></span></p>
                <p><strong>Detail Problem:</strong> <span id="info-detail-problem"></span></p>
                <p><strong>Plan Actions:</strong> <span id="info-plan-actions"></span></p>
                <p><strong>Durasi:</strong> <span id="info-durasi"></span></p>
                <p><strong>Kategori:</strong> <span id="info-kategori"></span></p>
                <p><strong>Tanggal Rekap:</strong> <span id="info-tanggal-rekap"></span></p>
                <p><strong>Bulan Open:</strong> <span id="info-bulan-open"></span></p>
                <p><strong>Kendala:</strong> <span id="info-kendala"></span></p>
                <p><strong>CE:</strong> <span id="info-ce"></span></p>
                <!-- Tambahkan info lainnya di sini -->
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('tiketimport') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Data</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih File Excel:</label>
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data Tiket -->
     @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Buka kembali modal jika ada error validasi
                var myModal = new bootstrap.Modal(document.getElementById('modalAdd'));
                myModal.show();
            });
        </script>

        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <!-- Modal Tambah Tiket -->
<div class="modal fade" id="modalTambahTiket" tabindex="-1" aria-labelledby="modalTambahTiketLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- FORM DIMULAI -->
      <form id="tiketForm" action="{{ route('tiket.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahTiketLabel">Tambah Data Tiket</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="modal-body row">

          <!-- Site ID -->
          <div class="form-group col-md-6">
            <label>Site ID</label>
            <input type="text" id="site_id" name="site_id" class="form-control" readonly required>
          </div>

          <!-- Nama Site -->
          <div class="form-group col-md-6 mt-2">
            <label>Nama Site</label>
            <input type="text" id="sitename" name="nama_site" class="form-control mb-1" readonly>
            <select id="select_site_id" class="form-control" style="width: 100%">
              <option value="">-- Cari & Pilih Nama Site --</option>
              @foreach ($semuaSite as $site)
                <option value="{{ $site->site_id }}" 
                        data-sitename="{{ $site->sitename }}" 
                        data-provinsi="{{ $site->provinsi }}" 
                        data-kabupaten="{{ $site->kab }}">
                  {{ $site->sitename }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Provinsi -->
          <div class="form-group col-md-6">
            <label>Provinsi</label>
            <input type="text" id="provinsi" name="provinsi" class="form-control" readonly>
          </div>

          <!-- Kabupaten -->
          <div class="form-group col-md-6">
            <label>Kabupaten</label>
            <input type="text" id="kabupaten" name="kabupaten" class="form-control" readonly>
          </div>

          <!-- Durasi -->
          <div class="form-group col-md-6">
            <label>Durasi</label>
            <input type="text" name="durasi" class="form-control" value="0">
          </div>

          <!-- Kategori Tiket -->
          <div class="form-group col-md-6">
            <label>Kategori Tiket</label>
            <select name="kategori" class="form-control" required>
              <option value="">-- Pilih Kategori --</option>
              <option value="BMN">BMN</option>
              <option value="SL">SL</option>
            </select>
          </div>

          <!-- Tanggal Rekap -->
          <div class="form-group col-md-6">
            <label>Tanggal Rekap</label>
            <input type="date" name="tanggal_rekap" class="form-control">
          </div>

          <!-- Bulan Open Tiket -->
          <div class="form-group col-md-6">
            <label>Bulan Open Tiket</label>
            <select name="bulan_open" class="form-control" required>
              <option value="">-- Pilih Bulan Open --</option>
              @foreach ([
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
              ] as $bulan)
                <option value="{{ $bulan }}">{{ $bulan }}</option>
              @endforeach
            </select>
          </div>

          <!-- Status Tiket -->
          <div class="form-group col-md-6">
            <label>Status Tiket</label>
            <select name="status_tiket" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="OPEN">OPEN</option>
              <option value="CLOSE">CLOSE</option>
            </select>
          </div>

          <!-- Kendala -->
          <div class="form-group col-md-6">
            <label>Kendala</label>
            <input type="text" name="kendala" class="form-control">
          </div>

          <!-- Tanggal Close -->
          <div class="form-group col-md-6">
            <label>Tanggal Close Tiket</label>
            <input type="date" name="tanggal_close" class="form-control" readonly>
          </div>

          <!-- Bulan Close -->
          <div class="form-group col-md-6">
            <label>Bulan Close Tiket</label>
            <input type="text" id="bulan_close" name="bulan_close" class="form-control" value="BELUM CLOSE" readonly>
          </div>

          <!-- Evidence -->
          <div class="form-group col-md-6">
                            <label for="evidence">Evidence (foto/video)</label>
                            <input type="file" name="evidence" id="evidence" class="form-control" accept="image/*,video/*">
                            
                            {{-- Tampilkan evidence lama jika ada --}}
                            @if(!empty($tiket->evidence))
                                <small class="form-text text-muted">
                                    Evidence sebelumnya: <a href="{{ asset('storage/' . $tiket->evidence) }}" target="_blank">Lihat</a>
                                </small>
                            @endif
                        </div>

          <!-- Detail Problem -->
          <div class="form-group col-md-6">
            <label>Detail Problem</label>
            <textarea name="detail_problem" class="form-control" rows="2"></textarea>
          </div>

          <!-- Plan Actions -->
          <div class="form-group col-md-6">
            <label>Plan Actions</label>
            <textarea name="plan_actions" class="form-control" rows="2"></textarea>
          </div>

          <!-- CE -->
          <div class="form-group col-md-6">
            <label>Cluster Engineer (CE)</label>
            <input type="text" name="ce" class="form-control" required>
          </div>

        </div> <!-- END MODAL-BODY -->

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>

      </form>
      <!-- FORM BERAKHIR -->

    </div>
  </div>
</div>

    <!-- Modal EDIT TIKET -->
<div class="modal fade" id="modalEditTiket" tabindex="-1" role="dialog" aria-labelledby="modalEditTiketLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formEditTiket" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTiketLabel">Edit Data Tiket</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="nama_site" id="edit_nama_site" class="form-control">

                    <div class="form-group col-md-6">
                        <label>Site ID</label>
                        <input type="text" name="site_id" id="edit_site_id" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6 d-flex flex-column" style="margin-top: 4px;">
                        <label>Nama Site</label>
                    
                        <!-- Input autofill (readonly, akan diisi otomatis saat pilih) -->
                        <input type="text" id="sitename" name="nama_site" class="form-control mb-1" readonly>
                    
                        <!-- Select searchable pakai Select2 -->
                        <select id="select_site_id" class="form-control" style="width: 100%">
                            <option value="">-- Cari & Pilih Nama Site --</option>
                            @foreach ($semuaSite as $site)
                                <option value="{{ $site->site_id }}" data-sitename="{{ $site->sitename }}">
                                    {{ $site->sitename }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Provinsi</label>
                        <input type="text" id="edit_provinsi" name="provinsi" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Kabupaten</label>
                        <input type="text" id="edit_kabupaten" name="kabupaten" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Durasi</label>
                        <input type="text" name="durasi" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Kategori Tiket</label>
                        <select name="kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="BMN">BMN</option>
                            <option value="SL">SL</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Tanggal Rekap</label>
                        <input type="date" name="tanggal_rekap" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Bulan Open Tiket</label>
                        <select name="bulan_open" class="form-control" required>
                            <option value="">-- Pilih Bulan Open --</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Status Tiket</label>
                        <select name="status_tiket" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="OPEN">OPEN</option>
                            <option value="CLOSE">CLOSE</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Kendala</label>
                        <input type="text" name="kendala" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Tanggal Close Tiket</label>
                        <input type="date" name="tanggal_close" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Bulan Close Tiket</label>
                        <input type="text" id="edit_bulan_close" value="BELUM CLOSE" name="bulan_close" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="evidence">Evidence (foto/video)</label>
                        <input type="file" name="evidence" id="edit_evidence" class="form-control" accept="image/*,video/*">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Detail Problem</label>
                        <textarea name="detail_problem" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Plan Actions</label>
                        <textarea name="plan_actions" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Cluster Engineer (CE)</label>
                        <input type="text" name="ce" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
<style>
    .btn-magenta {
        background-color: #d200aa;
        color: white;
    }
</style>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const realScroll = document.getElementById('tableScroll');
    const fakeScroll = document.getElementById('fakeScroll');
    const scrollSpacer = document.getElementById('scrollSpacer');

    function syncWidth() {
        const table = realScroll.querySelector('table');
        if (table) {
            // Tambah offset ekstra untuk kompensasi scroll bar native
            const tableWidth = table.scrollWidth;
            scrollSpacer.style.width = (tableWidth + 100) + 'px';
        }
    }

    fakeScroll.addEventListener('scroll', () => {
        realScroll.scrollLeft = fakeScroll.scrollLeft;
    });

    realScroll.addEventListener('scroll', () => {
        fakeScroll.scrollLeft = realScroll.scrollLeft;
    });

    window.addEventListener('load', syncWidth);
    window.addEventListener('resize', syncWidth);

    const observer = new MutationObserver(syncWidth);
    observer.observe(realScroll, { childList: true, subtree: true });
</script>
<script>
    function openInfoModal(id) {
    // Panggil data dengan AJAX
    fetch(`/tiket/${id}`)
        .then(response => response.json())
        .then(data => {
            // Tampilkan data ke modal info (bukan form)
            document.getElementById('info-site-id').innerText = data.site_id;
            document.getElementById('info-nama-site').innerText = data.nama_site;
            document.getElementById('info-detail-problem').innerText = data.detail_problem;
            document.getElementById('info-plan-actions').innerText = data.plan_actions;
            document.getElementById('info-durasi').innerText = data.durasi_terbaru;
            document.getElementById('info-kategori').innerText = data.kategori; 
            document.getElementById('info-tanggal-rekap').innerText = data.tanggal_rekap;
            document.getElementById('info-bulan-open').innerText = data.bulan_open;
            document.getElementById('info-kendala').innerText = data.kendala;
            document.getElementById('info-ce').innerText = data.ce;
            // Tambahkan lainnya sesuai kebutuhan...

            // Tampilkan modal
            $('#infoModal').modal('show');
        })
        .catch(error => console.error(error));
}
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 4000,
                showConfirmButton: true
            });
        @endif

        @if(session('error') && session('form') === 'tambah')
            Swal.fire({
                icon: 'error',
                title: 'Gagal Tambah',
                text: '{{ session('error') }}',
                timer: 4000,
                showConfirmButton: true
            }).then(() => {
                $('#modalTambahTiket').modal('show');
            });
        @endif
    });
</script>

<script>
    $(document).on('click', '.show-tiket-filter', function(e) {
        e.preventDefault();
        const filter = $(this).data('filter');
        window.location.href = "{{ route('tiket') }}?filter=" + filter;
    });
</script>
<script>
    document.querySelectorAll('.show-tiket-filter').forEach(el => {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            const filter = this.getAttribute('data-filter');
            const url = new URL(window.location.href);
            url.searchParams.set('filter', filter);
            window.location.href = url.toString();
        });
    });
</script>
<script>
  // Daftarkan plugin Datalabels
  Chart.register(ChartDataLabels);

  // Ambil panjang data kabupaten dari Laravel
  const kabupatenLabels = {!! json_encode($openSitesByKabupaten->pluck('kab')) !!};
  const siteTotals = {!! json_encode($openSitesByKabupaten->pluck('total')) !!};

  // Fungsi untuk membuat warna acak
  const getRandomColor = () => {
    const r = Math.floor(Math.random() * 255);
    const g = Math.floor(Math.random() * 255);
    const b = Math.floor(Math.random() * 255);
    return `rgba(${r}, ${g}, ${b}, 0.7)`;
  };

  // Buat array warna berdasarkan jumlah kabupaten
  const backgroundColors = kabupatenLabels.map(() => getRandomColor());
  const borderColors = backgroundColors.map(color => color.replace('0.7', '1'));

  // Inisialisasi chart
  const ctx = document.getElementById('siteBarChart').getContext('2d');
  const siteBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: kabupatenLabels,
      datasets: [{
        label: 'Jumlah Site',
        data: siteTotals,
        backgroundColor: backgroundColors,
        borderColor: borderColors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        datalabels: {
          anchor: 'end',
          align: 'top',
          color: '#000',
          font: {
            weight: 'bold',
            size: 12
          },
          formatter: value => value
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          min: 0,
          max: 7,
          ticks: {
            stepSize: 1
          },
          title: {
            display: true,
            text: 'Jumlah Site'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Kabupaten'
          }
        }
      }
    },
    plugins: [ChartDataLabels]
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectBulan = document.querySelector('select[name="bulan_open"]');
        const bulanSekarang = new Date().toLocaleString('default', { month: 'long' });

        for (let option of selectBulan.options) {
            if (option.value.toLowerCase() === bulanSekarang.toLowerCase()) {
                option.selected = true;
                break;
            }
        }
    });
    function showEvidence(fileUrl) {
        const ext = fileUrl.split('.').pop().toLowerCase();
        let content = '';

        if (['jpg', 'jpeg', 'png'].includes(ext)) {
            content = `<img src="${fileUrl}" class="img-fluid" style="max-height:80vh;">`;
        } else if (['mp4', 'avi', 'mkv'].includes(ext)) {
            content = `
                <video width="100%" controls>
                    <source src="${fileUrl}" type="video/${ext}">
                    Browser Anda tidak mendukung tag video.
                </video>`;
        } else {
            content = `<a href="${fileUrl}" target="_blank">Lihat File Evidence</a>`;
        }

        document.getElementById('evidenceContent').innerHTML = content;
        $('#evidenceModal').modal('show');
    }
        document.addEventListener("DOMContentLoaded", function () {
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const url = $(this).data('url');
    
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
   $(document).ready(function () {
    $('#select_site_id').select2({
        placeholder: "-- Cari & Pilih Nama Site --",
        allowClear: true,
        width: '100%',
        dropdownParent: $('#modalTambahTiket') // jika pakai modal
    });

    $('#select_site_id').on('change', function () {
        const siteId = $(this).val();
        const siteName = $(this).find(':selected').data('sitename');

        if (siteId) {
            $.ajax({
                url: '/get-datasite/' + siteId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#site_id').val(data.site_id);
                    $('#provinsi').val(data.provinsi);
                    $('#kabupaten').val(data.kab);
                    $('#sitename').val(siteName);
                },
                error: function () {
                    alert('Gagal mengambil data site.');
                }
            });
        } else {
            $('#site_id, #sitename, #provinsi, #kabupaten').val('');
        }
    });
});
     @if(session('error') && session('form') === 'tambah')
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true
        }).then(() => {
            var modal = new bootstrap.Modal(document.getElementById('modalTambahTiket'));
            modal.show();
        });
    @endif
    $(document).ready(function () {
        $('#select_site_id').select2({
            placeholder: 'Pilih atau cari Nama Site',
            ajax: {
                url: '/get-datasite-list',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            },
            dropdownParent: $('#modalTambahTiket') // supaya bisa di modal
        });
        $('#edit_select_site_id').select2({
            placeholder: 'Pilih atau cari Nama Site',
            ajax: {
                url: '/get-datasite-list',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            },
            dropdownParent: $('#modalEditTiket') // supaya bisa tampil normal di modal
        });
    });
        $('#edit_select_site_id').on('select2:select', function (e) {
        const siteId = e.params.data.id;

        $.get('/get-datasite/' + siteId, function (data) {
            // tampilkan
            $('#edit_site_id_display').val(data.site_id);
            $('#edit_sitename_display').val(data.sitename);

            // isikan input untuk simpan
            $('#edit_site_id').val(data.site_id);
            $('#edit_nama_site').val(data.sitename);
            $('#edit_provinsi').val(data.provinsi);
            $('#edit_kabupaten').val(data.kab);
        });
    });
    
    function openCreateModal() {
        $('#modalTambahTiket').modal('show');
        $('#modalTambahTiketLabel').text('Tambah Data Tiket');
        $('#tiketForm').trigger('reset');
        $('#formMethod').html('');
        $('#tiketForm').attr('action', '{{ route("tiket.store") }}');
        $('#select_site_id').val(null).trigger('change');
    }
    function openEditModal(id) {
    $.ajax({
        url: `/api/tiket/datasites/${id}`,
        method: "GET",
        success: function (res) {
            if (res.success) {
                $('#modalEditTiket').modal('show');
                $('#formEditTiket').attr('action', `/tiket/${id}`);

                $('#formEditTiket input[name="site_id"]').val(res.data.site_id);
                $('#formEditTiket input[name="nama_site"]').val(res.data.nama_site);
                $('#formEditTiket input[name="provinsi"]').val(res.data.provinsi);
                $('#formEditTiket input[name="kabupaten"]').val(res.data.kabupaten);
                $('#formEditTiket input[name="durasi"]').val(res.data.durasi);
                $('#formEditTiket input[name="tanggal_rekap"]').val(res.data.tanggal_rekap);
                $('#formEditTiket input[name="tanggal_close"]').val(res.data.tanggal_close);
                $('#formEditTiket input[name="bulan_close"]').val(res.data.bulan_close);
                $('#formEditTiket input[name="ce"]').val(res.data.ce);

                $('#formEditTiket select[name="kategori"]').val(res.data.kategori);
                $('#formEditTiket select[name="bulan_open"]').val(res.data.bulan_open);
                $('#formEditTiket select[name="status_tiket"]').val(res.data.status_tiket);

                $('#formEditTiket textarea[name="kendala"]').val(res.data.kendala);
                $('#formEditTiket textarea[name="detail_problem"]').val(res.data.detail_problem);
                $('#formEditTiket textarea[name="plan_actions"]').val(res.data.plan_actions);

                // Select2
                let option = new Option(res.data.nama_site, res.data.site_id, true, true);
                $('#edit_select_site_id').empty().append(option).trigger('change');
            }
        }
    });
}


</script>
@endsection
