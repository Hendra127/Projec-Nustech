@extends('layouts.user_type.auth')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

@php
$role = Auth::user()->role;

$kategoris = [
    'FOTO SEBELUM INSTALASI' => [
            'teknisi_plang_lokasi' => 'teknisi di plang lokasi',
            'keseluruhan_perangkat_sebelum_instalasi' => 'keseluruhan perangkat sebelum instalasi',
            'before_area_antena_vsat' => 'Before area Antenna VSAT',
            'grounding_sebelum' => 'Grounding Sebelum di Tanam',
    ],

    'FOTO SN PERANGKAT' => [
            'sn_antena_vsat_rf' => 'SN Antenna VSAT & Perangkat RF',
            'sn_modem' => 'SN Modem',
            'sn_router' => 'SN Router',
            'sn_power_stabilizer' => 'SN Power Stabilizer',
            'sn_transceiver' => 'SN Transceiver',
            'sn_ap_1' => 'SN AP 1',
            'sn_ap_2' => 'SN AP 2',
    ],

    'FOTO AFTER INSTALASI' => [
            'grounding_setelah' => 'Grounding Setelah di Tanam',
            'terminasi_grounding' => 'Terminasi Grounding antenna/transceiver',
            'after_antena_vsat' => 'After Antenna VSAT',
            'transceiver_terpasang' => 'Transceiver (keadaan terpasang)',
            'modem_menyala' => 'Modem',
            'router_menyala' => 'Router',
            'power_stabilizer_menyala' => 'Power Stabilizer',
    ],

    'FOTO INSTALASI PERANGKAT' => [
            'instalasi_ap_1' => 'Instalasi AP 1',
            'foto_ap_1' => 'Foto AP 1 terpasang',
            'instalasi_ap_2' => 'Instalasi AP 2',
            'foto_ap_2' => 'Foto AP 2 terpasang',
            'pointing_antena' => 'Pointing antenna',
            'instalasi_modem_router_stabilizer' => 'Instalasi modem, Router dan Stabilizer',
    ],
    'DOKUMEN' => [
            'scan_bai' => 'Scan File BAI',
            'scan_bast' => 'Scan File BAST',
            'denah_lokasi' => 'Denah lokasi',
            'surat_keterangan_ssid' => 'Surat Keterangan SSID (Jika Ada)'
    ],
    'SPEEDTEST' => [
            'speedtest_sigmon' => 'Speedtest & Koordinat (SIGMON)',
            'speedtest_ap_1' => 'Speedtest AP 1 (Server Internasional)',
            'speedtest_ap_2' => 'Speedtest AP 2 (Server Internasional)',
            'speedtest_modem' => 'Speedtest Direct Modem',
            'capture_analyzer_ap1_jarak_10_meter' => 'capture analyzer AP 1 jarak 10 meter',
            'capture_analyzer_ap2_jarak_10_meter' => 'capture analyzer AP 2 jarak 10 meter',
            'capture_analyzer_ap1_jarak_20_meter' => 'capture analyzer AP 1 jarak 20 meter',
            'capture_analyzer_ap2_jarak_20_meter' => 'capture analyzer AP 2 jarak 20 meter',
    ], 

    'LAINNYA' => [
            'video_perangkat' => 'Video Perangkat',
            'foto_detik' => 'Foto detik.com',
            'ttd_stempel' => 'Tanda tangan & stempel',
            'akses_lokasi' => 'Akses menuju ke lokasi',
            'capture_config_router_1' => 'Capture Config Router#1',
            'capture_config_router_2' => 'Capture Config Router#2',
            'capture_config_router_3' => 'Capture Config Router#3',
    ],
            ];

@endphp

<div class="container mt-4">

{{-- ================= TAB ================= --}}
<ul class="nav nav-tabs mb-3">
@foreach($kategoris as $kategoriKey => $items)
<li class="nav-item">
    <button class="nav-link @if($loop->first) active @endif"
        data-bs-toggle="tab"
        data-bs-target="#tab-{{ $loop->index }}">
        {{ $kategoriKey }}
    </button>
</li>
@endforeach
</ul>

<div class="tab-content">

@foreach($kategoris as $kategoriKey => $items)
<div class="tab-pane fade @if($loop->first) show active @endif" id="tab-{{ $loop->index }}">

<form class="uploadForm border rounded p-3 mb-4" enctype="multipart/form-data">
@csrf

@foreach($items as $itemKey => $label)
@php
$doc = $laporan->where('nama_foto', $itemKey)->sortByDesc('created_at')->first();
@endphp

<div class="mb-4 border-bottom pb-3">

