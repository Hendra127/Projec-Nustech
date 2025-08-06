@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
  }
</style>
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0">Data SLA</h4>
        </div>

        <div class="card-body">
            @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Import Button triggers Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
          Import
            </button>

            <!-- Import Modal -->
            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
              <div class="modal-dialog">
          <div class="modal-content">
            <form action="{{ route('sla.import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data SLA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
            <label for="importFile" class="form-label">Pilih File</label>
            <input type="file" name="file" id="importFile" class="form-control" required>
                </div>
                <div class="mb-3">
            <label for="importSheet" class="form-label">Pilih Sheet Tujuan</label>
            <select name="sheet" id="importSheet" class="form-select" required>
              <option value="" disabled selected>Pilih Sheet Tujuan</option>
              <option value="sheet1">Sheet 1 (SLA BMN Juni)</option>
              <option value="sheet2">Sheet 2 (SLA SL Juni)</option>
            </select>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Fungsi untuk menambah option sheet baru ke select importSheet
                function addSheetOption(idx) {
                    const select = document.getElementById('importSheet');
                    if (!select) return;
                    // Cek apakah sudah ada option dengan value sheet{idx}
                    if (select.querySelector(`option[value="sheet${idx}"]`)) return;
                    const option = document.createElement('option');
                    option.value = `sheet${idx}`;
                    option.textContent = `Sheet ${idx}`;
                    select.appendChild(option);
                }

                // Patch tombol tambah sheet agar juga menambah option di select
                const addSheetBtn = document.getElementById('addSheetBtn');
                if (addSheetBtn) {
                    addSheetBtn.addEventListener('click', function () {
                        // Cari index sheet terakhir
                        const select = document.getElementById('importSheet');
                        let maxIdx = 3;
                        select.querySelectorAll('option[value^="sheet"]').forEach(opt => {
                            const m = opt.value.match(/^sheet(\d+)$/);
                            if (m) {
                                const n = parseInt(m[1], 10);
                                if (n > maxIdx) maxIdx = n;
                            }
                        });
                        const nextIdx = maxIdx + 1;
                        // Tambahkan option baru
                        addSheetOption(nextIdx);
                    });
                }

                // Jika sheet baru ditambah lewat script lain, expose fungsi global
                window.addSheetOptionToImport = addSheetOption;
            });
            </script>
            </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Import</button>
              </div>
            </form>
          </div>
              </div>
            </div>
            @if(session('import_error'))
              <div class="alert alert-danger mt-2">{{ session('import_error') }}</div>
            @endif
            @if(session('import_success'))
              <div class="alert alert-success mt-2">{{ session('import_success') }}</div>
            @endif
            <div class="d-flex justify-content-end mb-3">
              <button id="addSheetBtn" class="btn btn-success">+ Tambah Sheet</button>
            </div>
            {{-- TEMPLATE NAV ITEM --}}
            <template id="tpl-nav-item">
            <li class="nav-item" role="presentation">
                <button
                class="nav-link"
                id="sheet__INDEX__-tab"
                data-bs-toggle="tab"
                data-bs-target="#sheet__INDEX__"
                type="button" role="tab"
                >
                Sheet __INDEX__
                </button>
            </li>
            </template>

            {{-- TEMPLATE TAB PANE --}}
            <template id="tpl-tab-pane">
            <div class="tab-pane fade" id="sheet__INDEX__" role="tabpanel">
                <div class="table-responsive" style="margin-top: 0px;">
                <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                    <thead class="table-dark text-center">
                    <tr>
                        <th>No</th><th>Site ID</th><th>Nama Lokasi</th>
                        <th>SNMP Modem</th><th>SNMP Router</th><th>SNMP AP1</th><th>SNMP AP2</th>
                        <th>Rata-Rata Perangkat</th><th>Rata-Rata AP1 & AP2</th>
                        <th>Uptime Zabbix</th><th>Uptime Perhari</th><th>Uptime Menit</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- nanti diisi sama server atau AJAX --}}
                    </tbody>
                    <tfoot>
                    <tr class="text-center fw-bold bg-light">
                        <td colspan="3" class="text-end">TOTAL</td><td colspan="9">-</td>
                    </tr>
                    <tr class="text-center fw-bold bg-secondary text-white">
                        <td colspan="3" class="text-end">RATA-RATA</td><td colspan="9">-</td>
                    </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            </template>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-3" id="slaTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="sheet1-tab" data-bs-toggle="tab" data-bs-target="#sheet1" type="button" role="tab">(SLA BMN Juni)</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="sheet2-tab" data-bs-toggle="tab" data-bs-target="#sheet2" type="button" role="tab">(SLA SL Juni)</button>
              </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="slaTabContent">
              <div class="tab-pane fade show active" id="sheet1" role="tabpanel">

              <!-- Tabel dengan scroll horizontal -->
              <div class="table-responsive" style="margin-top: 0px;">
                <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Site ID</th>
                            <th style="min-width: 400px;">Nama Lokasi</th>
                            <th>SNMP Modem</th>
                            <th>SNMP Router</th>
                            <th>SNMP AP1</th>
                            <th>SNMP AP2</th>
                            <th>Rata-Rata Perangkat</th>
                            <th>Rata-Rata AP1 & AP2</th>
                            <th>Uptime Zabbix (detik)</th>
                            <th>Uptime Perhari (jam)</th>
                            <th>Uptime Menit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalModem = 0;
                            $totalRouter = 0;
                            $totalAP1 = 0;
                            $totalAP2 = 0;
                            $count = count($data);
                        @endphp

                        @foreach ($data as $d)
                            @php
                                $modem = floatval(str_replace(',', '.', str_replace('%', '', $d->snmp_modem)));
                                $router = floatval(str_replace(',', '.', str_replace('%', '', $d->snmp_router)));
                                $ap1 = floatval(str_replace(',', '.', str_replace('%', '', $d->snmp_ap1)));
                                $ap2 = floatval(str_replace(',', '.', str_replace('%', '', $d->snmp_ap2)));

                                $totalModem += $modem;
                                $totalRouter += $router;
                                $totalAP1 += $ap1;
                                $totalAP2 += $ap2;

                                $rataRataPerangkat = round(($modem + $router + $ap1 + $ap2) / 4, 2);
                                $rataRataAP = round(($ap1 + $ap2) / 2, 2);

                                $uptimePerhari = $d->uptime_zabbix ? intval($d->uptime_zabbix / 3600 / 31) : 0;
                                $uptimeMenit = $d->uptime_zabbix ? intval($d->uptime_zabbix / 60 / 28) : 0;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $d->id }}</td>
                                <td class="text-center">{{ $d->site_id }}</td>
                                <td class="text-wrap" style="max-width: 200px;">{{ $d->nama_lokasi }}</td>
                                <td contenteditable="true" data-id="{{ $d->id }}" data-field="snmp_modem" class="editable text-center">{{ $modem }}%</td>
                                <td contenteditable="true" data-id="{{ $d->id }}" data-field="snmp_router" class="editable text-center">{{ $router }}%</td>
                                <td contenteditable="true" data-id="{{ $d->id }}" data-field="snmp_ap1" class="editable text-center">{{ $ap1 }}%</td>
                                <td contenteditable="true" data-id="{{ $d->id }}" data-field="snmp_ap2" class="editable text-center">{{ $ap2 }}%</td>
                                <td class="rata-rata-perangkat text-center" data-id="{{ $d->id }}">{{ $rataRataPerangkat }}%</td>
                                <td class="rata-rata-ap text-center" data-id="{{ $d->id }}">{{ $rataRataAP }}%</td>
                                <td contenteditable="true" data-id="{{ $d->id }}" data-field="uptime_zabbix" class="editable text-center">{{ $d->uptime_zabbix }}</td>
                                <td class="uptime-perhari text-center" data-id="{{ $d->id }}">{{ $uptimePerhari }} JAM</td>
                                <td class="uptime-menit text-center" data-id="{{ $d->id }}">{{ $uptimeMenit }} MENIT</td>
                            </tr>
                        @endforeach
                    </tbody>

                    @php
                        $avgModem = $count > 0 ? round($totalModem / $count, 2) : 0;
                        $avgRouter = $count > 0 ? round($totalRouter / $count, 2) : 0;
                        $avgAP1 = $count > 0 ? round($totalAP1 / $count, 2) : 0;
                        $avgAP2 = $count > 0 ? round($totalAP2 / $count, 2) : 0;
                        $avgAllDevices = round(($avgModem + $avgRouter + $avgAP1 + $avgAP2) / 4, 2);
                        $avgAPsOnly = round(($avgAP1 + $avgAP2) / 2, 2);
                    @endphp

                    <tfoot>
                        <tr class="text-center fw-bold bg-light">
                            <td colspan="3" class="text-end">TOTAL</td>
                            <td>{{ $totalModem }}%</td>
                            <td>{{ $totalRouter }}%</td>
                            <td>{{ $totalAP1 }}%</td>
                            <td>{{ $totalAP2 }}%</td>
                            <td colspan="5">-</td>
                        </tr>
                        <tr class="text-center fw-bold bg-secondary text-white">
                            <td colspan="3" class="text-end">RATA-RATA</td>
                            <td>{{ $avgModem }}%</td>
                            <td>{{ $avgRouter }}%</td>
                            <td>{{ $avgAP1 }}%</td>
                            <td>{{ $avgAP2 }}%</td>
                            <td>{{ $avgAllDevices }}%</td>
                            <td>{{ $avgAPsOnly }}%</td>
                            <td colspan="3">-</td>
                        </tr>
                    </tfoot>

                </table>
              </div> <!-- end table-responsive -->
              </div> <!-- end tab-pane sheet1 -->

              <!-- Sheet 2 Kosong -->
              <div class="tab-pane fade" id="sheet2" role="tabpanel">
                <div class="table-responsive" style="margin-top: 0px;">
                    <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                    <thead class="table-dark text-center">
                        <tr>
                        <th>No</th>
                        <th>Site ID</th>
                        <th style="min-width: 400px;">Nama Lokasi</th>
                        <th>SNMP Modem</th>
                        <th>SNMP Router</th>
                        <th>SNMP AP1</th>
                        <th>SNMP AP2</th>
                        <th>Rata-Rata Perangkat</th>
                        <th>Rata-Rata AP1 & AP2</th>
                        <th>Uptime Zabbix (detik)</th>
                        <th>Uptime Perhari (jam)</th>
                        <th>Uptime Menit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalModem2 = $totalRouter2 = $totalAP1_2 = $totalAP2_2 = 0;
                        $count2 = count($data2);
                        @endphp

                        @foreach ($data2 as $d)
                        @php
                            $modem = floatval(str_replace(',', '.', str_replace('%', '', $d->snmp_modem)));
                            $router = floatval(str_replace(',', '.', str_replace('%', '', $d->snmp_router)));
                            $ap1 = floatval(str_replace(',', '.', str_replace('%', '', $d->snmp_ap1)));
                            $ap2 = floatval(str_replace(',', '.', str_replace('%', '', $d->snmp_ap2)));

                            $totalModem2 += $modem;
                            $totalRouter2 += $router;
                            $totalAP1_2 += $ap1;
                            $totalAP2_2 += $ap2;

                            $rataRataPerangkat = round(($modem + $router + $ap1 + $ap2) / 4, 2);
                            $rataRataAP = round(($ap1 + $ap2) / 2, 2);

                            $uptimePerhari = $d->uptime_zabbix ? intval($d->uptime_zabbix / 3600 / 31) : 0;
                            $uptimeMenit = $d->uptime_zabbix ? intval($d->uptime_zabbix / 60 / 28) : 0;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $d->id }}</td>
                            <td class="text-center">{{ $d->site_id }}</td>
                            <td class="text-wrap" style="max-width: 200px;">{{ $d->nama_lokasi }}</td>
                            <td contenteditable="true" data-id="{{ $d->id }}" data-field="snmp_modem" class="editable text-center">{{ $modem }}%</td>
                            <td contenteditable="true" data-id="{{ $d->id }}" data-field="snmp_router" class="editable text-center">{{ $router }}%</td>
                            <td contenteditable="true" data-id="{{ $d->id }}" data-field="snmp_ap1" class="editable text-center">{{ $ap1 }}%</td>
                            <td contenteditable="true" data-id="{{ $d->id }}" data-field="snmp_ap2" class="editable text-center">{{ $ap2 }}%</td>
                            <td class="rata-rata-perangkat text-center" data-id="{{ $d->id }}">{{ $rataRataPerangkat }}%</td>
                            <td class="rata-rata-ap text-center" data-id="{{ $d->id }}">{{ $rataRataAP }}%</td>
                            <td contenteditable="true" data-id="{{ $d->id }}" data-field="uptime_zabbix" class="editable text-center">{{ $d->uptime_zabbix }}</td>
                            <td class="uptime-perhari text-center">{{ $uptimePerhari }} JAM</td>
                            <td class="uptime-menit text-center">{{ $uptimeMenit }} MENIT</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @php
                        $avgModem2 = $count2 > 0 ? round($totalModem2 / $count2, 2) : 0;
                        $avgRouter2 = $count2 > 0 ? round($totalRouter2 / $count2, 2) : 0;
                        $avgAP1_2 = $count2 > 0 ? round($totalAP1_2 / $count2, 2) : 0;
                        $avgAP2_2 = $count2 > 0 ? round($totalAP2_2 / $count2, 2) : 0;
                        $avgAllDevices2 = round(($avgModem2 + $avgRouter2 + $avgAP1_2 + $avgAP2_2) / 4, 2);
                        $avgAPsOnly2 = round(($avgAP1_2 + $avgAP2_2) / 2, 2);
                    @endphp
                    <tfoot>
                        <tr class="text-center fw-bold bg-light">
                        <td colspan="3" class="text-end">TOTAL</td>
                        <td>{{ $totalModem2 }}%</td>
                        <td>{{ $totalRouter2 }}%</td>
                        <td>{{ $totalAP1_2 }}%</td>
                        <td>{{ $totalAP2_2 }}%</td>
                        <td colspan="5">-</td>
                        </tr>
                        <tr class="text-center fw-bold bg-secondary text-white">
                        <td colspan="3" class="text-end">RATA-RATA</td>
                        <td>{{ $avgModem2 }}%</td>
                        <td>{{ $avgRouter2 }}%</td>
                        <td>{{ $avgAP1_2 }}%</td>
                        <td>{{ $avgAP2_2 }}%</td>
                        <td>{{ $avgAllDevices2 }}%</td>
                        <td>{{ $avgAPsOnly2 }}%</td>
                        <td colspan="3">-</td>
                        </tr>
                    </tfoot>
                    </table>
                </div>
                </div>

              <!-- Sheet 3 Kosong -->
              <div class="tab-pane fade" id="sheet3" role="tabpanel">
                <div class="alert alert-info mt-3">Belum ada data Rekap.</div>
              </div>

            </div> <!-- end tab-content -->
        </div> <!-- end card-body -->
    </div> <!-- end card -->
