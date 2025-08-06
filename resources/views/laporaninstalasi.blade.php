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
    <!-- Tombol Mode Gelap/Terang -->
    <div class="d-flex justify-content-end align-items-center mb-3" style="position: absolute; top: 10px; left: 30px; z-index: 10;">
        <button id="modeToggle" class="btn btn-secondary">🌙 Dark Mode</button>
    </div>
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

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #18181b !important;
            color: #f3f4f6 !important;
        }
        body.dark-mode .card {
            background-color: #27272a;
            color: #f3f4f6;
        }
        body.dark-mode .btn-custom,
        body.dark-mode .btn-active,
        body.dark-mode .btn-inactive {
            color: #f3f4f6 !important;
            border-color: #a21caf !important;
        }
        body.dark-mode .btn-active {
            background-color: #22c55e !important;
            color: #18181b !important;
        }
        body.dark-mode .btn-inactive {
            background-color: transparent !important;
        }
        body.dark-mode .btn-inactive:hover {
            background-color: #27272a !important;
        }
        body.dark-mode .nav-tabs .nav-link.active {
            background-color: #27272a !important;
            color: #22c55e !important;
        }
        body.dark-mode .nav-tabs .nav-link {
            color: #f3f4f6 !important;
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
<div class="container mt-4">
    <!-- Tab Navigasi -->
    <ul class="nav nav-tabs" id="installTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#dataInstalasi" role="tab">Installation Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#fotoDokumentasi" role="tab">Documentation Photo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#uploadFoto" role="tab">Upload Photo</a>
        </li>
    </ul>

    <!-- Konten Tab -->
    <div class="tab-content mt-3">
        <!-- Tab 1: Data Instalasi -->
        <div class="tab-pane fade show active" id="dataInstalasi" role="tabpanel">
            <form>
                <div class="mb-3">
                    <label for="namaLokasi" class="form-label">Nama Lokasi</label>
                    <input type="text" class="form-control" id="namaLokasi" name="nama_lokasi">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
        </div>

        <!-- Tab 2: Foto Dokumentasi -->
        <div class="tab-pane fade" id="fotoDokumentasi" role="tabpanel">
            <p>Foto dokumentasi instalasi akan tampil di sini:</p>

            @if($dokumentasi->isEmpty())
                <p class="text-muted">Belum ada dokumentasi.</p>
            @else   
                <div class="row">
                    @foreach($dokumentasi as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset($item->path) }}" alt="Documentation Photo" class="card-img-top W-100 h-100" style="object-fit: cover; max-height: 200px;">
                                <div class="card-body">
                                    <p class="card-text">{{ $item->keterangan ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Tab 3: Upload Foto -->
        <div class="tab-pane fade" id="uploadFoto" role="tabpanel">
            <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan (Nama Foto)</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
                <div class="mb-3">
                    <label for="fotoInstalasi" class="form-label">Foto Instalasi</label>
                    <input class="form-control" type="file" id="fotoInstalasi" name="foto[]" multiple>
                </div>
                <div id="preview" class="mb-3"></div> <!-- Preview image container -->
                <button type="submit" class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Bootstrap JS + Preview Script --}}
<script>
    // Fungsi untuk memperbesar gambar saat diklik
    $(document).on('click', '.card-img-top', function () {
        const imgSrc = $(this).attr('src');
        Swal.fire({
            imageUrl: imgSrc,
            imageAlt: 'Documentation Photo',
            showCloseButton: true,
            showConfirmButton: false,
            width: 'auto',
            padding: '1em',
            background: '#fff'
        });
    });
</script>
<script>
    $(document).ready(function () {
        // SweetAlert2 for form submission
        $('form').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil disimpan.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
<script>
    document.getElementById('fotoInstalasi').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        preview.innerHTML = '';

        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'img-thumbnail';
                img.style.maxWidth = '300px';
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<script>
    // Toggle dark/light mode
    document.getElementById('modeToggle').addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
        if (document.body.classList.contains('dark-mode')) {
            this.textContent = '☀️ Light Mode';
        } else {
            this.textContent = '🌙 Dark Mode';
        }
    });
</script>

@endsection