<label class="fw-bold">{{ $label }}</label>

{{-- ================= PREVIEW SESUDAH UPLOAD ================= --}}
@if($doc)
<div class="mb-2">
    <img src="{{ asset('storage/'.$doc->path) }}"
        class="img-thumbnail previewZoom"
        style="width:120px;height:120px;object-fit:cover;cursor:pointer"
        data-src="{{ asset('storage/'.$doc->path) }}">

    <span class="badge
        @if($doc->status=='approved') bg-success
        @elseif($doc->status=='rejected') bg-danger
        @else bg-warning text-dark @endif">
        {{ strtoupper($doc->status) }}
    </span>
</div>

@if($doc->status=='rejected')
<p class="text-danger small">❌ Ditolak: {{ $doc->reject_reason }}</p>
@elseif($doc->status=='pending')
<p class="text-warning small">⏳ Menunggu persetujuan admin</p>
@endif
@endif

{{-- ================= USER UPLOAD ================= --}}
@if($role==='user' && (!$doc || $doc->status==='rejected'))

<textarea class="form-control mb-2"
    name="items[{{ $itemKey }}][keterangan]"
    placeholder="Keterangan">{{ $doc->keterangan ?? '' }}</textarea>

<input type="file"
    class="form-control mb-2 previewInput"
    name="items[{{ $itemKey }}][foto]"
    accept="image/*">

{{-- PREVIEW SEBELUM UPLOAD --}}
<img class="img-thumbnail d-none previewTemp"
    style="width:120px;height:120px;object-fit:cover;cursor:pointer">

@endif

{{-- ================= ADMIN ACTION ================= --}}
@if($doc && in_array($role,['admin','superadmin']) && $doc->status==='pending')
<div class="mt-2">
    <button type="button"
        class="btn btn-success btn-sm approveBtn"
        data-id="{{ $doc->id }}">Approve</button>

    <button type="button"
        class="btn btn-danger btn-sm rejectBtn"
        data-id="{{ $doc->id }}">Reject</button>
</div>
@endif

</div>
@endforeach

@if($role==='user')
<button type="submit" class="btn btn-primary w-100">
    Upload {{ $kategoriKey }}
</button>
@endif

</form>
</div>
@endforeach
</div>
</div>

{{-- ================= MODAL ZOOM FOTO ================= --}}
<div class="modal fade" id="zoomModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <img id="zoomImage" class="w-100 rounded shadow">
        </div>
    </div>
</div>

{{-- ================= PREVIEW SEBELUM UPLOAD ================= --}}
<script>
$(document).on('change','.previewInput',function(){
    let input = this;
    let preview = $(this).closest('div').find('.previewTemp');

    if(input.files && input.files[0]){
        let reader = new FileReader();
        reader.onload = e => {
            preview.attr('src', e.target.result)
                   .removeClass('d-none')
                   .attr('data-src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
});
</script>

{{-- ================= ZOOM FOTO ================= --}}
<script>
$(document).on('click','.previewZoom, .previewTemp',function(){
    $('#zoomImage').attr('src', $(this).data('src'));
    $('#zoomModal').modal('show');
});
</script>

{{-- ================= UPLOAD ================= --}}
<script>
$('.uploadForm').on('submit',function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url:"{{ route('laporaninstalasi.store') }}",
        type:"POST",
        data:formData,
        processData:false,
        contentType:false,
        success:function(){
            Swal.fire('Berhasil','Foto berhasil diupload','success')
            .then(()=>location.reload());
        },
        error:function(xhr){
            console.error(xhr.responseText);
            Swal.fire('Gagal','Upload gagal','error');
        }
    });
});
</script>

{{-- ================= APPROVE ================= --}}
<script>
$(document).on('click','.approveBtn',function(){
    $.post("{{ route('laporaninstalasi.approve') }}",{
        id:$(this).data('id'),
        _token:"{{ csrf_token() }}"
    },()=>location.reload());
});
</script>

{{-- ================= REJECT ================= --}}
<script>
$(document).on('click','.rejectBtn',function(){
    let id=$(this).data('id');

    Swal.fire({
        title:'Reject Foto',
        input:'textarea',
        inputLabel:'Alasan reject',
        showCancelButton:true,
        confirmButtonColor:'#dc3545'
    }).then(res=>{
        if(!res.isConfirmed || !res.value) return;

        $.post("{{ route('laporaninstalasi.reject') }}",{
            id:id,
            reject_reason:res.value,
            _token:"{{ csrf_token() }}"
        },()=>location.reload());
    });
});
</script>

@endsection
