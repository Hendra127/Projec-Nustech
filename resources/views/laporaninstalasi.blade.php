@extends('layouts.user_type.auth')

@section('content')

<!-- Register Service Worker for Offline Access -->
<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/mns/public/js/offline-sw.js')
        .then(() => console.log('Service Worker aktif'))
        .catch(err => console.error('SW gagal', err));
}
</script>

<!-- ================= OPERASIONAL BUTTON ================= -->
<div class="d-flex justify-content-center align-items-center mb-3" style="position: absolute; top: 10px; left: 50%; transform: translateX(-50%); z-index: 10;">
  <a href="#" data-bs-toggle="modal" data-bs-target="#operasionalModal" style="text-decoration: none; color: #000;">
    <h6 class="mb-0"><strong>Operasional</strong></h6>
  </a>
</div>

<div class="container-fluid mt-4">
    <!-- Tombol Mode Gelap/Terang -->
    <div class="d-flex justify-content-end align-items-center mb-3" style="position: fixed; bottom: 5px; right: 30px; z-index: 10;">
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
            border-radius: 50px;
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

<!-- ================= MAIN ================= -->
<div class="container mt-4">

    <!-- ================= TAB ================= -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#dataInstalasi">Installation Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#fotoDokumentasi">Documentation Photo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#uploadFoto">Upload Photo</a>
        </li>
    </ul>

    <div class="tab-content mt-3">

        <!-- ================= TAB 1 ================= -->
        <div class="tab-pane fade show active" id="dataInstalasi">
            <form>
                <div class="mb-3">
                    <label>Nama Lokasi</label>
                    <input type="text" class="form-control" name="nama_lokasi">
                </div>
                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan"></textarea>
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>

        <!-- ================= TAB 2 ================= -->
        <div class="tab-pane fade" id="fotoDokumentasi">
            @if($dokumentasi->isEmpty())
                <p class="text-muted">Belum ada dokumentasi.</p>
            @else
            <div class="row">
                @foreach($dokumentasi as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('public/storage/' . $item->path) }}"
                            class="card-img-top"
                            style="object-fit:cover;max-height:200px">
                        <div class="card-body">
                            <p>{{ $item->keterangan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- ================= TAB 3 ================= -->
        <div class="tab-pane fade" id="uploadFoto">

            <div class="row g-4"> <!-- 🔥 GRID UTAMA -->

                <!-- ================= UPLOAD MODEM ================= -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">

                            <h6 class="fw-bold mb-3">Modem</h6>

                            <form class="formUploadKategori"
                                action="{{ route('dokumentasi.store') }}"
                                method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="kategori" value="modem">

                                <div class="mb-3">
                                    <label>Keterangan Modem</label>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Foto Modem</label>
                                    <input type="file" class="form-control" name="foto[]" multiple>
                                </div>

                                <div class="preview mb-3"></div>

                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    Upload Modem
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- ================= UPLOAD ROUTER ================= -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">

                            <h6 class="fw-bold mb-3">Router</h6>

                            <form class="formUploadKategori"
                                action="{{ route('dokumentasi.store') }}"
                                method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="kategori" value="router">

                                <div class="mb-3">
                                    <label>Keterangan Router</label>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Foto Router</label>
                                    <input type="file" class="form-control" name="foto[]" multiple>
                                </div>

                                <div class="preview mb-3"></div>

                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    Upload Router
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- ================= POWER STABILIZER ================= -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">

                            <h6 class="fw-bold mb-3">Power Stabilizer</h6>

                            <form class="formUploadKategori"
                                action="{{ route('dokumentasi.store') }}"
                                method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="kategori" value="power_stabilizer">

                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto[]" multiple>
                                </div>

                                <div class="preview mb-3"></div>

                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    Upload Power
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- ================= LAINNYA ================= -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">

                            <h6 class="fw-bold mb-3">Lainnya</h6>

                            <form id="formUploadDokumentasi"
                                action="{{ route('dokumentasi.store') }}"
                                method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="kategori" value="lainnya">

                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto[]" multiple>
                                </div>

                                <div id="preview" class="mb-3"></div>

                                <button class="btn btn-success btn-sm w-100">
                                    Upload
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ================= JS ================= -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ================= PREVIEW ================= -->
<script>
document.getElementById('fotoInstalasi').addEventListener('change', function () {
    const preview = document.getElementById('preview');
    preview.innerHTML = '';
    [...this.files].forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail m-1';
            img.style.maxWidth = '150px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>

<!-- ================= OFFLINE UPLOAD ENGINE ================= -->
<script>
let db;
const request = indexedDB.open("offline-installer-db", 1);

request.onupgradeneeded = e => {
    db = e.target.result;
    db.createObjectStore("uploads", { autoIncrement: true });
};

request.onsuccess = e => db = e.target.result;

function saveOffline(formData) {
    const tx = db.transaction("uploads", "readwrite");
    tx.objectStore("uploads").add(formData);
}

async function uploadOffline() {
    const tx = db.transaction("uploads", "readwrite");
    const store = tx.objectStore("uploads");

    store.openCursor().onsuccess = async e => {
        const cursor = e.target.result;
        if (cursor) {
            try {
                const res = await fetch("{{ route('dokumentasi.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: cursor.value
                });

                if (res.ok) {
                    store.delete(cursor.key);
                }
            } catch (err) {
                console.log('Masih offline');
            }
            cursor.continue();
        }
    };
}

document.querySelectorAll('.formUploadKategori').forEach(form => {
    form.addEventListener('submit', function (e) {
        if (!navigator.onLine) {
            e.preventDefault();
            saveOffline(new FormData(this));

            Swal.fire({
                icon: 'info',
                title: 'Offline',
                text: 'Foto disimpan & akan diupload otomatis'
            });

            this.reset();
            this.querySelector('.preview').innerHTML = '';
        }
    });
});

window.addEventListener('online', async () => {
    uploadOffline();
    Swal.fire('Online', 'Upload offline diproses', 'success');
});
</script>

<!-- ================= DARK MODE TOGGLE ================= -->
<script>
const modeToggle = document.getElementById('modeToggle');
const isDarkMode = localStorage.getItem('darkMode') === 'true';

// Apply dark mode on page load
if (isDarkMode) {
    document.body.classList.add('dark-mode');
    modeToggle.textContent = '☀️ Light Mode';
}

// Toggle dark mode on button click
modeToggle.addEventListener('click', function (e) {
    e.preventDefault();
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark);
    modeToggle.textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';
});
</script>

@endsection
