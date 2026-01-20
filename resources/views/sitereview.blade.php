@extends('layouts.user_type.auth')

@section('content')
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

        <a href="{{ url('timeplan') }}"
        class="btn-custom {{ request()->is('timeplan*') ? 'btn-active' : 'btn-inactive' }}">
            Time Plane
        </a>

        <a href="{{ url('timeline') }}"
        class="btn-custom {{ request()->is('timeline*') ? 'btn-active' : 'btn-inactive' }}">
            Actual Plane
        </a>

        <a href="{{ url('laporaninstalasi') }}"
        class="btn-custom {{ request()->is('laporaninstalasi*') ? 'btn-active' : 'btn-inactive' }}">
            Laporan Instalasi
        </a>
        
    </div>
    <h4>📊 Site Review</h4>

    <!-- FILTER PROJECT & LOKASI -->
    <div class="row g-2 mb-3">
        <div class="col-md-3">
            <label class="fw-bold">PROJECT PHASE</label>
            <select id="projectFilter" class="form-select">
                <option value="">Pilih Project</option>
                @foreach($projects as $p)
                    <option value="{{ $p->id }}"
                        {{ ($selectedProjectId == $p->id) ? 'selected' : '' }}>
                        {{ $p->mitra }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="fw-bold">PROVINSI</label>
            <input type="text" id="provinsiFilter" class="form-control" placeholder="Provinsi">
        </div>
        <div class="col-md-3">
            <label class="fw-bold">KABUPATEN</label>
            <input type="text" id="kabFilter" class="form-control" placeholder="Kabupaten">
        </div>
        <div class="col-md-3">
            <label class="fw-bold">KECAMATAN</label>
            <input type="text" id="kecFilter" class="form-control" placeholder="Kecamatan">
        </div>
    </div>

    <!-- SEARCH -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari Site ID atau Nama Site">
    </div>

    <!-- BUTTON TAMBAH SITE -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahSite">
        ➕ Tambah Site
    </button>

    <!-- TABLE SITE -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Site ID</th>
                        <th>Site Name</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Batch</th>
                        <th>Project Phase</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody id="siteTableBody">
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Pilih Project Phase untuk melihat site
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL TAMBAH SITE -->
<div class="modal fade" id="modalTambahSite" tabindex="-1">
    <div class="modal-dialog">
        <form id="formTambahSite">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Site Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Project Phase</label>
                        <select name="project_id" class="form-select" required>
                            <option value="">Pilih Project</option>
                            @foreach($projects as $p)
                                <option value="{{ $p->id }}">{{ $p->mitra }} ({{ $p->phase ?? '-' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Site ID</label>
                        <input type="text" name="site_id" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Site Name</label>
                        <input type="text" name="site_name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function loadSites(){
    let project_id = document.getElementById('projectFilter').value;
    let prov = document.getElementById('provinsiFilter').value;
    let kab = document.getElementById('kabFilter').value;
    let kec = document.getElementById('kecFilter').value;
    let search = document.getElementById('searchInput').value;

    fetch("{{ route('sitereview.filter') }}",{
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN":"{{ csrf_token() }}"
        },
        body: JSON.stringify({
            project_id: project_id,
            provinsi: prov,
            kabupaten: kab,
            kecamatan: kec,
            search: search
        })
    })
    .then(res=>res.json())
    .then(data=>{
        let tbody = document.getElementById('siteTableBody');
        tbody.innerHTML = '';
        if(data.length===0){
            tbody.innerHTML = `<tr><td colspan="9" class="text-center text-muted">Tidak ada site</td></tr>`;
            return;
        }
        data.forEach((s,i)=>{
            tbody.innerHTML += `<tr>
                <td class="text-center">${i+1}</td>
                <td>${s.site_id}</td>
                <td>${s.site_name}</td>
                <td>${s.provinsi ?? '-'}</td>
                <td>${s.kabupaten ?? '-'}</td>
                <td>${s.kecamatan ?? '-'}</td>
                <td>${s.project?.batch ?? '-'}</td>
                <td>${s.project?.mitra ?? '-'}</td>
                    <td>
                        <div class="progress position-relative" style="height:20px">
    <div class="progress-bar"
         style="width:${s.progress}%">
    </div>
    <span class="position-absolute top-50 start-50 translate-middle fw-bold text-dark">
        ${s.progress}%
    </span>
</div>

                    </td>

            </tr>`;
        });
    });
}

// trigger load
document.getElementById('projectFilter').addEventListener('change', loadSites);
document.getElementById('provinsiFilter').addEventListener('keyup', loadSites);
document.getElementById('kabFilter').addEventListener('keyup', loadSites);
document.getElementById('kecFilter').addEventListener('keyup', loadSites);
document.getElementById('searchInput').addEventListener('keyup', loadSites);

// AJAX TAMBAH SITE
document.getElementById('formTambahSite').addEventListener('submit', function(e){
    e.preventDefault();
    let form = e.target;
    let data = Object.fromEntries(new FormData(form).entries());

    fetch("{{ route('sitereview.storeSite') }}",{
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            "Accept":"application/json",
            "X-CSRF-TOKEN":"{{ csrf_token() }}"
        },
        body: JSON.stringify(data)
    })
    .then(res=>res.json())
    .then(res=>{
        if(res.success){
            alert('Site berhasil ditambahkan!');
            form.reset();
            loadSites();
            let modalEl = document.getElementById('modalTambahSite');
            let modal = bootstrap.Modal.getInstance(modalEl);
            if(!modal) modal = new bootstrap.Modal(modalEl);
            modal.hide();
        }else{
            alert('Gagal menambahkan site!');
        }
    })
    .catch(err=>{
        console.error(err);
        alert('Terjadi error! Cek console.');
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let selected = "{{ $selectedProjectId ?? '' }}";
    if(selected){
        loadSites();
    }
});
</script>
@endsection
