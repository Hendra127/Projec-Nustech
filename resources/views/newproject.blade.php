@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right,rgb(209, 215, 231),rgb(134, 173, 229));
    min-height: 100vh;
  }
  table.table td,
  table.table th {
    font-size: 14px; /* Atur ukuran font yang lebih kecil */
  }
 table.table tbody td {
  padding: 0px 5px !important;   /* Atas-bawah: 0px, Kiri-kanan: 5px */
  line-height: 0px !important;     /* Line height pas sama font size */
  font-size: 14px !important;
  vertical-align: middle !important;
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
@php
    $role = Auth::user()->role;
@endphp
<div class="card">    
    <div class="card-header">                    
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex gap-2 mb-2">
                @if (in_array($role, ['admin', 'superadmin']))
                <a href="#" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLong" title="Import Data">
                    <i class="fa fa-upload"></i>
                </a>
               <a href="#" class="btn btn-outline-primary btn-sm" title="Tambah Data" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                    <i class="fa fa-plus"></i>
                </a>
                @endif
                <a href="{{ route('newprojectexport') }}" class="btn btn-outline-success btn-sm" title="Export Data">
                    <i class="fa fa-download"></i>
                </a>
            </div>

            <form action="{{ route('newproject') }}" method="GET">
                <div class="input-group input-group-sm" style="width: 220px;">
                    <input type="text" name="query" class="form-control" placeholder="Enter To Search" value="{{ request()->query('query') }}">
                    <span class="input-group-text" style="cursor: pointer;" onclick="this.closest('form').submit()">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive" style="margin-top: -40px;">
            <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                <thead class="table-dark">
                    <tr>
                        <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm text-nowrap">
            <thead class="table-dark text-center">
                <tr>
                    <th>NO</th>
                    <th>ID SITE</th>
                    <th>SITE NAME</th>
                    <th>TIPE</th>
                    <th>BATCH</th>
                    <th>LATITUDE</th>
                    <th>LONGITUDE</th>
                    <th>PROVINSI</th>
                    <th>KABUPATEN</th>
                    <th>KECAMATAN</th>
                    <th>KELURAHAN</th>
                    <th>ALAMAT</th>
                    <th>NAMA PIC</th>
                    <th>NOMOR PIC</th>
                    <th>SUMBER LISTRIK</th>
                    <th>GATEWAY AREA</th>
                    <th>BEAM</th>
                    <th>HUB</th>
                    <th>KODEFIKASI</th>
                    <th>SN ANTENA</th>
                    <th>SN MODEM</th>
                    <th>SN ROUTER</th>
                    <th>SN AP1</th>
                    <th>SN AP2</th>
                    <th>SN TRANCIEVER</th>
                    <th>SN STABILIZER</th>
                    <th>SN RAK</th>
                    <th>IP MODEM</th>
                    <th>IP ROUTER</th>
                    <th>IP AP1</th>
                    <th>IP AP2</th>
                    <th>EXPECTED SQF</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newprojects as $index => $project)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $project->site_id }}</td>
                        <td>{{ $project->sitename }}</td>
                        <td class="text-center">{{ $project->tipe }}</td>
                        <td class="text-center">{{ $project->batch }}</td>
                        <td class="text-center">{{ $project->latitude }}</td>
                        <td class="text-center">{{ $project->longitude }}</td>
                        <td>{{ $project->provinsi }}</td>
                        <td>{{ $project->kab }}</td>
                        <td>{{ $project->kecamatan }}</td>
                        <td>{{ $project->kelurahan }}</td>
                        <td>{{ $project->alamat_lokasi }}</td>
                        <td>{{ $project->nama_pic }}</td>
                        <td class="text-center">{{ $project->nomor_pic }}</td>
                        <td>{{ $project->sumber_listrik }}</td>
                        <td class="text-center">{{ $project->gateway_area }}</td>
                        <td class="text-center">{{ $project->beam }}</td>
                        <td class="text-center">{{ $project->hub }}</td>
                        <td>{{ $project->kodefikasi }}</td>
                        <td class="text-center">{{ $project->sn_antena }}</td>
                        <td class="text-center">{{ $project->sn_modem }}</td>
                        <td class="text-center">{{ $project->sn_router }}</td>
                        <td class="text-center">{{ $project->sn_ap1 }}</td>
                        <td class="text-center">{{ $project->sn_ap2 }}</td>
                        <td class="text-center">{{ $project->sn_tranciever }}</td>
                        <td class="text-center">{{ $project->sn_stabilizer }}</td>
                        <td class="text-center">{{ $project->sn_rak }}</td>
                        <td class="text-center">{{ $project->ip_modem }}</td>
                        <td class="text-center">{{ $project->ip_router }}</td>
                        <td class="text-center">{{ $project->ip_ap1 }}</td>
                        <td class="text-center">{{ $project->ip_ap2 }}</td>
                        <td class="text-center">{{ $project->expected_sqf }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" onclick="openDetailModal({{ $project->id }})">
                                <i class="fa fa-info-circle"></i> Detail
                            </a>
                            <a href="#" onclick="openEditModal({{ $project->id }})" class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil"></i> Update
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="position-sticky bottom-0 end-0 bg-white py-3" style="z-index: 1000;">
            <div class="d-flex justify-content-end pe-3">
                {{ $newprojects->links() }}
            </div>
        </div>
    </div>
</div>


    <!-- Modal Import -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('newprojectimport') }}" method="post" enctype="multipart/form-data">
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
    
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Site</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row g-2">
                            <input type="hidden" name="id" id="editId">
                            <div class="form-group col-md-6">
                                <label>ID Site</label>
                                <input type="text" name="site_id" id="editSiteId" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Site Name</label>
                                <input type="text" name="sitename" id="editSitename" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tipe</label>
                                <input type="text" name="tipe" id="editTipe" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Batch</label>
                                <input type="text" name="batch" id="editBatch" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Latitude</label>
                                <input type="text" name="latitude" id="editLatitude" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Longitude</label>
                                <input type="text" name="longitude" id="editLongitude" class="form-control">
                            </div>    
                            <div class="form-group col-md-6">
                                <label>Provinsi</label>
                                <input type="text" name="provinsi" id="editProvinsi" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kabupaten</label>
                                <input type="text" name="kab" id="editKabupaten" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" id="editKecamatan" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kelurahan</label>
                                <input type="text" name="kelurahan" id="editKelurahan" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Alamat</label>
                                <input type="text" name="alamat_lokasi" id="editAlamat" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nama PIC</label>
                                <input type="text" name="nama_pic" id="editNamaPic" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nomor PIC</label>
                                <input type="text" name="nomor_pic" id="editNomorPic" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sumber Listrik</label>
                                <input type="text" name="sumber_listrik" id="editSumberListrik" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gateway Area</label>
                                <input type="text" name="gateway_area" id="editGatewayArea" class="form-control">
                            </div>
                            <div class="form-group
                            col-md-6">
                                <label>Beam</label>
                                <input type="text" name="beam" id="editBeam" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Hub</label>
                                <input type="text" name="hub" id="editHub" class="form-control">    
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kodefikasi</label>
                                <input type="text" name="kodefikasi" id="editKodefikasi" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Antena</label>
                                <input type="text" name="sn_antena" id="editSnAntena" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Modem</label>
                                <input type="text" name="sn_modem" id="editSnModem" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Router</label>
                                <input type="text" name="sn_router" id="editSnRouter" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN AP1</label>
                                <input type="text" name="sn_ap1" id="editSnAp1" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN AP2</label>
                                <input type="text" name="sn_ap2" id="editSnAp2" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Tranciever</label>
                                <input type="text" name="sn_tranciever" id="editSnTranciever" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Stabilizer</label>
                                <input type="text" name="sn_stabilizer" id="editSnStabilizer" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Rak</label>
                                <input type="text" name="sn_rak" id="editSnRak" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>IP Modem</label>
                                <input type="text" name="ip_modem" id="editIpModem" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>IP Router</label>
                                <input type="text" name="ip_router" id="editIpRouter" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>IP AP1</label>
                                <input type="text" name="ip_ap1" id="editIpAp1" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>IP AP2</label>
                                <input type="text" name="ip_ap2" id="editIpAp2" class="form-control">
                            </div>
                            <div class="form-group col-md-6">   
                                <label>Expected SQF</label>
                                <input type="text" name="expected_sqf" id="editExpectedSqf" class="form-control">        
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('newproject.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Site Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row g-2">
                            <div class="form-group col-md-6">
                                <label>ID Site</label>
                                <input type="text" name="site_id" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Site Name</label>
                                <input type="text" name="sitename" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tipe</label>
                                <input type="text" name="tipe" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Batch</label>
                                <input type="text" name="batch" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Latitude</label>
                                <input type="text" name="latitude" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Longitude</label>
                                <input type="text" name="longitude" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Provinsi</label>
                                <input type="text" name="provinsi" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kabupaten</label>
                                <input type="text" name="kab" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Alamat</label>
                                <input type="text" name="alamat_lokasi" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nama PIC</label>
                                <input type="text" name="nama_pic" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nomor PIC</label>
                                <input type="text" name="nomor_pic" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sumber Listrik</label>
                                <input type="text" name="sumber_listrik" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gateway Area</label>
                                <input type="text" name="gateway_area" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Beam</label>
                                <input type="text" name="beam" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Hub</label>
                                <input type="text" name="hub" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kodefikasi</label>
                                <input type="text" name="kodefikasi" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Antena</label>
                                <input type="text" name="sn_antena" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Modem</label>
                                <input type="text" name="sn_modem" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Router</label>
                                <input type="text" name="sn_router" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN AP1</label>
                                <input type="text" name="sn_ap1" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN AP2</label>
                                <input type="text" name="sn_ap2" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Tranciever</label>
                                <input type="text" name="sn_tranciever" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Stabilizer</label>
                                <input type="text" name="sn_stabilizer" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>SN Rak</label>
                                <input type="text" name="sn_rak" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>IP Modem</label>
                                <input type="text" name="ip_modem" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>IP Router</label>
                                <input type="text" name="ip_router" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>IP AP1</label>
                                <input type="text" name="ip_ap1" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>IP AP2</label>
                                <input type="text" name="ip_ap2" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Expected SQF</label>
                                <input type="text" name="expected_sqf" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                            <input type="text" name="site_id" class="form-control" disabled>
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

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    function openEditModal(id) {
        $.ajax({
            url: `/newproject/${id}`,
            method: "GET",
            success: function (response) {
                if (response.success) {
                    $('#editModal').modal('show'); 
                    $('#editForm').attr('action', `/newproject/update/${id}`);
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
                alert("Gagal ambil data site.");
            },
        });
    }

    $(document).ready(function() {
        $('.btn-primary.btn-sm').each(function() {
            var href = $(this).attr('href');
            if (href && href.includes('/dataupdate/')) {
                var id = href.split('/').pop();
                $(this).attr('href', '#');
                $(this).attr('onclick', `openEditModal(${id}); return false;`);
            }
        });
    });
</script>

<script>
    function openDetailModal(id) {
        fetch(`/newproject/${id}`)
            .then(response => response.json())
            .then(res => {
                if (res.success) {
                    const data = res.data;
                    const modal = document.getElementById('modalDetailDataSite');
                    
                    // Loop isi semua input dalam modal
                    for (const key in data) {
                        const input = modal.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.value = data[key] ?? '';
                        }
                    }

                    const bsModal = new bootstrap.Modal(modal);
                    bsModal.show();
                } else {
                    alert('Data tidak ditemukan.');
                }
            })
            .catch(() => {
                alert('Gagal mengambil data detail site.');
            });
    }
</script>
@endsection