</div> <!-- end container-fluid -->

{{-- Script update data inline --}}
<!-- sla.blade.php -->

<!-- ...HTML tabel dan lainnya -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Misalnya kamu punya tombol tambah baris:
    document.getElementById('tambahBarisBtn').addEventListener('click', function () {

        const formData = {
            site_id: '', // atau ambil dari input
            nama_lokasi: '', // atau ambil dari input
            snmp_modem: 0,
            snmp_router: 0,
            snmp_ap1: 0,
            snmp_ap2: 0,
            rata_rata_perangkat: 0,
            rata_rata_ap1_ap2: 0,
            uptime_perhari: 0,
            uptime_perhari_menit: 0,
            uptime_zabbix: 00,
            sheet: 'sheet3'
        };

        fetch('/sla/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        .then(data => {
            console.log('Tersimpan:', data);
            alert("Data berhasil disimpan ke Sheet3!");

            // Tambahkan row baru ke tabel (jika ingin realtime muncul)
            // atau refresh data tabel
        })
        .catch(err => console.error('Error:', err));
    });
});
</script>
<script>
    document.getElementById('addSheetBtn').addEventListener('click', function () {
  const navTabs = document.querySelector('.nav.nav-tabs');
  const tabContent = document.querySelector('.tab-content');

  // Ambil semua tab yang ada, ambil angka sheet-nya
  const currentTabs = Array.from(navTabs.querySelectorAll('a.nav-link[id^="sheet"]'));
  
  // Cari angka index terbesar dari tab yang ada
  let maxIndex = 2; // Mulai minimal dari 2, karena sheet 1 dan 2 sudah ada
  
  currentTabs.forEach(tab => {
    const match = tab.id.match(/sheet(\d+)-tab/);
    if (match) {
      const num = parseInt(match[1], 10);
      if (num > maxIndex) maxIndex = num;
    }
  });

  // Index sheet baru adalah maxIndex + 1
  const idx = maxIndex + 1;

  const tplNav = `
    <li class="nav-item">
      <a class="nav-link" id="sheet${idx}-tab" data-bs-toggle="tab" href="#sheet${idx}">Sheet ${idx}</a>
    </li>`;

  const tplPane = `
    <div class="tab-pane fade" id="sheet${idx}" role="tabpanel">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" data-sheet="${idx}">
          <thead class="text-white bg-primary text-center">
            <tr>
              <th>No</th>
              <th>Site ID</th>
              <th style="min-width: 400px;">Nama Lokasi</th>
              <th>SNMP Modem</th>
              <th>SNMP Router</th>
              <th>SNMP AP1</th>
              <th>SNMP AP2</th>
              <th>Rata-Rata Perangkat</th>
              <th>Rata-Rata AP1 & AP2</th>
              <th>Uptime Zabbix (detik)</th>
              <th>Uptime Perhari (jam)</th>
              <th>Uptime Menit</th>
            </tr>
          </thead>
          <tbody>
            <!-- Tabel kosong -->
          </tbody>
          <tfoot>
            <tr class="text-center fw-bold bg-light">
              <td colspan="3" class="text-end">TOTAL</td>
              <td class="total-modem">0%</td>
              <td class="total-router">0%</td>
              <td class="total-ap1">0%</td>
              <td class="total-ap2">0%</td>
              <td colspan="5">-</td>
            </tr>
            <tr class="text-center fw-bold bg-secondary text-white">
              <td colspan="3" class="text-end">RATA-RATA</td>
              <td class="avg-modem">0%</td>
              <td class="avg-router">0%</td>
              <td class="avg-ap1">0%</td>
              <td class="avg-ap2">0%</td>
              <td class="avg-all-devices">0%</td>
              <td class="avg-aps-only">0%</td>
              <td colspan="3">-</td>
            </tr>
          </tfoot>
        </table>

        <!-- Tombol tambah baris baru di sheet ini -->
        <button class="btn btn-sm btn-success mt-2 add-row-btn" data-sheet="${idx}">Tambah Baris</button>
      </div>
    </div>`;

  // Sisipkan tab dan pane baru setelah sheet 2
  const sheet2Tab = document.querySelector('#sheet2-tab')?.closest('li');
  const sheet2Pane = document.querySelector('#sheet2');

  if (sheet2Tab && sheet2Pane) {
    sheet2Tab.insertAdjacentHTML('afterend', tplNav);
    sheet2Pane.insertAdjacentHTML('afterend', tplPane);
  } else {
    // Jika sheet 2 tidak ada, masukkan di akhir
    navTabs.insertAdjacentHTML('beforeend', tplNav);
    tabContent.insertAdjacentHTML('beforeend', tplPane);
  }

  // Aktifkan tab baru
  const newTab = document.querySelector(`#sheet${idx}-tab`);
  const tab = new bootstrap.Tab(newTab);
  tab.show();

  // Bind event dan logika di sheet baru
  bindSheetFunctions(idx);
});


