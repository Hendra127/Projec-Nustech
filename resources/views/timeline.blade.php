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

        <a href="{{ url('laporaninstalasi') }}"
           class="btn-custom {{ request()->is('laporaninstalasi*') ? 'btn-active' : 'btn-inactive' }}">
            Laporan Instalasi
        </a>

        <a href="{{ url('timeline') }}"
           class="btn-custom {{ request()->is('timeline*') ? 'btn-active' : 'btn-inactive' }}">
            Timeline
        </a>
    </div>

    <!-- Ringkasan -->
    <div class="row mb-4 text-center">
        <div class="col-md-3">
            <div class="card" style="width:17rem;">
                <div class="card-body">
                    <h4>{{ $totalSite }}</h4>
                    <small>Total Site</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card" style="width:17rem;">
                <div class="card-body">
                    <h4>{{ $sisaSite }}</h4>
                    <small>Sisa Lokasi</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark" style="width:17rem;">
                <div class="card-body">
                    <h4>{{ $progressSite }}</h4>
                    <small>Progress</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white" style="width:17rem;">
                <div class="card-body">
                    <h4>{{ $doneSite }}</h4>
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
                     style="width: {{ $progress }}%;">
                    {{ $progress }}%
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah Site Manual -->
    <div class="card mb-3 shadow-sm">
        <div class="card-header fw-semibold py-2">
            Tambah Site Manual
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
                    <div class="col-md-3">
                        <select name="project_site_id" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Site --</option>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}">
                                    {{ $site->site_name }} - {{ $site->project_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                    </div>

                    <div class="col-md-2">
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="pending">Pending</option>
                            <option value="progress">Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-stretch">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Timeline -->
    <div class="card shadow-sm">
        <div class="card-header fw-semibold py-2">
            Timeline Proyek
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered mb-0 align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th class="py-3">Site ID</th>
                        <th class="py-3">Project ID</th>
                        <th class="py-3">Tanggal Mulai</th>
                        <th class="py-3">Tanggal Selesai</th>
                        <th class="py-3">Countdown</th>
                        <th class="py-3">Nama Lokasi</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($timeline as $item)
                    <tr>
                        <td class="py-2">{{ $item->site_id->project_id }}</td>
                        <td class="py-2">{{ $item->site->project_id }}</td>
                        <td class="py-2">{{ $item->tanggal_mulai->format('d-m-Y') }}</td>
                        <td class="py-2">{{ $item->tanggal_selesai->format('d-m-Y') }}</td>

                        <td class="py-2">
                            <span class="countdown"
                                  data-end="{{ $item->tanggal_selesai->format('Y-m-d H:i:s') }}">
                                Loading...
                            </span>
                        </td>

                        <td class="py-2">{{ $item->site->site_name }}</td>
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

    // update setiap 1 detik
    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>
@endsection
