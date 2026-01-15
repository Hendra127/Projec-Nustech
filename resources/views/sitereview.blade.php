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
        <a href="{{ url('newproject') }}" class="btn-custom btn-inactive">New Project</a>
        <a href="{{ url('sitereview') }}" class="btn-custom btn-active">Site Review</a>
        <a href="{{ url('laporaninstalasi') }}" class="btn-custom btn-inactive">Laporan Instalasi</a>
    </div>

    <h5>DATA SITE PENYEDIA : CV. NUSTECH</h5>

    <!-- FILTERS -->
    <div class="row g-2 mb-3">

        <div class="col-md-3">
            <label class="fw-bold">PROJECT PHASE</label>
            <select id="projectPhaseFilter" class="form-select">
                <option value="">SEMUA PROJECT PHASE</option>
                @foreach ($projectPhases as $phase)
                    <option value="{{ $phase->title }}">{{ $phase->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="fw-bold">PROVINSI</label>
            <select id="provinsiFilter" class="form-select">
                <option value="">SEMUA PROVINSI</option>
                @foreach ($provinsiList as $p)
                    <option value="{{ $p }}">{{ $p }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="fw-bold">KABUPATEN</label>
            <select id="kabupatenFilter" class="form-select">
                <option value="">SEMUA KABUPATEN</option>
                @foreach ($kabupaten as $k)
                    <option value="{{ $k }}">{{ $k }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="fw-bold">KECAMATAN</label>
            <select id="kecamatanFilter" class="form-select">
                <option value="">SEMUA KECAMATAN</option>
                @foreach ($kecamatan as $kec)
                    <option value="{{ $kec }}">{{ $kec }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <!-- SEARCH -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari Site ID atau Nama Site">
    </div>

    <!-- TABLE -->
    <div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Site ID</th>
                    <th>Site</th>
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Batch</th>
                    <th>Project Phase</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="siteTableBody">
                    @foreach ($sites as $i => $site)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $site->site_id }}</td>
                            <td>{{ $site->sitename }}</td>
                            <td>{{ $site->kab }}</td>
                            <td>{{ $site->provinsi }}</td>
                            <td>{{ $site->batch ?? '-' }}</td>
                            <td>{{ $site->card->title ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge bg-success">ACT</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>

</div>
@endsection

@section('scripts')
<script>
function filterTable() {
    let search = document.getElementById('searchInput').value.toLowerCase().trim();
    let phaseFilter = document.getElementById('projectPhaseFilter').value;
    let provFilter = document.getElementById('provinsiFilter').value;
    let kabFilter = document.getElementById('kabupatenFilter').value;
    let kecFilter = document.getElementById('kecamatanFilter').value;

    let rows = document.querySelectorAll('#siteTableBody tr');

    rows.forEach(row => {
        let tds = row.children; // semua <td> di baris ini
        let siteId = tds[1]?.textContent.toLowerCase().trim() || '';
        let siteName = tds[2]?.textContent.toLowerCase().trim() || '';
        let sitePhase = tds[6]?.textContent.trim() || ''; // sesuaikan index kolom Phase
        let siteProv = tds[3]?.textContent.trim() || '';  // Provinsi
        let siteKab = tds[4]?.textContent.trim() || '';   // Kabupaten
        let siteKec = tds[5]?.textContent.trim() || '';   // Kecamatan

        let matchesSearch = siteId.includes(search) || siteName.includes(search);
        let matchesPhase = phaseFilter === "" || sitePhase === phaseFilter;
        let matchesProv = provFilter === "" || siteProv === provFilter;
        let matchesKab = kabFilter === "" || siteKab === kabFilter;
        let matchesKec = kecFilter === "" || siteKec === kecFilter;

        row.style.display = (matchesSearch && matchesPhase && matchesProv && matchesKab && matchesKec) ? '' : 'none';
    });
}

// trigger filter saat mengetik di search
document.getElementById('searchInput').addEventListener('keyup', filterTable);

// trigger filter saat select berubah
['projectPhaseFilter','provinsiFilter','kabupatenFilter','kecamatanFilter'].forEach(id => {
    document.getElementById(id).addEventListener('change', filterTable);
});
</script>


@endsection
