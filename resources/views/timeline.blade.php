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
            <div class="card">
                <div class="card-body">
                    <h4>{{ $totalSite }}</h4>
                    <small>Total Site</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h4>{{ $doneSite }}</h4>
                    <small>Selesai</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h4>{{ $progressSite }}</h4>
                    <small>Progress</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $sisaSite }}</h4>
                    <small>Sisa Lokasi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="progress" style="height: 28px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                     style="width: {{ $progress }}%;">
                    {{ $progress }}%
                </div>
            </div>
        </div>
    </div>
    <!-- Form Tambah Site Manual -->
    <div class="card mb-4">
        <div class="card-header fw-bold">Tambah Site Manual</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('timeline.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="nama_lokasi" class="form-control" placeholder="Nama Lokasi" required>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="progress">Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Timeline -->
    <div class="card">
        <div class="card-header fw-bold">Timeline Proyek</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0 text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Lokasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($timeline as $item)
                    <tr>
                        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                        <td>{{ $item->nama_lokasi }}</td>
                        <td>
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
@endsection
