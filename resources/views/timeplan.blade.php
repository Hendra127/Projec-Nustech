@extends('layouts.user_type.auth')

@section('content')
@php
    use Illuminate\Support\Str;
    $lastKabupaten = null;
@endphp

<style>
    table.timeplan-table th,
    table.timeplan-table td {
        vertical-align: middle;
        text-align: center;
        font-size: 12px;
        padding: 6px;
        white-space: nowrap;
    }

    table.timeplan-table th.sticky {
        position: sticky;
        top: 0;
        background: #f8fafc;
        z-index: 2;
    }

    .kabupaten-row {
        background: #f1f5f9;
        font-weight: bold;
        cursor: pointer;
    }

    .kabupaten-row:hover {
        background: #e2e8f0;
    }

    .site-row {
        display: none;
    }

    .flex-input {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .teknisi-input {
        width: 120px;
        font-size: 12px;
    }

    .note-textarea {
        width: 150px;
        font-size: 11px;
        resize: none;
    }

    .btn-mini {
        font-size: 12px;
        padding: 4px 8px;
        height: 32px;
    }

    .check-ok {
        color: green;
        font-weight: bold;
    }

    .check-late {
        color: red;
        font-weight: bold;
    }
    .progress-mini {
        height: 8px;
        width: 100%;
        background: #e5e7eb;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-mini span {
        height: 100%;
        display: block;
        background: #3b82f6;
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

{{-- ===================== TABLE TIMELINE ===================== --}}
<div class="card shadow mb-4">
    <div class="card-body table-responsive">
        <form method="GET" action="{{ route('timeplan.index') }}">
            <select name="mitra" id="mitraSelect" class="form-control" onchange="this.form.submit()">
                <option value="">-- Pilih Mitra --</option>
                @foreach($mitras as $mitra)
                    <option value="{{ $mitra->id }}" 
                        {{ (isset($selectedMitra) && $selectedMitra == $mitra->id) ? 'selected' : '' }}>
                        {{ $mitra->mitra }}
                    </option>
                @endforeach
            </select>
        </form>
        <table class="table table-bordered table-hover timeplan-table">
            <thead>
                <tr>
                    <th class="sticky">Kabupaten</th>
                    <th class="sticky">Site</th>
                    <th class="sticky">Teknisi</th>
                    <th class="sticky">Note</th>
                    @for ($d = 1; $d <= $daysInMonth; $d++)
                        <th class="sticky">{{ $d }}</th>
                    @endfor
                </tr>
            </thead>

            <tbody>
            @foreach ($data as $row)
                @php
                    $slug = Str::slug($row->kabupaten);
                @endphp

                {{-- ================= ROW KABUPATEN (CLICKABLE) ================= --}}
                @if ($lastKabupaten !== $row->kabupaten)
                <tr class="kabupaten-row" data-kab="{{ $slug }}">
                    <td colspan="{{ 4 + $daysInMonth }}" class="text-start">
                        ▶ {{ strtoupper($row->kabupaten) }}
                    </td>
                </tr>
                @php $lastKabupaten = $row->kabupaten; @endphp
                @endif

                {{-- ================= ROW SITE (HIDDEN) ================= --}}
                <tr class="site-row kab-{{ $slug }}">
                    <td></td>
                    <td>{{ $row->site_name }}</td>

                    {{-- TEKNISI --}}
                    <td>
                        <form method="POST" action="{{ route('timeline.updateTeknisi') }}">
                            @csrf
                            <input type="hidden" name="project_site_id" value="{{ $row->site_id }}">
                            <div class="flex-input">
                                <input type="text"
                                       name="teknisi"
                                       class="form-control teknisi-input"
                                       value="{{ $row->teknisi }}"
                                       placeholder="Teknisi">
                                <button type="submit" onclick="event.stopPropagation()" class="btn btn-success btn-mini">✔</button>
                            </div>
                        </form>
                    </td>

                    {{-- NOTE --}}
                    <td class="text-start">
                        @if ($row->note_final)
                            <div class="text-danger fw-bold mb-1">
                                {{ $row->note_final }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('timeplan.note') }}">
                            @csrf
                            <input type="hidden" name="site_id" value="{{ $row->site_id }}">
                            <div class="flex-input">
                                <textarea name="note_manual"
                                          rows="2"
                                          class="form-control note-textarea"
                                          placeholder="Alasan...">{{ $row->note_manual }}</textarea>
                                <button type="submit" onclick="event.stopPropagation()" class="btn btn-primary btn-mini">💾</button>
                            </div>
                        </form>
                    </td>

                    {{-- ================= TIMELINE ================= --}}
                    @for ($d = 1; $d <= $daysInMonth; $d++)
                        <td>
                            @php
                                $cell = $row->days[$d] ?? null;
                            @endphp

                            {{-- BAR PROGRESS --}}
                            @if ($cell === 'progress')
                                <div class="progress-mini">
                                    <span style="width: 100%"></span>
                                </div>

                            {{-- DONE (✔ HANYA DI TANGGAL SELESAI) --}}
                            @elseif ($cell === 'done')
                                <span class="check-ok">✔</span>
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ===================== SUMMARY ===================== --}}
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-center shadow">
            <div class="card-body">
                <h6 class="text-muted">SITE ONTIME</h6>
                <h2 class="text-success">{{ $summary['ontime'] }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-center shadow">
            <div class="card-body">
                <h6 class="text-muted">SITE DILUAR TIME PLAN</h6>
                <h2 class="text-danger">{{ $summary['late'] }}</h2>
            </div>
        </div>
    </div>
</div>

{{-- ===================== DETAIL PER KABUPATEN ===================== --}}
<div class="card shadow mb-3">
    <div class="card-body">
        <label class="fw-bold mb-2">Pilih Kabupaten</label>
        <select id="kabupatenSelect" class="form-control">
            <option value="">-- Pilih Kabupaten --</option>
            @foreach ($groupedByKabupaten as $kabupaten => $items)
                <option value="{{ Str::slug($kabupaten) }}">{{ $kabupaten }}</option>
            @endforeach
        </select>
    </div>
</div>

{{-- ===================== DETAIL PER KABUPATEN ===================== --}}
@foreach ($groupedByKabupaten as $kabupaten => $sites)
<div class="card shadow mb-4 kabupaten-table d-none"
     id="kab-{{ Str::slug($kabupaten) }}">
    <div class="card-header bg-dark text-white">
        Kabupaten : {{ $kabupaten }}
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>Site</th>
                    <th>Teknisi</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Total Hari</th>
                    <th>Status</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sites as $s)
                <tr>
                    <td>{{ $s['site'] }}</td>
                    <td>{{ $s['teknisi'] ?? '-' }}</td>
                    <td class="text-center">{{ $s['start'] }}</td>
                    <td class="text-center">{{ $s['end'] }}</td>
                    <td class="text-center">{{ $s['total_days'] }}</td>
                    <td class="text-center">
                        @if ($s['status'] === 'ONTIME')
                            <span class="badge bg-success">ONTIME</span>
                        @else
                            <span class="badge bg-danger">TERLAMBAT</span>
                        @endif
                    </td>
                    <td class="text-danger" style="font-size:12px">
                        {{ $s['note'] ?? '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach

</div>
{{-- ===================== KURVA S ===================== --}}
<div class="container-fluid py-4">
    <h4 class="mb-4">📈 Kurva S Project</h4>
    <div class="card shadow-sm p-3">
        <canvas id="sCurveChart" height="150"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('sCurveChart').getContext('2d');
const sCurveChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},       // array tanggal dari controller
        datasets: [
            {
                label: 'Time Plan',
                data: {!! json_encode($planned) !!},
                borderColor: '#10b981',
                borderDash: [5,5],
                fill: false,
                tension: 0.4
            },
            {
                label: 'Actual Plan',
                data: {!! json_encode($actual) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.2)',
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: {
            y: { beginAtZero: true, max: 100, title: { display: true, text: 'Progress (%)' } },
            x: { title: { display: true, text: 'Tanggal' } }
        }
    }
});
</script>
{{-- ===================== JS TOGGLE ===================== --}}
<script>
/* klik dari dropdown */
document.getElementById('kabupatenSelect').addEventListener('change', function () {
    document.querySelectorAll('.kabupaten-table')
        .forEach(el => el.classList.add('d-none'));

    if (this.value) {
        document.getElementById('kab-' + this.value)
            ?.classList.remove('d-none');
    }
});

/* klik dari tabel timeline */
document.querySelectorAll('.kabupaten-click').forEach(el => {
    el.addEventListener('click', function () {
        const target = this.dataset.target;

        document.querySelectorAll('.kabupaten-table')
            .forEach(el => {
                if (el.id !== target) el.classList.add('d-none');
            });

        document.getElementById(target)
            ?.classList.toggle('d-none');
    });
});
</script>
{{-- ===================== JS TOGGLE ===================== --}}
<script>
document.querySelectorAll('.kabupaten-row').forEach(row => {
    row.addEventListener('click', function () {
        const kab = this.dataset.kab;
        document.querySelectorAll('.kab-' + kab).forEach(site => {
            site.style.display =
                site.style.display === 'table-row' ? 'none' : 'table-row';
        });
    });
});
</script>
@endsection
