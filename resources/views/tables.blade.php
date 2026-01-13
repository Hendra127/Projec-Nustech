@extends('layouts.user_type.auth')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
   body {
    background: #FEF3E2;
    min-height: 100vh;
    font-family: 'Quicksand', sans-serif;
  }
    /* Tabel utama */
    .table-wrapper-real table.table {
        border-collapse: separate;   /* wajib supaya border-spacing jalan */
        border-spacing: 0 4px;       /* jarak antar row (vertikal) */
        width: 100%;
    }
    
    /* Header */
    .table-wrapper-real table.table thead th {
        padding: 6px 8px;            /* lebih ramping dari contoh */
        font-size: 13px;
        line-height: 1.2;
        vertical-align: middle;
        white-space: nowrap;
    }
    
    /* Body cell */
    .table-wrapper-real table.table tbody td {
        padding: 6px 10px;           /* KUNCI: kecil tapi masih enak dibaca */
        font-size: 13px;
        line-height: 1.2;
        vertical-align: middle;
        white-space: nowrap;
    }
    
    /* Pastikan button tidak bikin row jadi tinggi */
    .table-wrapper-real table.table td .btn {
        padding: 2px 6px;
        font-size: 12px;
        line-height: 1;
        margin: 0 !important;
    }
    
    /* Override Bootstrap 5 spacing bawaan */
    .table-wrapper-real .table > :not(caption) > * > * {
        padding-top: 6px;
        padding-bottom: 6px;
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
        <div class="card card-info card-outline">
            <div class="card-header">
                <!-- Tombol Tambah, Export, Import -->
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <!-- Tombol Tambah, Export, Import -->
                    <div class="d-flex gap-2 mb-2">
                        @if (in_array($role, ['admin', 'superadmin']))
                        <a href="#" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLong" title="Import Data">
                            <i class="fa fa-upload"></i>
                        </a>
                        <a href="{{ route('datacreate') }}" class="btn btn-outline-info btn-sm" title="Tambah Data">
                            <i class="fa fa-plus"></i>
                        </a>
                        @endif
                        <a href="{{ route('dataexport') }}" class="btn btn-outline-info btn-sm" title="Export Data">
                            <i class="fa fa-download"></i>
                        </a>
                    </div>

                    <!-- Form Search -->
                    <form action="{{ route('tables') }}" method="GET">
                        <div class="input-group input-group-sm" style="width: 220px;">
                            <input type="text" name="query" class="form-control" placeholder="Enter To Search" value="{{ request()->query('query') }}">
                            <span class="input-group-text" style="cursor: pointer;" onclick="this.closest('form').submit()">
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
                table.table td {
                    font-size: 13 !important;
                }
            </style>
            <div class="card-body">
                <!-- Tabel dengan scroll horizontal -->
                <div id="tableScroll" class="table-wrapper-real" style="margin-top: -60px; font-family: 'Quicksand', sans-serif;">
                    <table table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">ID SITE</th>
                                <th class="text-center">SITE NAME</th>
                                <th class="text-center">TIPE</th>
                                <th class="text-center">BATCH</th>
                                <th class="text-center">LATITUDE</th>
                                <th class="text-center">LONGITUDE</th>
                                <th class="text-center">PROVINSI</th>
                                <th class="text-center">KABUPATEN</th>
                                <th class="text-center">KECAMATAN</th>
                                <th class="text-center">KELURAHAN</th>
                                <th class="text-center">ALAMAT</th>
                                <th class="text-center">NAMA PIC</th>
                                <th class="text-center">NOMOR PIC</th>
                                <th class="text-center">SUMBER LISTRIK</th>
                                <th class="text-center">GATEWAY AREA</th>
                                <th class="text-center">BEAM</th>
                                <th class="text-center">HUB</th>
                                <th class="text-center">KODEFIKASI</th>
                                <th class="text-center">SN ANTENA</th>
                                <th class="text-center">SN MODEM</th>
                                <th class="text-center">SN ROUTER</th>
                                <th class="text-center">SN AP1</th>
                                <th class="text-center">SN AP2</th>
                                <th class="text-center">SN TRANCIEVER</th>
                                <th class="text-center">SN STABILIZER</th>
                                <th class="text-center">SN RAK</th>
                                <th class="text-center">IP MODEM</th>
                                <th class="text-center">IP ROUTER</th>
                                <th class="text-center">IP AP1</th>
                                <th class="text-center">IP AP2</th>
                                <th class="text-center">EXPECTED SQF</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($site as $index => $item)
                            <tr>
                                <td class="text-center">{{ $site->firstItem() + $index }}</td>
                                <td>{{ $item->site_id }}</td>
                                <td>{{ $item->sitename }}</td>
                                <td class="text-center">{{ $item->tipe }}</td>
                                <td class="text-center">{{ $item->batch }}</td>
                                <td class="text-center">{{ $item->latitude }}</td>
                                <td class="text-center">{{ $item->longitude }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kab }}</td>
                                <td>{{ $item->kecamatan }}</td>
                                <td>{{ $item->kelurahan }}</td>
                                <td>{{ $item->alamat_lokasi }}</td>
                                <td>{{ $item->nama_pic }}</td>
                                <td class="text-center">{{ $item->nomor_pic }}</td>
                                <td>{{ $item->sumber_listrik }}</td>
                                <td class="text-center">{{ $item->gateway_area }}</td>
                                <td class="text-center">{{ $item->beam }}</td>
                                <td class="text-center">{{ $item->hub }}</td>
                                <td>{{ $item->kodefikasi }}</td>
                                <td class="text-center">{{ $item->sn_antena }}</td>
                                <td class="text-center">{{ $item->sn_modem }}</td>
                                <td class="text-center">{{ $item->sn_router }}</td>
                                <td class="text-center">{{ $item->sn_ap1 }}</td>
                                <td class="text-center">{{ $item->sn_ap2 }}</td>
                                <td class="text-center">{{ $item->sn_tranciever }}</td>
                                <td class="text-center">{{ $item->sn_stabilizer }}</td>
                                <td class="text-center">{{ $item->sn_rak }}</td>
                                <td class="text-center">{{ $item->ip_modem }}</td>
                                <td class="text-center">{{ $item->ip_router }}</td>
                                <td class="text-center">{{ $item->ip_ap1 }}</td>
                                <td class="text-center">{{ $item->ip_ap2 }}</td>
                                <td class="text-center">{{ $item->expected_sqf }}</td>
                                @php
                                    $role = Auth::user()->role;
                                @endphp
                                <td>
                                    @if (in_array($role, ['admin', 'superadmin']))
                                    <a href="/dataupdate/{{ $item->id }}">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-pencil"></i> Update
                                        </button>
                                    </a>
                                    @endif
                                    <a href="#" class="btn btn-info" data-toggle="modal" onclick="openEditModal({{ $item->id }})">
                                        <i class="fa fa-info-circle"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <style>
                    .pagination {
                        justify-content: center;
                        flex-wrap: wrap;
                    }
                
                    .pagination .page-item {
                        margin: 0 4px;
                    }
                
                    .pagination .page-link {
                        border-radius: 50%;
                        width: 40px;
                        height: 40px;
                        padding: 0;
                        line-height: 40px;
                        text-align: center;
                        border: 1px solid #ccc;
                        color: #5c6e91;
                        font-weight: 500;
                    }
                
                    .pagination .page-item.active .page-link {
                        background-color: #c700a1; /* magenta seperti gambar */
                        border-color: #c700a1;
                    }
                
                    .pagination .page-link:focus {
                        box-shadow: none;
                    }
                
                    .pagination .page-link:hover {
                        background-color: #f0f0f0;
                    }
                </style>
                <!-- Sticky Pagination -->
              <div class="position-sticky bottom-0 start-0 w-100 bg-white py-3" style="z-index: 1000;">
                    @if ($site->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $site->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    
     <!-- Fake Scrollbar always visible at bottom -->
    <div id="fakeScroll" class="fake-scrollbar-container">
        <div id="scrollSpacer" class="fake-scrollbar-content"></div>
    </div>
    
    <!-- Modal Import -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('dataimport') }}" method="post" enctype="multipart/form-data">
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

    <div class="modal fade" id="modalDetailDataSite" tabindex="-1" role="dialog" aria-labelledby="modalDetailDataSiteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="tiketForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailDataSiteLabel">Detail Site</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div id="formMethod"></div>
                        <div class="form-group col-md-6">
                            <label>ID Site</label>
                            <input type="text" name="id_site" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Site Name</label>
                            <input type="text" name="sitename" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tipe</label>
                            <input type="text" name="tipe" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Batch</label>
                            <input type="text" name="batch" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Latitude</label>
                            <input type="text" name="latitude" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Longitude</label>
                            <input type="text" name="longitude" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama PIC</label>
                            <input type="text" name="nama_pic" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor PIC</label>
                            <input type="text" name="nomor_pic" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sumber Listrik</label>
                            <input type="text" name="sumber_listrik" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gateway Area</label>
                            <input type="text" name="gateway_area" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Beam</label>
                            <input type="text" name="beam" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Hub</label>
                            <input type="text" name="hub" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kodefikasi</label>
                            <input type="text" name="kodefikasi" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Antena</label>
                            <input type="text" name="sn_antena" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Modem</label>
                            <input type="text" name="sn_modem" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Router</label>
                            <input type="text" name="sn_router" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN AP1</label>
                            <input type="text" name="sn_ap1" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN AP2</label>
                            <input type="text" name="sn_ap2" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Tranciever</label>
                            <input type="text" name="sn_tranciever" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Stabilizer</label>
                            <input type="text" name="sn_stabilizer" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Rak</label>
                            <input type="text" name="sn_rak" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>IP Modem</label>
                            <input type="text" name="ip_modem" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>IP Router</label>
                            <input type="text" name="ip_router" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>IP AP1</label>
                            <input type="text" name="ip_ap1" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>IP AP2</label>
                            <input type="text" name="ip_ap2" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Expected SQF</label>
                            <input type="text" name="expected_sqf" class="form-control" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>