// Fungsi bind semua event dan logika di sheet idx
function bindSheetFunctions(sheetIdx) {
  const pane = document.querySelector(`#sheet${sheetIdx}`);
  if (!pane) return;

  const table = pane.querySelector('table');
  const tbody = table.querySelector('tbody');
  const addRowBtn = pane.querySelector('.add-row-btn');

  // Event tombol tambah baris
  addRowBtn.addEventListener('click', () => {
    const rowCount = tbody.rows.length + 1;
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
      <td class="text-center">${rowCount}</td>
      <td contenteditable="true" class="editable text-center" data-field="site_id"></td>
      <td contenteditable="true" class="editable" style="max-width: 200px;"></td>
      <td contenteditable="true" class="editable text-center" data-field="snmp_modem">0</td>
      <td contenteditable="true" class="editable text-center" data-field="snmp_router">0</td>
      <td contenteditable="true" class="editable text-center" data-field="snmp_ap1">0</td>
      <td contenteditable="true" class="editable text-center" data-field="snmp_ap2">0</td>
      <td class="rata-rata-perangkat text-center">0%</td>
      <td class="rata-rata-ap text-center">0%</td>
      <td contenteditable="true" class="editable text-center" data-field="uptime_zabbix">0</td>
      <td class="uptime-perhari text-center">0 JAM</td>
      <td class="uptime-menit text-center">0 MENIT</td>
    `;

    tbody.appendChild(newRow);

    // Bind event pada cell contenteditable di baris baru
    bindEditableEvents(newRow, table);
    hitungFooter(table);
  });

  // Bind event contenteditable untuk baris yang sudah ada (jika ada)
  tbody.querySelectorAll('tr').forEach(row => {
    bindEditableEvents(row, table);
  });

  // Hitung ulang footer saat pertama kali bind
  hitungFooter(table);
}

// Bind event blur untuk kolom contenteditable di 1 baris
function bindEditableEvents(row, table) {
  row.querySelectorAll('td.editable').forEach(td => {
    td.addEventListener('blur', () => {
      // Ambil nilai perangkat dari baris tersebut
      const modem = parseFloat(row.querySelector('[data-field="snmp_modem"]').textContent) || 0;
      const router = parseFloat(row.querySelector('[data-field="snmp_router"]').textContent) || 0;
      const ap1 = parseFloat(row.querySelector('[data-field="snmp_ap1"]').textContent) || 0;
      const ap2 = parseFloat(row.querySelector('[data-field="snmp_ap2"]').textContent) || 0;
      const uptimeZabbix = parseInt(row.querySelector('[data-field="uptime_zabbix"]').textContent) || 0;

      // Hitung rata-rata
      const rataRataPerangkat = ((modem + router + ap1 + ap2) / 4).toFixed(2);
      const rataRataAP = ((ap1 + ap2) / 2).toFixed(2);

      // Update kolom rata-rata di baris
      row.querySelector('.rata-rata-perangkat').textContent = rataRataPerangkat + '%';
      row.querySelector('.rata-rata-ap').textContent = rataRataAP + '%';

      // Hitung uptime perhari dan menit
      const uptimePerhari = Math.floor(uptimeZabbix / 3600 / 31);
      const uptimeMenit = Math.floor(uptimeZabbix / 60 / 28);

      row.querySelector('.uptime-perhari').textContent = uptimePerhari + ' JAM';
      row.querySelector('.uptime-menit').textContent = uptimeMenit + ' MENIT';

      // Setelah update satu baris, hitung ulang footer total & rata-rata
      hitungFooter(table);
    });
  });
}

// Fungsi hitung total dan rata-rata di footer
function hitungFooter(table) {
  const tbody = table.querySelector('tbody');
  const rows = tbody.querySelectorAll('tr');

  let totalModem = 0, totalRouter = 0, totalAP1 = 0, totalAP2 = 0;

  rows.forEach(row => {
    totalModem += parseFloat(row.querySelector('[data-field="snmp_modem"]').textContent) || 0;
    totalRouter += parseFloat(row.querySelector('[data-field="snmp_router"]').textContent) || 0;
    totalAP1 += parseFloat(row.querySelector('[data-field="snmp_ap1"]').textContent) || 0;
    totalAP2 += parseFloat(row.querySelector('[data-field="snmp_ap2"]').textContent) || 0;
  });

  const count = rows.length || 1; // agar tidak dibagi 0

  const avgModem = (totalModem / count).toFixed(2);
  const avgRouter = (totalRouter / count).toFixed(2);
  const avgAP1 = (totalAP1 / count).toFixed(2);
  const avgAP2 = (totalAP2 / count).toFixed(2);

  const avgAllDevices = ((parseFloat(avgModem) + parseFloat(avgRouter) + parseFloat(avgAP1) + parseFloat(avgAP2)) / 4).toFixed(2);
  const avgAPsOnly = ((parseFloat(avgAP1) + parseFloat(avgAP2)) / 2).toFixed(2);

  // Update footer
  table.querySelector('.total-modem').textContent = totalModem.toFixed(2) + '%';
  table.querySelector('.total-router').textContent = totalRouter.toFixed(2) + '%';
  table.querySelector('.total-ap1').textContent = totalAP1.toFixed(2) + '%';
  table.querySelector('.total-ap2').textContent = totalAP2.toFixed(2) + '%';

  table.querySelector('.avg-modem').textContent = avgModem + '%';
  table.querySelector('.avg-router').textContent = avgRouter + '%';
  table.querySelector('.avg-ap1').textContent = avgAP1 + '%';
  table.querySelector('.avg-ap2').textContent = avgAP2 + '%';
  table.querySelector('.avg-all-devices').textContent = avgAllDevices + '%';
  table.querySelector('.avg-aps-only').textContent = avgAPsOnly + '%';
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.editable').forEach(cell => {
        cell.addEventListener('blur', function () {
            const id = this.dataset.id;
            const field = this.dataset.field;
            let value = this.innerText.replace('%', '').trim();

            fetch(`/sla/update-inline/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ field: field, value: value })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) return alert('Update gagal!');
                const row = cell.closest('tr');

                if (field === 'uptime_zabbix') {
                    const jam = Math.floor(parseFloat(value) / 3600 / 31);
                    const menit = Math.floor(parseFloat(value) / 60 / 28);
                    row.querySelector('.uptime-perhari').innerText = `${jam} JAM`;
                    row.querySelector('.uptime-menit').innerText = `${menit} MENIT`;
                }

                const modem = parseFloat(row.querySelector('[data-field="snmp_modem"]').innerText.replace('%', '')) || 0;
                const router = parseFloat(row.querySelector('[data-field="snmp_router"]').innerText.replace('%', '')) || 0;
                const ap1 = parseFloat(row.querySelector('[data-field="snmp_ap1"]').innerText.replace('%', '')) || 0;
                const ap2 = parseFloat(row.querySelector('[data-field="snmp_ap2"]').innerText.replace('%', '')) || 0;

                const rataPerangkat = ((modem + router + ap1 + ap2) / 4).toFixed(2);
                const rataAP = ((ap1 + ap2) / 2).toFixed(2);

                row.querySelector('.rata-rata-perangkat').innerText = `${rataPerangkat}%`;
                row.querySelector('.rata-rata-ap').innerText = `${rataAP}%`;
            })
            .catch(error => {
                alert('Terjadi kesalahan saat menyimpan!');
                console.error(error);
            });
        });
    });
});
</script>
@endsection
