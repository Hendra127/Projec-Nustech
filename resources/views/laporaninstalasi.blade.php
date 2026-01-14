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
                    $kategoris = ['modem' => 'Modem', 'router' => 'Router', 'power_stabilizer' => 'Power Stabilizer', 'foto_teknisi_pxlang_lokasi' => 'Foto teknisi di plang lokasi', 'foto_perangkat_sebelum_instalasi' =>'Foto keseluruhan perangkat sebelum instalasi ',    'sumber_kelistrikan' =>
        'Sumber kelistrikan', 'speedtest_sigmon'=>'Speedtest dan titik koordinat (SIGMON)', 'Before_Antena_VSAT'=>'Before Antenna VSAT ','FOTO SQF'=>'FOTO SQF ', 'After_Antenna_VSAT'=>'After Antenna VSAT ', 'SN_Antenna_VSAT_dan_Perangkat_RF'=>'SN Antenna VSAT & Perangkat RF', 'Pointing_antenna'=>'Pointing antenna', 'Grounding_Sebelum_di_Tanam'=>'Grounding Sebelum di Tanam', 'Grounding_setelah_di_tanam'=>'Grounding setelah di tanam', 'SN_Tranciever'=>'SN Tranciever','Terminasi_Grounding antenna/tranciver'=>'Terminasi Grounding antenna/tranciver','SN_Antenna_VSAT_dan_Perangkat_RF'=>'SN Antenna VSAT & Perangkat RF','Pointing antenna'=>'Pointing antenna',
        'Grounding_Sebelum_di_Tanam'=>'Grounding Sebelum di Tanam',
        'Grounding_setelah_di_tanam'=>'Grounding setelah di tanam',
        'SN_Tranciever'=>'SN Tranciever',
        'Terminasi_Grounding antenna/tranciver'=>'Terminasi Grounding antenna/tranciver',
        'Ruangan_perangkat_indoor'=>'Ruangan perangkat indoor',
        'Jalur_kabel_IFL'=>'Jalur kabel IFL',
        'Rak_indoor_Tertutup'=>'Rak indoor Tertutup',
        'Rak_Indoor_terbuka'=>'Rak Indoor terbuka',
        'SN_Rak_indoor'=>'SN Rak indoor',
        'Terminasi_grounding_rak'=>'Terminasi grounding rak',
        'SN_AP_1'=>'SN AP 1',
        'Instalasi_AP_1'=>'Instalasi AP 1',
        'Foto_AP_1_terpasang'=>'Foto AP 1 terpasang',
        'SN_AP_2'=>'SN AP 2',
        'Instalasi_AP_2'=>'Instalasi AP 2',
        'Foto_AP_2_terpasang'=>'Foto AP 2 terpasang',
        'Foto_bersama_PIC_(depan_rak_dan_depan_antena_sambil_membawa_bai_bast)'=>'Foto bersama PIC (depan rak dan depan antena sambil membawa bai bast)',
        'Denah_lokasi'=>'Denah lokasi',
        'Scan_File_BAI'=>'Scan File BAI',
        'Scan_File_BAST'=>'Scan File BAST',
        'Video_Perangkat'=>'Video Perangkat',
        'FOTO_speedtest_AP_1_(speedtest.net_ke_singapore)'=>'FOTO speedtest AP 1 (speedtest.net ke singapore/server internasional)',
        'FOTO_speedtest_AP_2_(speedtest.net_ke_singapore)'=>'FOTO speedtest AP 2 (speedtest.net ke singapore/server internasional)',
        'FOTO_speedtest_Directmodem_(speedtest.net_ke_singapore)'=>'FOTO speedtest Directmodem (speedtest.net ke singapore/server internasional)',
        'Capture wifi analyzer AP 1 (10 meter dan 20 meter)'=>'Capture wifi analyzer AP 1 (10 meter dan 20 meter)',
        'Capture_wifi_analyzer_AP_2_(10_meter_dan_20_meter)'=>'Capture wifi analyzer AP 2 BAKTI AKSI (10 meter dan 20 meter)',
        'Foto_detik.com'=>'Foto detik.com',
        'Tanda_tangan_&_setempel_di_kertas_kosong'=>'Tanda tangan & setempel di kertas kosong',
        'AKSES_menuju_ke_lokasi'=>'AKSES menuju ke lokasi'
    ];
@endphp

               @foreach($kategoris as $key => $label)
<div class="col-12 col-md-6 col-lg-3 d-flex">
    <div class="card flex-fill h-100 shadow-sm">
        <div class="card-body d-flex flex-column">

            <h6 class="fw-semibold text-center mb-2"
    style="
        font-size:13px;
        line-height:1.3;
        height: 34px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    ">
    {{ $label }}
</h6>



            <form class="formUploadKategori d-flex flex-column flex-grow-1"
                  action="{{ route('dokumentasi.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="kategori" value="{{ $key }}">

                <div class="mb-2">
                  
                    <input
                        type="file"
                        class="form-control form-control-sm fotoInstalasi"
                        name="foto[]"
                        multiple
                    >
                </div>

                <!-- PREVIEW (tinggi dikunci) -->
                <div class="preview border rounded mb-2"
                     style="min-height: 20px;"></div>

                <!-- BUTTON SELALU DI BAWAH -->
                <button type="submit"
                        class="btn btn-success btn-sm w-100 mt-auto">
                    Upload Foto
                </button>
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