@endsection

@section('scripts')
<!--Scrollbar-->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const realScroll = document.getElementById('tableScroll');
        const fakeScroll = document.getElementById('fakeScroll');
        const scrollSpacer = document.getElementById('scrollSpacer');
    
        function syncWidth() {
            const table = realScroll.querySelector('table');
            if (table) {
                // Tambah offset ekstra untuk kompensasi scroll bar native
                const tableWidth = table.scrollWidth;
                scrollSpacer.style.width = (tableWidth + 150) + 'px';
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
    });
</script>
<script>

    function openEditModal(id) {
        $.ajax({
            url: `/api/datasites/${id}`,
            method: "GET",
            success: function (response) {
                if (response.success) {
                    $('#modalDetailDataSite').modal('show');
                    $("input[name='id_site']").val(response.data.site_id);
                    $("input[name='sitename']").val(response.data.sitename);
                    $("input[name='tipe']").val(response.data.tipe);
                    $("input[name='batch']").val(response.data.batch);
                    $("input[name='latitude']").val(response.data.latitude);
                    $("input[name='longitude']").val(response.data.longitude);
                    $("input[name='provinsi']").val(response.data.provinsi);
                    $("input[name='kabupaten']").val(response.data.kabupaten);
                    $("input[name='kecamatan']").val(response.data.kecamatan);
                    $("input[name='kelurahan']").val(response.data.kelurahan);
                    $("input[name='alamat']").val(response.data.alamat);
                    $("input[name='nama_pic']").val(response.data.nama_pic);
                    $("input[name='nomor_pic']").val(response.data.nomor_pic);
                    $("input[name='sumber_listrik']").val(response.data.sumber_listrik);
                    $("input[name='gateway_area']").val(response.data.gateway_area);
                    $("input[name='beam']").val(response.data.beam);
                    $("input[name='hub']").val(response.data.hub);
                    $("input[name='kodefikasi']").val(response.data.kodefikasi);
                    $("input[name='sn_antena']").val(response.data.sn_antena);
                    $("input[name='sn_modem']").val(response.data.sn_modem);
                    $("input[name='sn_router']").val(response.data.sn_router);
                    $("input[name='sn_ap1']").val(response.data.sn_ap1);
                    $("input[name='sn_ap2']").val(response.data.sn_ap2);
                    $("input[name='sn_tranciever']").val(response.data.sn_tranciever);
                    $("input[name='sn_stabilizer']").val(response.data.sn_stabilizer);
                    $("input[name='sn_rak']").val(response.data.sn_rak);
                    $("input[name='ip_modem']").val(response.data.ip_modem);
                    $("input[name='ip_router']").val(response.data.ip_router);
                    $("input[name='ip_ap1']").val(response.data.ip_ap1);
                    $("input[name='ip_ap2']").val(response.data.ip_ap2);
                    $("input[name='expected_sqf']").val(response.data.expected_sqf);
                    $('#modalTambahTiketLabel').text('Detail Tiket');
                }
            },
            error: function () {
                // alert("Gagal ambil data site.");
            },
        });
    }
</script>
@endsection
