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

        <a href="{{ url('timeline') }}"
           class="btn-custom {{ request()->is('timeline*') ? 'btn-active' : 'btn-inactive' }}">
            Actual Plane
        </a>

        <a href="{{ url('laporaninstalasi') }}"
           class="btn-custom {{ request()->is('laporaninstalasi*') ? 'btn-active' : 'btn-inactive' }}">
            Laporan Instalasi
        </a>

    </div>

    <!-- Ringkasan -->
    <div class="row mb-4 text-center">
        <div class="col-md-3">
            <div class="card" style="width:17rem;">
                <div class="card-body">
                    <h4>{{ $totalSiteAll }}</h4>
                    <small>Total Site</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card" style="width:17rem;">
                <div class="card-body">
                    <h4>{{ $sisaSiteAll }}</h4>
                    <small>Sisa Lokasi</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark" style="width:17rem;">
                <div class="card-body">
                    <h4>{{ $progressSiteAll }}</h4>
                    <small>Progress</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white" style="width:17rem;">
                <div class="card-body">
                    <h4>{{ $doneSiteAll }}</h4>
                    <small>Selesai</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="card mb-4">
        <div class="card-body">
            Progress
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                     style="width: {{ $progressAll }}%;">
                    {{ $progressAll }}%
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah Site Manual -->
    <div class="card mb-3 shadow-sm">
        <div class="card-header fw-semibold py-2">
            Tambah Timeline
        </div>

        <div class="card-body py-3">
            @if(session('success'))
                <div class="alert alert-success py-2 mb-2">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('timeline.store') }}" method="POST">
                @csrf

                <div class="row g-2 align-items-center">

                    <!-- Label + Select Site -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Nama Site</label>
                        <select name="project_site_id" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Site --</option>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}">
                                    {{ $site->site_id }} - {{ $site->site_name }} - {{ $site->project->mitra }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Label + Tanggal Mulai -->
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                    </div>

                    <!-- Label + Tanggal Selesai -->
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Estimasi Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                    </div>

                    <!-- Label + Status -->
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="pending">Pending</option>
                            <option value="progress">Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <!-- Button -->
                    <div class="col-md-3 d-flex align-items-end mt-5">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            Tambah
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Filter -->
    <div class="row mb-3">
        <div class="col-md-12">
            <form action="{{ route('timeline.index') }}" method="GET">
                <div class="input-group">
                    <select name="filter" class="form-select">
                        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua</option>
                        <option value="done" {{ $filter == 'done' ? 'selected' : '' }}>Selesai</option>
                        <option value="pending" {{ $filter == 'pending' ? 'selected' : '' }}>Belum Selesai</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Grouping by week -->
    @foreach($groupByWeek as $week => $items)
        <div class="card mb-3">
            <div class="card-header">
                Minggu: {{ $week }} (Total: {{ $items->count() }} site)
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Site ID</th>
                            <th>Nama Site</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->site->site_id }}</td>
                                <td>{{ $item->site->site_name }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <!-- Timeline -->
    <div class="card shadow-sm">
        <div class="card-header fw-semibold py-2">
            Timeline Proyek
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered mb-0 align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th class="py-3">No</th>
                        <th class="py-3">Site ID</th>
                        <th class="py-3">Nama Lokasi</th>
                        <th class="py-3">Mitra (Project)</th>
                        <th class="py-3">Tanggal Mulai</th>
                        <th class="py-3">Tanggal Estimasi Selesai</th>
                        <th class="py-3">Sisa Waktu</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($timeline as $item)
                    <tr>
                        <td class="py-2">{{ $loop->iteration }}</td>
                        <td class="py-2">{{ $item->site ? $item->site->site_id : 'Site kosong' }}</td>
                        <td class="py-2">{{ $item->site->site_name }}</td>
                        <td class="py-2">{{ $item->site->project->mitra }}</td>
                        <td class="py-2">{{ $item->tanggal_mulai->format('d-m-Y') }}</td>
                        <td class="py-2">{{ $item->tanggal_selesai->format('d-m-Y') }}</td>

                        <td class="py-2">
                            <span class="countdown"
                                  data-end="{{ $item->tanggal_selesai->format('Y-m-d') }} 23:59:59">
                                Loading...
                            </span>
                        </td>

                        <td class="py-2">
                            @if($item->status == 'done')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($item->status == 'progress')
                                <span class="badge bg-warning text-dark">Progress</span>
                            @else
                                <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

<script>
    function updateCountdown() {
        document.querySelectorAll('.countdown').forEach(function(el) {
            const end = new Date(el.getAttribute('data-end'));
            const now = new Date();

            let diff = end - now;

            if (diff <= 0) {
                el.innerHTML = "Selesai";
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            diff -= days * (1000 * 60 * 60 * 24);

            const hours = Math.floor(diff / (1000 * 60 * 60));
            diff -= hours * (1000 * 60 * 60);

            const minutes = Math.floor(diff / (1000 * 60));
            diff -= minutes * (1000 * 60);

            const seconds = Math.floor(diff / 1000);

            el.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        });
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>
@endsection
