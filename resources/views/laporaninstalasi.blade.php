@extends('layouts.user_type.auth')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

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
            <a class="nav-link" data-bs-toggle="tab" href="#uploadFoto" id="uploadFoto-tab">Upload Photo</a>
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
                            <div class="card" id="item-{{ $item->id }}">
                                <img src="{{ asset('storage/' . $item->path) }}"
                                    class="card-img-top"
                                    style="object-fit:cover;max-height:200px">
                                <div class="card-body">
                                    <p><strong>{{ $item->nama_foto }}</strong></p>
                                    <p>{{ $item->keterangan ?? '-' }}</p>

                                    @if($item->status == 'pending')
                                        <button type="button" class="btn btn-success btn-sm approveBtn" data-id="{{ $item->id }}">
                                            Approve
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm rejectBtn" data-id="{{ $item->id }}">
                                            Reject
                                        </button>
                                    @elseif($item->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                        <p><small>Alasan: {{ $item->reject_reason }}</small></p>
                                    @elseif($item->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- ================= TAB 3 ================= -->
        <div class="tab-pane fade" id="uploadFoto">
            <div class="row g-4">

                <!-- ================= UPLOAD KATEGORI ================= -->
                @php
                    $kategoris = ['modem' => 'Modem', 'router' => 'Router', 'power_stabilizer' => 'Power Stabilizer', 'lainnya' => 'Lainnya'];
                @endphp

                @foreach($kategoris as $key => $label)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">

                            <h6 class="fw-bold mb-3">{{ $label }}</h6>

                            <form class="formUploadKategori" action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="kategori" value="{{ $key }}">

                                <div class="mb-3">
                                    <label>Keterangan {{ $label }}</label>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Foto {{ $label }}</label>
                                    <input type="file" class="form-control fotoInstalasi" name="foto[]" multiple>
                                </div>

                                <div class="preview mb-3"></div>

                                <button type="submit" class="btn btn-success btn-sm w-100">Upload {{ $label }}</button>
                            </form>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>
</div>

<!-- ================= JS ================= -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function(){

    // ====== AJAX SETUP CSRF ======
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // ====== APPROVE ======
    $(document).on('click', '.approveBtn', function(e){
        e.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Approve foto?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Approve',
        }).then(result => {
            if(result.isConfirmed){
                $.post("{{ route('dokumentasi.approve') }}", { id: id }, function(res){
                    if(res.success){
                        Swal.fire('Approved', res.message, 'success');
                        let card = $('#item-' + id + ' .card-body');
                        card.find('.approveBtn, .rejectBtn').remove();
                        card.append('<span class="badge bg-success">Approved</span>');
                    }
                }).fail(function(xhr){
                    Swal.fire('Error', 'Terjadi kesalahan: ' + xhr.status, 'error');
                });
            }
        });
    });

    // ====== REJECT ======
    $(document).on('click', '.rejectBtn', function(e){
        e.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Alasan reject foto',
            input: 'text',
            inputPlaceholder: 'Masukkan alasan reject',
            showCancelButton: true,
        }).then(result => {
            if(result.isConfirmed && result.value){
                $.post("{{ route('dokumentasi.reject') }}", {
                    id: id,
                    reject_reason: result.value
                }, function(res){
                    if(res.success){
                        Swal.fire('Rejected', res.message, 'warning');
                        let card = $('#item-' + id + ' .card-body');
                        card.find('.approveBtn, .rejectBtn').remove();
                        card.append('<span class="badge bg-danger">Rejected</span><p><small>Alasan: '+ result.value +'</small></p>');
                    }
                }).fail(function(xhr){
                    Swal.fire('Error', 'Terjadi kesalahan: ' + xhr.status, 'error');
                });
            } else if(result.isConfirmed){
                Swal.fire('Error', 'Alasan reject harus diisi', 'error');
            }
        });
    });

    // ====== PREVIEW FOTO ======
    document.querySelectorAll('.fotoInstalasi').forEach(input => {
        input.addEventListener('change', function () {
            const preview = this.closest('.card-body').querySelector('.preview');
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
    });

    // ====== OFFLINE UPLOAD ENGINE ======
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
            if(cursor){
                try {
                    const res = await fetch("{{ route('dokumentasi.store') }}", {
                        method: "POST",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        body: cursor.value
                    });
                    if(res.ok) store.delete(cursor.key);
                } catch(err){ console.log('Masih offline'); }
                cursor.continue();
            }
        };
    }

    document.querySelectorAll('.formUploadKategori').forEach(form => {
        form.addEventListener('submit', function (e) {
            if(!navigator.onLine){
                e.preventDefault();
                saveOffline(new FormData(this));
                Swal.fire({ icon:'info', title:'Offline', text:'Foto disimpan & akan diupload otomatis' });
                this.reset();
                this.querySelector('.preview').innerHTML = '';
            }
        });
    });

    window.addEventListener('online', async () => {
        uploadOffline();
        Swal.fire('Online', 'Upload offline diproses', 'success');
    });

});
</script>
@endsection
