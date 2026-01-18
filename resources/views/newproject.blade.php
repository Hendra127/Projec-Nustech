@extends('layouts.user_type.auth')

@section('content')
<style>
.project-row {
    transition: background .2s ease;
}
.project-row:hover {
    background: #f8f9fa;
}

.site-wrapper {
    animation: fadeIn .3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to   { opacity: 1; transform: translateY(0); }
}

.badge-phase {
    font-size: .75rem;
    padding: .4em .6em;
}

.filter-card {
    background: #f9fafb;
    border-radius: 12px;
    padding: 12px;
    border: 1px dashed #ddd;
}
</style>
<style>
    .btn-custom {
        font-size: .75rem;
        padding: .3rem 1rem;
        border-radius: 12px;
    }
    .btn-inactive {
        background: transparent;
        border: 2px solid #c026d3;
    }
    .btn-active {
        background: #22c55e;
        border: 2px solid #22c55e;
    }
</style>

<div class="container-fluid py-4">

    <!-- NAV -->
    <div class="mb-4 d-flex gap-3">

        <a href="{{ url('newproject') }}"
        class="btn-custom {{ request()->is('newproject*') ? 'btn-active' : 'btn-inactive' }}">
            New Project
        </a>

        <a href="{{ url('sitereview') }}"
        class="btn-custom {{ request()->is('sitereview*') ? 'btn-active' : 'btn-inactive' }}">
            Project Review
        </a>

        <a href="{{ url('laporaninstalasi') }}"
        class="btn-custom {{ request()->is('laporaninstalasi*') ? 'btn-active' : 'btn-inactive' }}">
            Laporan Instalasi
        </a>
        <a href="{{ url('timeline') }}"
        class="btn-custom {{ request()->is('timeline*') ? 'btn-active' : 'btn-inactive' }}">
            Timeline
        </a>
    </div>
{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0">📁 Project Phase</h4>
        <small class="text-muted">Manajemen project & site per wilayah</small>
    </div>

    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        ➕ Tambah Project Phase
    </button>
</div>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- PROJECT TABLE --}}
<div class="card shadow-sm">
<div class="table-responsive">
<table class="table table-hover align-middle mb-0">
<thead class="table-light">
<tr>
    <th width="50">#</th>
    <th>No Kontrak</th>
    <th>Mitra</th>
    <th>Batch</th>
    <th>Phase</th>
    <th class="text-center">Jumlah Site</th>
</tr>
</thead>
<tbody>

@forelse($projects as $p)
<tr class="project-row" onclick="toggleSite({{ $p->id }})" style="cursor:pointer">
    <td>{{ $loop->iteration }}</td>
    <td class="fw-semibold">{{ $p->no_kontrak }}</td>
    <td>{{ $p->mitra }}</td>
    <td>{{ $p->batch }}</td>
    <td>
        <span class="badge bg-info badge-phase">{{ $p->phase }}</span>
    </td>
    <td class="text-center">
        <span class="badge bg-success">
            {{ $p->sites->count() }} Site
        </span>
    </td>
</tr>

<tr>
<td colspan="6" class="p-0">
<div id="site-{{ $p->id }}" class="site-wrapper" style="display:none">

{{-- FILTER --}}
<div class="filter-card m-3">
<div class="row g-2">
    <div class="col-md-4">
        <select class="form-select form-select-sm filter" data-type="provinsi">
            <option value="">🌍 Provinsi</option>
            @foreach($p->sites->pluck('provinsi')->unique() as $v)
                <option value="{{ $v }}">{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select class="form-select form-select-sm filter" data-type="kabupaten">
            <option value="">🏙 Kabupaten</option>
            @foreach($p->sites->pluck('kabupaten')->unique() as $v)
                <option value="{{ $v }}">{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select class="form-select form-select-sm filter" data-type="kecamatan">
            <option value="">📍 Kecamatan</option>
            @foreach($p->sites->pluck('kecamatan')->unique() as $v)
                <option value="{{ $v }}">{{ $v }}</option>
            @endforeach
        </select>
    </div>
</div>
</div>

{{-- SITE TABLE --}}
<div class="px-3 pb-3">
<table class="table table-sm table-striped table-bordered mb-0">
<thead class="table-secondary">
<tr>
    <th width="40">#</th>
    <th>Provinsi</th>
    <th>Kabupaten</th>
    <th>Kecamatan</th>
    <th>Site</th>
</tr>
</thead>
<tbody>
@foreach($p->sites as $s)
<tr class="site-row"
    data-provinsi="{{ $s->provinsi }}"
    data-kabupaten="{{ $s->kabupaten }}"
    data-kecamatan="{{ $s->kecamatan }}">
    <td>{{ $loop->iteration }}</td>
    <td>{{ $s->provinsi }}</td>
    <td>{{ $s->kabupaten }}</td>
    <td>{{ $s->kecamatan }}</td>
    <td class="fw-semibold">{{ $s->site_name }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>

</div>
</td>
</tr>
@empty
<tr>
<td colspan="6" class="text-center text-muted py-4">
    Belum ada project
</td>
</tr>
@endforelse

</tbody>
</table>
</div>
</div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<form method="POST" action="{{ route('newproject.store') }}">
@csrf
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">➕ Tambah Project Phase</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-2">
        <label class="form-label">No Kontrak</label>
        <input type="text" name="no_kontrak" class="form-control" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Mitra</label>
        <input type="text" name="mitra" class="form-control" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Batch</label>
        <input type="text" name="batch" class="form-control" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Phase</label>
        <input type="text" name="phase" class="form-control" required>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-primary btn-sm">Simpan</button>
</div>
</div>
</form>
</div>
</div>

<script>
function toggleSite(id){
    const el = document.getElementById('site-'+id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}

document.querySelectorAll('.filter').forEach(f => {
    f.addEventListener('change', function(){
        const parent = this.closest('.site-wrapper');
        const prov = parent.querySelector('[data-type="provinsi"]').value;
        const kab  = parent.querySelector('[data-type="kabupaten"]').value;
        const kec  = parent.querySelector('[data-type="kecamatan"]').value;

        parent.querySelectorAll('.site-row').forEach(row=>{
            let show = true;
            if(prov && row.dataset.provinsi !== prov) show=false;
            if(kab && row.dataset.kabupaten !== kab) show=false;
            if(kec && row.dataset.kecamatan !== kec) show=false;
            row.style.display = show ? '' : 'none';
        });
    });
});
</script>
@endsection
