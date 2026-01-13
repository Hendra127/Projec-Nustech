@extends('layouts.user_type.auth')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
        @php
            use Carbon\Carbon;
            $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');
        @endphp
{{-- STYLE UNTUK SELECT NAMA --}}
<style>
.namaSelect {
    width: 160px;
    font-weight: bold;
    text-align: left !important; /* Rata kiri */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
{{-- STYLE UNTUK WARNA TOMBOL SAVE DAN DOWNLOAD --}}
<style>
/* Tombol SAVE dan Download agar warnanya sama */
.btn-custom {
    background-color: #4CAF50 !important; /* hijau lembut (bisa ganti sesuai tema) */
    border: none !important;
    color: #fff !important;
    border-radius: 10px;
    padding: 8px 20px;
    transition: 0.3s;
}

.btn-custom:hover,
.btn-custom:focus {
    background-color: #45a049 !important; /* warna hover sedikit lebih gelap */
    color: #fff !important;
}

</style>
<style>
    /* Hilangkan tanda panah select */
    #bulanSelect, #tahunSelect {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: none;
        text-align: center;
    }

    select.form-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: none !important;
        text-align: center;
    }

    /* --- Sticky Header --- */
    table.table thead th {
        position: sticky;
        top: 0;
        z-index: 20;
        background-color: #212529 !important; /* warna header hitam Bootstrap */
        color: #fff !important;
    }

    /* --- Sticky Kolom Nama --- */
    table.table th:first-child,
    table.table td:first-child {
        position: sticky;
        left: 0;
        z-index: 15;
        background-color: #f8f9fa !important; /* abu-abu terang biar kontras */
        color: #000 !important;
        font-weight: bold;
        box-shadow: 2px 0 3px rgba(0,0,0,0.1);
    }

    /* --- Biar responsif tetap lancar --- */
    .table-responsive {
        overflow-x: auto;
        overflow-y: auto;
        max-height: 80vh;
        white-space: nowrap;
    }

    table.table {
        border-collapse: collapse !important;
        font-size: 13px !important;
        line-height: 1.2 !important;
    }

    table.table th, table.table td {
        padding: 4px 6px !important;
        text-align: center;
        vertical-align: middle !important;
    }
    /* Pastel backgrounds for each shift (for dropdown list and selected state) */
    /* Option backgrounds (visible in the dropdown) */
    select.shift option[value="P"] { background-color: #E7DEAF; color: #000; } /* pastel pink */
    select.shift option[value="S"] { background-color: #73AF6F; color: #000; } /* pastel blue */
    select.shift option[value="M"] { background-color: #007E6E; color: #000; } /* pastel green */
    select.shift option[value="OFF"] { background-color: #ff4d4d; color: #fff; } 

    /* When an option is chosen, try to style the select itself (modern browsers) */
    select.shift:has(option[value="P"]:checked) { background-color: #E7DEAF; color: #000; }
    select.shift:has(option[value="S"]:checked) { background-color: #73AF6F; color: #000; }
    select.shift:has(option[value="M"]:checked) { background-color: #007E6E; color: #000; }
    select.shift:has(option[value="OFF"]:checked) { background-color: #ff4d4d; color: #fff; }

    /* Smooth transition and keep centered text */
    select.shift {
        transition: background-color 150ms ease, color 150ms ease;
        text-align-last: center; /* center selected text in many browsers */
        -moz-text-align-last: center;
    }

    /* Fallback for browsers without :has(): style select based on inline option styles already present */
    select.shift option[selected] { font-weight: 600; }
</style>
{{-- STYLE UNTUK DOWNLOAD BUTTON --}}
<style>
    .custom-btn {
    background-color: transparent !important; /* tidak ada background */
    border: 1px solid #FFDAB9; /* warna hitam outline */
    color: #000; /* warna ikon/teks */
    border-radius: 10px; /* sudut membulat seperti gambar */
    padding: 8px 16px;
    }

    .custom-btn:hover {
    background-color: #000; /* sedikit efek hover */
    color: #000;
    }
</style>
<div class="container-fluid mt-4" id="jadwalContainer">
    <h4 class="mb-3 text-center fw-bold">
         JADWAL SHIFT BULAN {{ strtoupper($namaBulan) }} {{ $tahun }}
    </h4>
    
    {{-- Container for filters and download --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{-- Pilihan Bulan & Tahun (aligned left) --}}
        <div class="d-flex align-items-center">
            <label for="bulanSelect" class="me-2 fw-bold">Pilih Bulan:</label>
            <select id="bulanSelect" class="form-select w-auto d-inline me-3">
                <option value="1" {{ $bulan == 1 ? 'selected' : '' }}>Januari</option>
                <option value="2" {{ $bulan == 2 ? 'selected' : '' }}>Februari</option>
                <option value="3" {{ $bulan == 3 ? 'selected' : '' }}>Maret</option>
                <option value="4" {{ $bulan == 4 ? 'selected' : '' }}>April</option>
                <option value="5" {{ $bulan == 5 ? 'selected' : '' }}>Mei</option>
                <option value="6" {{ $bulan == 6 ? 'selected' : '' }}>Juni</option>
                <option value="7" {{ $bulan == 7 ? 'selected' : '' }}>Juli</option>
                <option value="8" {{ $bulan == 8 ? 'selected' : '' }}>Agustus</option>
                <option value="9" {{ $bulan == 9 ? 'selected' : '' }}>September</option>
                <option value="10" {{ $bulan == 10 ? 'selected' : '' }}>Oktober</option>
                <option value="11" {{ $bulan == 11 ? 'selected' : '' }}>November</option>
                <option value="12" {{ $bulan == 12 ? 'selected' : '' }}>Desember</option>
            </select>
            <label for="tahunSelect" class="me-2 fw-bold">Tahun:</label>
            <select id="tahunSelect" class="form-select" style="width: 100px;">
                @for($t = date('Y')-1; $t <= date('Y')+1; $t++)
                    <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
                @endfor
            </select>
        </div>

        {{-- Download dropdown (aligned right) --}}
        <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
            <button type="button" class="btn btn-custom" id="saveBtn">
                SAVE
            </button>
        
            <div class="dropdown">
                <button class="btn btn-custom dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    Download
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#" id="downloadExcel">
                            <i class="fa fa-file-excel"></i> Download Excel
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" id="downloadImage">
                            <i class="fa fa-file-image"></i> Download Gambar
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

    <form id="jadwalForm">
        <div class="table-responsive">
            @php
                $currentMonth = \Carbon\Carbon::createFromDate($tahun, $bulan, 1);
                $daysInMonth = $currentMonth->daysInMonth;
            @endphp

            <table class="table table-bordered table-sm text-center align-middle w-100" 
                style="font-size: 13px; min-width: 1500px; border-color: #dee2e6;">
                <thead>
                    <tr>
                        <th class="sticky-col bg-dark text-white" style="position: sticky; left: 0; z-index: 30;">Nama</th>
                            @for ($d = 1; $d <= $tanggalAkhir->day; $d++)
                                @php
                                    $tgl = $tanggalAwal->copy()->day($d);
                                    $isSunday = $tgl->isSunday();
                                    $isHoliday = in_array($tgl->format('Y-m-d'), $tanggalMerah ?? []);
                                @endphp
                                <th style="
                                    min-width: 70px;
                                    text-align: center;
                                    font-weight: {{ ($isSunday || $isHoliday) ? 'bold' : 'normal' }};
                                    color: {{ ($isSunday || $isHoliday) ? '#000000' : '#212529' }};
                                    background-color: {{ ($isSunday || $isHoliday) ? : '#ff0000' }};
                                ">
                                    {{ $d }}
                                </th>
                            @endfor
                        </tr>
                </thead>
                <tbody>
                    @foreach($namaList as $nama)
                        <tr>
                            <td class="text-start fw-bold" style="min-width:180px;">
                                @php
                                    // Logika singkatan nama otomatis
                                    $maxLength = 18; // batas maksimal karakter sebelum disingkat
                                    if (strlen($nama) > $maxLength) {
                                        $parts = explode(' ', $nama);
                                        if (count($parts) > 1) {
                                            $base = implode(' ', array_slice($parts, 0, -1));
                                            $lastInitial = strtoupper(substr(end($parts), 0, 1));
                                            $namaTampil = $base . ' ' . $lastInitial;
                                        } else {
                                            $namaTampil = $nama;
                                        }
                                    } else {
                                        $namaTampil = $nama;
                                    }
                                @endphp
                            
                                <select class="form-select form-select-sm namaSelect" title="{{ $nama }}">
                                    @foreach($namaList as $pilihan)
                                        @php
                                            $parts = explode(' ', $pilihan);
                                            $namaPendek = strlen($pilihan) > $maxLength 
                                                ? implode(' ', array_slice($parts, 0, -1)) . ' ' . strtoupper(substr(end($parts), 0, 1))
                                                : $pilihan;
                                        @endphp
                                        <option value="{{ $pilihan }}" {{ $pilihan == $nama ? 'selected' : '' }}>
                                            {{ $namaPendek }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            @for ($d = 1; $d <= $daysInMonth; $d++)
                                @php
                                    $tanggal = $currentMonth->copy()->day($d)->format('Y-m-d');
                                    $jadwalItem = $jadwal->firstWhere(fn($item) => $item->nama == $nama && $item->tanggal == $tanggal);
                                    $shift = $jadwalItem->shift ?? '';
                                @endphp
                                <td @if($shift == 'OFF') style="color:#000;" @endif>
                                    <select class="form-select form-select-sm shift">
                                        <option value=""></option>
                                        <option value="P" {{ $shift == 'P' ? 'selected' : '' }} style="background-color: #FFD1DC; color: #000;">P</option>
                                        <option value="S" {{ $shift == 'S' ? 'selected' : '' }} style="background-color: #B3E5FC; color: #000;">S</option>
                                        <option value="M" {{ $shift == 'M' ? 'selected' : '' }} style="background-color: #C8E6C9; color: #000;">M</option>
                                        <option value="OFF" {{ $shift == 'OFF' ? 'selected' : '' }} style="background-color: #FFF9C4; color: #000;">OFF</option>
                                    </select>
                                    <input type="hidden" class="nama" value="{{ $nama }}">
                                    <input type="hidden" class="nama_asli" value="{{ $nama }}"> 
                                    <input type="hidden" class="tanggal" value="{{ $tanggal }}">
                                    <input type="hidden" class="id" value="{{ $jadwalItem->id ?? '' }}">
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <input type="hidden" id="bulanAktif" value="{{ $bulan }}">
        <input type="hidden" id="tahunAktif" value="{{ $tahun }}">
    </form>

    <div id="alertBox" class="alert alert-success mt-3 d-none text-center">✅ Data berhasil disimpan!</div>
</div>

{{-- Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- ✅ Alert Data Berhasil Disimpan --}}

{{-- ✅ Script Download --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bulanSelect = document.getElementById('bulanSelect');
    const tahunSelect = document.getElementById('tahunSelect');

    // === Download Excel ===
    document.getElementById('downloadExcel').addEventListener('click', function (e) {
        e.preventDefault();
        const bulan = bulanSelect.value;
        const tahun = tahunSelect.value;
        window.location.href = `/jadwal/export-excel?bulan=${bulan}&tahun=${tahun}`;
    });

    // === Download Jadwal (dengan judul di atas tabel) ===
    document.getElementById('downloadImage').addEventListener('click', async function (e) {
        e.preventDefault();

        const tableContainer = document.querySelector('.table-responsive');
        const bulan = bulanSelect.value;
        const tahun = tahunSelect.value;

        // Nama bulan dalam format teks (pakai array manual biar sesuai bahasa)
        const namaBulan = [
            '', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI',
            'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'
        ][parseInt(bulan)];

        // === Buat wrapper baru ===
        const wrapper = document.createElement('div');
        wrapper.style.cssText = `
            background: #ffffff;
            padding: 20px;
            text-align: center;
            font-family: 'Arial', sans-serif;
            color: #000;
            width: fit-content;
            margin: 0 auto;
        `;

        // Tambahkan judul ke atas tabel
        const title = document.createElement('h4');
        title.textContent = `JADWAL SHIFT BULAN ${namaBulan} ${tahun}`;
        title.style.cssText = `
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
        `;
        wrapper.appendChild(title);

        // Clone tabel agar tidak merusak tampilan aslinya
        const clone = tableContainer.cloneNode(true);
        clone.style.cssText = `
            width: fit-content;
            background: #ffffff;
            margin: 0 auto;
        `;
        wrapper.appendChild(clone);

        // Masukkan wrapper ke body sementara
        document.body.appendChild(wrapper);

        // Pastikan warna cell terambil dengan benar
        wrapper.querySelectorAll('th, td').forEach(el => {
            const cs = window.getComputedStyle(el);
            el.style.background = cs.backgroundColor;
            el.style.color = cs.color;
        });

        // Tunggu layout selesai
        await new Promise(r => setTimeout(r, 300));

        // Tangkap gambar
        html2canvas(wrapper, {
            scale: 2,
            backgroundColor: '#ffffff',
            useCORS: true
        }).then(canvas => {
            const link = document.createElement('a');
            link.download = `Jadwal_Shift_${namaBulan}_${tahun}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();

            // Hapus wrapper setelah download
            document.body.removeChild(wrapper);
        }).catch(err => {
            console.error('Error capturing image:', err);
            if (document.body.contains(wrapper)) document.body.removeChild(wrapper);
            alert('Gagal membuat gambar. Coba lagi.');
        });
    });
});
</script>

{{-- ✅ Script Simpan Data --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const saveBtn = document.getElementById('saveBtn');
    const alertBox = document.getElementById('alertBox');

    saveBtn.addEventListener('click', async function () {
        const bulanAktif = document.getElementById('bulanAktif').value;
        const tahunAktif = document.getElementById('tahunAktif').value;
        let data = [];

        document.querySelectorAll('tbody tr').forEach(row => {
            // Loop tiap kolom tanggal dalam baris ini
            row.querySelectorAll('td').forEach(cell => {
                const id = cell.querySelector('.id')?.value || null;
                const nama = cell.querySelector('.nama')?.value || null;
                const namaAsli = cell.querySelector('.nama_asli')?.value || null;
                const tanggal = cell.querySelector('.tanggal')?.value || null;
                const shift = cell.querySelector('.shift')?.value || null;

                if (nama && tanggal) {
                    data.push({
                        id,
                        nama,
                        nama_asli: namaAsli,
                        tanggal,
                        shift,
                        bulan: bulanAktif,
                        tahun: tahunAktif
                    });
                }
            });
        });

        try {
            const res = await fetch("{{ route('jadwal.piket.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ data })
            });

            const json = await res.json();
            if (json.success) {
                alertBox.classList.remove('d-none');
                alertBox.innerText = '✅ Data berhasil disimpan!';
                setTimeout(() => alertBox.classList.add('d-none'), 2000);
            } else {
                alert('❌ Gagal menyimpan data!');
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi.');
        }
    });

    // Ganti bulan/tahun
    document.getElementById('bulanSelect').addEventListener('change', ubahBulanTahun);
    document.getElementById('tahunSelect').addEventListener('change', ubahBulanTahun);

    async function ubahBulanTahun() {
        const bulan = document.getElementById('bulanSelect').value;
        const tahun = document.getElementById('tahunSelect').value;

        try {
            const res = await fetch(`/jadwal/generate/${tahun}/${bulan}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            const json = await res.json();
            if (json.success || (json.message && json.message.includes('sudah ada'))) {
                window.location.href = `/jadwalpiket?bulan=${bulan}&tahun=${tahun}`;
            } else {
                alert('Gagal generate jadwal: ' + (json.message || 'Tidak diketahui'));
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi saat ganti bulan.');
        }
    }
});
</script>
{{-- ✅ Script Update Nama Saat Dropdown Diubah --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Saat dropdown nama diganti
    document.querySelectorAll('.namaSelect').forEach(select => {
        select.addEventListener('change', function () {
            const row = this.closest('tr');
            const newName = this.value;

            // Update semua input hidden di baris itu (nama & nama_asli)
            row.querySelectorAll('input.nama, input.nama_asli').forEach(input => {
                input.value = newName;
            });

            // Opsional: highlight row biar kelihatan berubah
            row.style.backgroundColor = '#fff3cd';
            setTimeout(() => { row.style.backgroundColor = ''; }, 1000);
        });
    });
});
</script>
@endsection
