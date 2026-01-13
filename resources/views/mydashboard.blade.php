<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUSTECH Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <style>
        body {
            background: #ffffff;
            font-family: 'Quicksand', sans-serif;
        }
        .card.h-100 {
            min-height: 400px; /* samakan tinggi semua card */
        }

        .pagination .page-link {
            border-radius: 50% !important;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 38px;
            font-weight: bold;
            color: #555;
            border: none;
            background: #f1f1f1;
            transition: all 0.3s;
        }

        .pagination .active .page-link {
            background-color: black !important; /* hijau kalem */
            border-color: black !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="p-3">

{{-- Header dengan ikon jam di kiri, judul di tengah, dan jam digital di kanan --}}
<style>
    .title-text {
        font-size: 40px;
        font-family: 'Quicksand', sans-serif;
        color: #212529;
        flex-grow: 1;
    }

    .clock-icon i {
        font-size: 45px;
        color: #212529;
        transition: transform 0.2s ease-in-out, text-shadow 0.3s;
    }

    .clock-tick {
        transform: rotate(20deg);
        text-shadow: 0 0 12px rgba(255, 145, 0, 0.7);
    }

    .digital-clock {
        font-size: 15px;
        font-weight: 300;
        font-family: 'Quicksand', sans-serif;
        color: #212529;
        min-width: 130px;
        text-align: left;
    }
</style>
<div class="d-flex justify-content-between align-items-center mb-4">

    <!-- IKON JAM (KIRI) 
    <div class="clock-icon">
        <i class="fa-solid fa-clock" id="icon-clock"></i>
    </div>-->

    <!-- JUDUL (TENGAH) -->
    <h1 class="fw-bold title-text text-center">
        MANAGE AND SERVICE AI BAKTI LIBERTA - NUSTECH
    </h1>

</div>

<div class="d-flex justify-content-center align-items-center gap-3 my-4 flex-wrap">
    
    <div class="card shadow-sm text-center flex-shrink-0" style="width: 180px; border-radius: 12px; background-color: transparent; border: 2px solid #000000; color: black;">
        <div class="card-body p-3" style="font-family: 'Quicksand', sans-serif;">
            <h6 class="mb-1" style="font-weight: 900;">TICKET TODAY</h6>
            <h4 class="fw-bold">{{ $tiketToday ?? 0 }}</h4>
        </div>
    </div>

    <div class="card shadow-sm text-center flex-shrink-0" style="width: 180px; border-radius: 12px; background-color: transparent; border: 2px solid #000000; color: black;">
        <div class="card-body p-3">
            <h6 class="mb-1" style="font-family: 'Quicksand', sans-serif; font-weight: 900;">ALL OPEN TICKET</h6>
            <h4 class="fw-bold">{{ $tiketOpen }}</h4>
        </div>
    </div>

    <div class="card text-center flex-shrink-0" style="width: 180px; border-radius: 12px; background-color: transparent; border: 2px solid #000000; color: black;">
        <div class="card-body p-3" style="font-family: 'Quicksand', sans-serif;">
            <h6 class="mb-1" style="font-weight: 900;">PM BMN DONE</h6>
            <h4 class="fw-bold">
                <span style="color: #81c784; font-weight: bold;">{{ ($kategoriDone['BMN'] ?? 0) }}</span>
                <span style="color: #FF6C0C; font-size: 14px;">/ 237</span>
            </h4>
        </div>
    </div>

    <div class="card text-center flex-shrink-0" style="width: 180px; border-radius: 12px; background-color: transparent; border: 2px solid #000000; color: black;">
        <div class="card-body p-3" style="font-family: 'Quicksand', sans-serif;">
            <h6 class="mb-1" style="font-weight: 900;">PM SL DONE</h6>
            <h4 class="fw-bold">
                <span style="color: #81c784; font-weight: bold;">{{ ($kategoriDone['SL'] ?? 0) }}</span>
                <span style="color: #FF6C0C; font-size: 14px;">/ 121</span>
            </h4>
        </div>
    </div>

    <div class="card text-center flex-shrink-0" style="width: 180px; border-radius: 12px; background-color: transparent; border: 2px solid #000000; color: black;">
        <div class="card-body p-3" style="font-family: 'Quicksand', sans-serif;">
            <h6 class="mb-1" style="font-weight: 900;">TOTAL PM DONE</h6>
            <h4 class="fw-bold">{{ $totalDone }}</h4>
        </div>
    </div>

    <div class="card shadow-sm text-center flex-shrink-0" style="width: 180px; border-radius: 12px; background-color: transparent; border: 2px solid #000000; color: black;">
        <div class="card-body p-3" style="font-family: 'Quicksand', sans-serif;">
            <h6 class="mb-1" style="font-weight: 900;">PM PENDING</h6>
            <h4 class="fw-bold">{{ $pmPending ?? 0 }}</h4>
        </div>
    </div>
</div>

<div class="row">
    <!-- PROBLEM OPEN TIKET -->
    <div class="col-md-3 d-flex flex-column gap-3">
        <!-- OPEN TIKET PROBLEM -->
        <div class="card p-2 text-center" style="background-color: #FFFFFF; font-family: 'Quicksand', sans-serif; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; flex: 1; min-height: 200px;">
            <h5 style="font-size: 15px; color: #000000;">OPEN TIKET PROBLEM</h5>
            <ul class="list-unstyled" style="max-height: 250px; overflow-y:auto; margin-top: 8px;">
                @foreach($tasks as $task)
                    <li class="mb-2 mt-2 text-start mx-3" style="font-size: 13px; color: #495057;">
                        <strong class="d-block" style="color: #495057;">{{ $task->kendala }}</strong>
                        <a href="#" class="toggle-sites" data-sites="{{ $task->sites }}" style="color: black;">
                            Lihat Site ({{ count(explode(',', $task->sites)) }})
                        </a>
                        <ul class="site-list mt-1 ms-3 d-none" style="font-size: 12px; color: #495057;">
                            @foreach(explode(',', $task->sites) as $site)
                                <li>{{ $site }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- SPAREPART NEED IN -->
        <div class="card p-2 text-center" style="background-color: #FFFFFF; font-family: 'Quicksand', sans-serif; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; flex: 1; min-height: 200px;">
            <h5 style="font-size: 15px; color: #000000;">SPAREPART NEED IN</h5>
            <ul class="list-unstyled" style="max-height: 250px; overflow-y:auto; margin-top: 8px;">
                <li class="mb-2 mt-2 text-start mx-3" style="font-size: 13px; color: #495057;">
                    <strong class="d-block" style="color: #495057;">Data sparepart akan ditampilkan di sini</strong>
                </li>
            </ul>
        </div>
    </div>

    <!-- DAFTAR SITE OPEN -->
    <div class="col-md-6 d-flex">
        <div class="card shadow-sm w-100 h-100" style="min-height: 220px; font-family: 'Quicksand', sans-serif;">
            <div class="card-header bg-light-green text-black text-center" style="padding: 8px 0;">
                <h5 class="mb-0" style="font-size: 15px;"> OPEN TICKET LIST </h5>
            </div>
            <div class="card-body d-flex flex-column" style="margin-top: -18px;">
                <div class="table-responsive flex-grow-1" style="overflow-y:auto; max-height: 400px;">
                    <table class="table table-bordered table-sm mb-0 w-100" style="table-layout: fixed; font-family: 'Quicksand', sans-serif;">
                        <thead class="table-dark">
                            <tr style="position: sticky; top: 0; z-index: 2; background: #212529;">
                                <th class="text-center" style="font-size: 13px; width: 28%;">Site Name</th>
                                <th class="text-center" style="font-size: 13px; width: 22%;">Site ID</th>
                                <th class="text-center" style="font-size: 13px; width: 20%;">Status</th>
                                <th class="text-center" style="font-size: 13px; width: 15%;">Durations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tiket as $item)
                                @if(strtolower($item->status_tiket) == 'open')
                                <tr>
                                    <td class="text-start text-truncate" style="font-size: 13px; max-width: 180px;" title="{{ $item->nama_site ?? '-' }}">
                                        {{ $item->nama_site ?? '-' }}
                                    </td>
                                    <td class="text-center text-truncate align-middle" style="font-size: 13px; max-width: 140px;" title="{{ $item->site_id }}">
                                        <a href="#"
                                           class="text-dark"
                                           style="text-decoration: none; word-break: break-all;"
                                           data-bs-toggle="modal"
                                           data-bs-target="#tiketDetailModal{{ $item->id }}">
                                            {{ \Illuminate\Support\Str::limit($item->site_id, 20, '...') }}
                                        </a>
                                        <!-- Style Modal Map Mini-->
                                        <style>
                                            .map-mini {
                                                position: absolute;
                                                bottom: 15px;
                                                right: 15px;
                                                width: 220px;
                                                height: 160px;
                                                border-radius: 10px;
                                                border: 2px solid #ddd;
                                                z-index: 1056;
                                            }
                                            .modal-body {
                                                position: relative;
                                            }
                                        </style>
                                        <!-- Modal -->
                                        <div class="modal fade" id="tiketDetailModal{{ $item->id }}" tabindex="-1" aria-labelledby="tiketDetailModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <style>
                                                        .truncate-single {
                                                            overflow: hidden;
                                                            text-overflow: ellipsis;
                                                            white-space: nowrap;
                                                        }
                                                        .info-table {
                                                            width: 100%;
                                                            table-layout: fixed; /* PENTING */
                                                        }

                                                        .info-table tr td {
                                                            padding: 4px 6px; /* rapat antar baris */
                                                            vertical-align: top;
                                                        }

                                                        .info-table .label {
                                                            width: 180px; /* KUNCI lebar label */
                                                            font-weight: 600;
                                                            white-space: nowrap;
                                                            position: relative;
                                                            padding-right: 12px;
                                                        }

                                                        .info-table .label::after {
                                                            content: ":";
                                                            position: absolute;
                                                            right: 4px;
                                                        }

                                                        .info-table .value {
                                                            padding-left: 6px;
                                                            word-break: break-word;
                                                            white-space: pre-line;
                                                        }
                                                        </style>

                                                        <h5 class="modal-title w-100 text-center truncate-single" id="tiketDetailModalLabel{{ $item->id }}" title="{{ $item->nama_site ?? '-' }}">
                                                                Detail Tiket - {{ $item->nama_site ?? '-' }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start" style="font-size: 14px; word-break: break-word;">
                                                        <table class="table table-borderless mb-0 info-table">
                                                            <tr>
                                                                <td class="label">Site ID</td>
                                                                <td>{{ $item->site_id ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Kategori</td>
                                                                <td>{{ $item->site->tipe ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Provinsi</td>
                                                                <td>{{ $item->provinsi ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Kabupaten</td>
                                                                <td>{{ $item->kabupaten ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Kecamatan</td>
                                                                <td>{{ $item->site->kecamatan ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Sumber Listrik</td>
                                                                <td>{{ $item->site->sumber_listrik ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">PIC/NO Tlp</td>
                                                                <td>{{ $item->site->nama_pic ?? '-' }} / {{ $item->site->nomor_pic ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Durasi</td>
                                                                <td>{{ $item->durasi ?? '-' }} hari</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Kendala</td>
                                                                <td>{{ $item->kendala ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Detail Problem</td>
                                                                <td style="word-break: break-word; white-space: pre-line;">{{ $item->detail_problem ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Action Plan</td>
                                                                <td style="word-break: break-word; white-space: pre-line;">{{ $item->plan_actions ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">CE</td>
                                                                <td>{{ $item->ce ?? '-' }}</td>
                                                            </tr>
                                                        </table>
                                                        {{-- MAP MINI POJOK KANAN BAWAH --}}
                                                        @if(!empty($item->site?->latitude) && !empty($item->site?->longitude))
                                                            <div 
                                                                id="map-{{ $item->id }}"
                                                                class="map-mini"
                                                                data-lat="{{ $item->site->latitude }}"
                                                                data-lng="{{ $item->site->longitude }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center" style="font-size: 13px;">
                                        @if(strtolower($item->kategori) == 'bmn')
                                            <span style="color: #000; font-size: 12px;">OPEN</span>
                                        @elseif(strtolower($item->kategori) == 'sl')
                                            <span style="color: #000; font-size: 12px;">OPEN</span>
                                        @else
                                            <span class="badge" style="background-color: black; color: #fff;">OPEN</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="font-size: 13px;">
                                        {{ isset($item->durasi) ? floor($item->durasi) : '-' }} hari
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-2 h-100 text-center"
            style="background-color: #FFFFFF; min-height: 220px; font-family: 'Quicksand', sans-serif;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">

            <div class="d-flex justify-content-between align-items-center mb-2 mt-1">

                <!-- LEFT: TITLE -->
                <h5 class="mb-0 text-start" style="font-size: 15px; color: #000000;">
                    PIKET SCHEDULE
                </h5>
            
                <!-- RIGHT: DIGITAL CLOCK -->
                <div id="digital-clock" class="digital-clock text-end"></div>
            
            </div>

            <!-- Info shift aktif -->
            <div class="rounded p-2 mt-2 mb-2" style="background-color:#d9f5f8; font-size:13px;">
                <div class="d-flex justify-content-between align-items-start">

                    <!-- LEFT: LABEL -->
                    <div class="d-flex flex-column">
                        <p class="mb-1 text-start"><strong>Shift On:</strong></p>
                        <p class="mb-1 text-start"><strong>Shift Now:</strong></p>
                    </div>

                    <!-- RIGHT: VALUE -->
                    <div class="d-flex flex-column align-items-end" style="min-width: 0; text-align:right;">

                        <!-- SHIFT AKTIF -->
                        @php
                            $jadwalShift = $jadwalHariIni->firstWhere('shift', $shiftAktif) ?? $jadwalHariIni->first() ?? null;
                            $tanggalText = $jadwalShift ? \Carbon\Carbon::parse($jadwalShift->tanggal)->format('d M') : \Carbon\Carbon::now()->format('d M');
                        @endphp

                        <p class="mb-1 text-truncate" style="max-width:180px; white-space: nowrap;">
                            {{ $tanggalText }} 
                            @if($shiftAktif == 'P') 08:00 - 16:00 WITA
                            @elseif($shiftAktif == 'S') 16:00 - 00:00 WITA
                            @elseif($shiftAktif == 'M') 00:00 - 08:00 WITA
                            @else 00:00 - 08:00 WITA
                            @endif
                        </p>
                        
                        <!-- NAMA PIKET (VERTIKAL, TIDAK TURUN KEBALIKAN, AUTO TRUNCATE) -->
                        <div class="d-flex flex-column align-items-end" style="min-width:0; gap:3px;">
                            @if($piketAktif->isNotEmpty())
                                @foreach($piketAktif->pluck('nama') as $nama)
                                    <span class="text-dark text-truncate"
                                        style="max-width:180px; white-space: nowrap;">
                                        {{ ucwords(strtolower($nama)) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-nowrap">Belum ada yang terjadwal</span>
                            @endif
                        </div>

                    </div>

                </div>
            </div>

            <!-- Daftar jadwal -->
            <div class="mt-2" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-sm table-bordered text-center align-middle mb-0"
                    style="font-size: 12px; border-color: #dee2e6;">
                    <thead style="background-color: #000000; color: #ffffff;">
                        <tr>
                            <th>Nama</th>
                            <!--<th>Tanggal</th>-->
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwalHariIni as $jadwal)
                            <tr @if($jadwal->shift == $shiftAktif) style="background-color:#d4edda;" @endif>
                                <td class="text-start text-truncate py-2 {{ $jadwal->status == 'aktif' ? 'fw-bold' : '' }}"
                                    style="max-width: 90px;"
                                    title="{{ $jadwal->nama }}">
                                    {{ ucwords(strtolower($jadwal->nama)) }}
                                </td>
                                <!--<td class="py-2 text-center">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M') }}</td>-->
                                <td class="text-start py-2" style="padding-left: 30px;">
                                    @if($jadwal->shift == 'P') Pagi
                                    @elseif($jadwal->shift == 'S') Sore
                                    @elseif($jadwal->shift == 'M') Malam
                                    @elseif($jadwal->shift == 'OFF') Off
                                    @else {{ $jadwal->shift }}
                                    @endif
                                </td>
                                <td class="py-2 text-center">
                                    @if($jadwal->status == 'off')
                                        <span class="badge bg-danger">Libur</span>
                                    @elseif($jadwal->status == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($jadwal->status == 'selesai')
                                        <span class="badge bg-secondary">Selesai</span>
                                    @else
                                        <span class="badge bg-secondary">Menunggu...</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-2">Tidak ada jadwal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
<footer class="footer-fixed">
    <small>© 2025 NUSTECH Team. All rights reserved.</small>
</footer>

<style>
    .footer-fixed {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        text-align: center;
        padding: 10px 0;
        background: transparent; /* tidak ada background */
        color: #000; /* semua teks hitam */
        font-size: 0.9rem;
        z-index: 9999;
    }

    .footer-fixed strong {
        color: #000; /* pastikan teks NUSTECH Team juga hitam */
        font-weight: 600;
    }
</style>
{{-- LIVE CHAT WIDGET --}}
<div id="chat-widget">
    <div id="chat-header">💬 Live Chat</div>

    <div id="chat-body"></div>

    <form id="chat-form">
    @csrf
        @guest
            <input type="text" id="sender_name" class="form-control mb-1" placeholder="Nama">
        @endguest

        <!-- REPLY PREVIEW -->
        <div id="reply-preview" class="mb-1" style="display:none; padding:5px 10px; background:#f1f1f1; border-left: 3px solid #007bff; border-radius:5px; font-size:12px;">
            <strong id="reply-name"></strong>: <span id="reply-message"></span>
            <button type="button" id="cancel-reply" style="float:right; background:none; border:none; cursor:pointer;">✖</button>
        </div>

        <div class="d-flex gap-1">
            <input type="text"
                id="chat-message"
                class="form-control"
                placeholder="{{ auth()->check() && auth()->user()->role === 'admin'
                        ? 'Balas sebagai ADMIN...'
                        : 'Ketik pesan...' }}"
                required>
            <button type="submit" class="btn {{ auth()->check() && auth()->user()->role === 'admin'
                ? 'btn-success'
                : 'btn-primary' }} btn-sm">➤</button>
        </div>
    </form>
</div>

<style>
#chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px; /* hanya ikon */
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    transition: width 0.3s, height 0.3s, border-radius 0.3s;
    background: #fff;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 15px rgba(0,0,0,.2);
    display: flex;
    flex-direction: column;
}

#chat-widget.open {
    width: 320px;
    height: 400px;
    border-radius: 10px;
}

#chat-body {
    display: none;
    flex: 1; /* supaya expand otomatis */
    overflow-y: auto;
    padding: 10px;
    background: #f8f9fa;
}

#chat-form {
    display: none;
    padding: 10px;
    background: #fff;
    border-top: 1px solid #ddd;
}

#chat-widget.open #chat-body,
#chat-widget.open #chat-form {
    display: block;
}

#chat-header {
    background-color: #007bff;
    color: white;
    padding: 10px;
    cursor: pointer;
    text-align: center;
    font-weight: bold;
}

/* Rapiin input dan tombol */
#chat-form .form-control {
    height: 36px;
}

#chat-form .btn {
    height: 36px;
}
</style>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
{{-- SCRIPT LIVE CHAT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const chatWidget = document.getElementById('chat-widget');
    const chatHeader = document.getElementById('chat-header');
    const chatBody   = document.getElementById('chat-body');
    const chatForm   = document.getElementById('chat-form');
    const chatInput  = document.getElementById('chat-message');
    const replyPreview = document.getElementById('reply-preview');
    const replyNameEl = document.getElementById('reply-name');
    const replyMessageEl = document.getElementById('reply-message');
    const cancelReplyBtn = document.getElementById('cancel-reply');

    let replyTo = null;
    let lastChatId = 0; // ID chat terakhir untuk notifikasi

    // Minta izin notif saat awal
    if ("Notification" in window && Notification.permission !== "granted") {
        Notification.requestPermission();
    }

    // Toggle chat widget
    chatHeader.addEventListener('click', () => chatWidget.classList.toggle('open'));

    // Enable reply klik
    function enableReply() {
        document.querySelectorAll('.chat-message').forEach(msg => {
            msg.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const message = this.getAttribute('data-message');

                replyTo = { name, message };

                replyNameEl.innerText = `@${name}`;
                replyMessageEl.innerText = message;
                replyPreview.style.display = 'block';
                chatInput.focus();
            });
        });
    }

    // Fungsi untuk munculkan notif browser
    function showNotification(title, message){
        if (!("Notification" in window)) return;
        if (Notification.permission === "granted") {
            new Notification(title, { body: message });
        }
    }

    // Load chat messages
    function loadChat() {
        fetch('/chat/fetch')
            .then(res => res.json())
            .then(data => {
                chatBody.innerHTML = '';

                data.forEach(chat => {
                    const align = chat.sender_type === 'admin' ? 'text-end' : 'text-start';
                    const color = chat.sender_type === 'admin' ? '#d1e7ff' : '#f1f1f1';

                    // Reply HTML
                    let replyHTML = '';
                    if(chat.reply_to_name && chat.reply_to_message){
                        replyHTML = `
                            <div style="
                                background:#e9ecef; 
                                padding:4px 6px; 
                                border-left:3px solid #007bff; 
                                border-radius:5px; 
                                font-size:11px; 
                                margin-bottom:3px;
                            ">
                                <strong>@${chat.reply_to_name}</strong>: ${chat.reply_to_message}
                            </div>
                        `;
                    }

                    chatBody.innerHTML += `
                        <div class="${align} mb-2 chat-message" 
                             data-id="${chat.id}" 
                             data-name="${chat.sender_name}" 
                             data-message="${chat.message.replace(/"/g, '&quot;')}" 
                             style="cursor:pointer;">
                            <span style="background:${color}; padding:6px 10px; border-radius:8px; display:inline-block; max-width:80%;">
                                ${replyHTML}
                                <strong>${chat.sender_name}</strong><br>
                                ${chat.message}
                            </span>
                        </div>
                    `;

                    // 🔔 Notifikasi untuk chat baru dari guest
                    if(chat.id > lastChatId && chat.sender_type === 'guest'){
                        showNotification(chat.sender_name, chat.message);
                        lastChatId = chat.id; // update ID terakhir
                    }
                });

                chatBody.scrollTop = chatBody.scrollHeight;
                enableReply();
            })
            .catch(err => console.error(err));
    }

    loadChat();
    setInterval(loadChat, 3000); // auto refresh chat

    // Batalkan reply
    cancelReplyBtn.addEventListener('click', () => {
        replyTo = null;
        replyPreview.style.display = 'none';
        chatInput.value = '';
    });

    // Kirim chat
    chatForm.addEventListener('submit', function(e){
        e.preventDefault();

        const messageText = chatInput.value.trim();
        if(!messageText) return;

        let payload = {
            sender_name: document.getElementById('sender_name')?.value || null,
            message: messageText
        };

        if(replyTo && replyTo.name && replyTo.message){
            payload.reply_to_name = replyTo.name;
            payload.reply_to_message = replyTo.message;
        }

        fetch('/chat/send', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            chatInput.value = '';
            replyTo = null;
            replyPreview.style.display = 'none';
            loadChat();
        })
        .catch(err => console.error(err));
    });

});
</script>

{{-- LEAFLET MAP DI MODAL DETAIL TIKET --}}
<script>
document.addEventListener('shown.bs.modal', function (e) {
    const mapDiv = e.target.querySelector('.map-mini');
    if (!mapDiv || mapDiv.dataset.loaded) return;

    const lat = mapDiv.dataset.lat;
    const lng = mapDiv.dataset.lng;

    const map = L.map(mapDiv.id, {
        zoomControl: false,
        scrollWheelZoom: false,
        dragging: false
    }).setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([lat, lng]).addTo(map);

    // 👉 KLIK MAP = BUKA TAB BARU
    map.on('click', function () {
        window.open(
            `https://www.google.com/maps?q=${lat},${lng}`,
            '_blank'
        );
    });

    mapDiv.dataset.loaded = true;
});
</script>

{{-- TOGGLE LIST SITE PADA PROBLEM OPEN TIKET --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-sites').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            let ul = this.parentElement.querySelector('.site-list');
            ul.classList.toggle('d-none');
        });
    });

    const chartLabels = @json($labels ?? []);
    const chartValues = @json($values ?? []);
    const statKabLabels = @json(isset($statKab) ? array_keys($statKab) : []);
    const statKabValues = @json(isset($statKab) ? array_values($statKab) : []);
    const visitorLabels = @json(isset($visitor) ? $visitor->keys() : []);
    const visitorValues = @json(isset($visitor) ? $visitor->values() : []);

    const ctx = document.getElementById('doneChart').getContext('2d');
    const doneChart = new Chart(ctx, {
        type: 'bar', // bisa diganti 'line' kalau mau garis
        data: {
            labels: @json($labels),   // dari controller -> contoh ["September 2025", "Oktober 2025"]
            datasets: [{
                label: 'Jumlah PM Done',
                data: @json($values), // contoh [12, 8, 15, ...]
                backgroundColor: '#81c784',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: {
                            size: 12,
                            family: "'Quicksand', sans-serif"
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Statistik kabupaten
    if (statKabLabels.length && statKabValues.length) {
        new Chart(document.getElementById('statKabChart'), {
            type: 'line',
            data: {
                labels: statKabLabels,
                datasets: [{
                    label: 'Open Tiket',
                    data: statKabValues,
                    borderColor: '#FF7043',
                    fill: false,
                    tension: 0.3
                }]
            }
        });
    }
});
</script>
<script>
    const visitorLabels = {!! json_encode($visitor->keys()) !!};   // contoh: ["BMN","SL"]
    const visitorValues = {!! json_encode($visitor->values()) !!}; // contoh: [7,2]

    if (visitorLabels.length && visitorValues.length) {
        new Chart(document.getElementById('visitorChart'), {
            type: 'doughnut',
            data: {
                labels: visitorLabels,
                datasets: [{
                    data: visitorValues,
                    backgroundColor: [
                        '#81c784', 'black', '#ffca28',
                        '#42a5f5', '#ef5350', '#ab47bc'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }
</script>
{{-- AUTO REFRESH PAGE --}}
<script>
    setInterval(() => {
        location.reload();
    }, 60 * 1000); // reload tiap 1 menit
</script>
{{-- JAM DIGITAL --}}
<script>
function updateClock() {
    const now = new Date();
    let h = String(now.getHours()).padStart(2, "0");
    let m = String(now.getMinutes()).padStart(2, "0");
    let s = String(now.getSeconds()).padStart(2, "0");

    document.getElementById("digital-clock").textContent = `${h}:${m}:${s}`;

    // animasi ikon jam per detik
    const icon = document.getElementById("icon-clock");
    
    icon.classList.add("clock-tick");

    // hilangkan setelah 200ms agar bisa animasi lagi tiap detik
    setTimeout(() => {
        icon.classList.remove("clock-tick");
    }, 200);
}

setInterval(updateClock, 1000);
updateClock();
</script>
</body>
</html>
