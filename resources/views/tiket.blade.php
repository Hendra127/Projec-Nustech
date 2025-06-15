@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
            <h4 class="mb-4" style="text-align: center;"> Data Open Tiket</h4>
                <!-- Tombol Tambah, Export, Import -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    {{-- Tombol Aksi di Kiri --}}
                    <div class="d-flex flex-wrap gap-2 mb-2">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahTiket">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                        <a href="{{ route('tiketexport') }}" class="btn btn-success">
                            <i class="fa fa-file-excel-o"></i> Export
                        </a>
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong">
                            <i class="fa fa-upload"></i> Import
                        </a>
                    </div>

                    {{-- Form Search di Kanan --}}
                    <form action="{{ route('tiket') }}" method="GET" class="d-flex align-items-center gap-2">
                        <input type="text" name="query" class="form-control form-control-sm" placeholder="Enter To Search" value="{{ request()->query('query') }}">
                        <button type="submit" class="btn btn-magenta btn-sm mb-0">Search</button>
                    </form>
                </div>
            </div>
            <div class="card-body">

            <div class="card-body">
                <!-- Tabel dengan scroll horizontal -->
                <div class="table-responsive" style="margin-top: -60px;">
                    <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                        <thead class="table-dark">
                            <tr class="text-center align-middle">
                                @php
                                    $bulan = [
                                        '01' => 'Januari',
                                        '02' => 'Februari',
                                        '03' => 'Maret',
                                        '04' => 'April',
                                        '05' => 'Mei',
                                        '06' => 'Juni',
                                        '07' => 'Juli',
                                        '08' => 'Agustus',
                                        '09' => 'September',
                                        '10' => 'Oktober',
                                        '11' => 'November',
                                        '12' => 'Desember',
                                    ];
                                @endphp
                                <th class="text-center">No</th>
                                <th class="text-center">SITE ID</th>
                                <th class="text-center">NAMA SITE</th>
                                <th class="text-center">PROVINSI</th>
                                <th class="text-center">KABUPATEN</th>
                                <th>
                                    @php
                                        $currentSort = request()->query('sort', 'desc');
                                        $nextSort = $currentSort === 'asc' ? 'desc' : 'asc';
                                    @endphp
                                    <a href="{{ url('tiket') }}?sort={{ $nextSort }}" class="fw-bold text-white">DURASI</a>
                                </th>
                                <th class="text-center align-middle">
                                    <form method="GET" action="{{ route('tiket') }}" class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="fw-bold text-white" style="white-space: nowrap;">KATEGORI</span>
                                        <select name="kategori" class="form-select form-select-sm" style="width: 65px; padding-right: 10px;" onchange="this.form.submit()">
                                            <option value="">Semua</option>
                                            <option value="BMN" {{ request('kategori') == 'BMN' ? 'selected' : '' }}>BMN</option>
                                            <option value="SL" {{ request('kategori') == 'SL' ? 'selected' : '' }}>SL</option>
                                        </select>
                                        <input type="hidden" name="query" value="{{ request('query') }}">
                                    </form>
                                </th>
                                <th class="text-center">TANGGAL OPEN</th>
                                <th class="text-center">BULAN OPEN</th>
                                <th class="text-center">STATUS TIKET</th>
                                <th class="text-center">KENDALA</th>
                                <th class="text-center">TANGGAL CLOSE</th>
                                <th class="text-center">BULAN CLOSE</th>
                                <th class="text-center">EVIDENCE</th>
                                <th class="text-center">DETAIL PROBLEM</th>
                                <th class="text-center">PLAN ACTIONS</th>
                                <th class="text-center">CE</th>
                                <th class="text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiket as $index => $item)
                            <tr>
                                <td class="text-center">{{ $tiket->firstItem() + $index }}</td>
                                <td class="text-center">{{ $item->site_id }}</td>
                                <td>{{ $item->nama_site }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kabupaten }}</td>
                                <td class="durasi text-center">{{ $item->durasi_terbaru }} Hari</td>
                                <td class="text-center">{{ $item->kategori }}</td>
                                <td class="tanggal-rekap text-center">{{ $item->tanggal_rekap }}</td>
                                <td class="text-center">{{ $item->bulan_open }}</td>
                                <td class="text-center">{{ $item->status_tiket }}</td>
                                <td>{{ $item->kendala }}</td>
                                <td class="text-center">
                                    {{ $item->tanggal_close 
                                        ? $bulan[\Carbon\Carbon::parse($item->tanggal_close)->format('m')] 
                                        : 'BELUM CLOSE' }}
                                </td>
                                <td class="text-center">
                                    {{ $item->bulan_close && isset($bulan[$item->bulan_close]) ? $bulan[$item->bulan_close] : ($item->bulan_close ?? 'BELUM CLOSE') }}
                                </td>
                                <td class="text-center">
                                    @if ($item->evidence)
                                        <a href="#" onclick="showEvidence('{{ asset('storage/'.$item->evidence) }}')" style="text-decoration: underline;">
                                            ADA
                                        </a>
                                    @else
                                        TIDAK ADA
                                    @endif
                                </td >
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                        {{ \Illuminate\Support\Str::limit($item->detail_problem, 30) }}
                                    </a>

                                    <!-- Modal untuk detail problem -->
                                    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $item->id }}">Detail Problem</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body"
                                                style="white-space: normal; word-break: break-word; max-height: 400px; overflow-y: auto; line-height: 1.5;" >
                                            {{ $item->detail_problem }}
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->plan_actions }}</td>
                                <td>{{ $item->ce }}</td>
                                <td class="d-flex gap-2">
                                   @if ($item->status_tiket != 'close')
                                        <form action="{{ route('tiket.updateStatus', ['id' => $item->id]) }}" method="POST" class="form-close-tiket">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="status_tiket" value="CLOSE">
                                            <input type="hidden" name="tanggal_close" id="tanggal_close{{ $item->id }}">
                                            <input type="hidden" name="bulan_close" id="bulan_close{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger mr-3 mb-3 btn-submit-close" data-id="{{ $item->id }}">
                                                <i class="fa fa-times"></i> Close
                                            </button>
                                        </form>
                                    @endif
                                    <a href="#" class="btn btn-info mr-3 mb-3 btn-delete" data-id="{{ $item->id }}" data-url="{{ route('tiket.delete', ['id' => $item->id]) }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                    <a href="#" class="btn btn-primary mr-3 mb-3" data-toggle="modal" onclick="openEditModal({{ $item->id }})">
                                        <i class="fa fa-edit"></i> Update
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal untuk menampilkan gambar -->
                    <div class="modal fade" id="evidenceModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                            <div class="modal-body text-center" id="evidenceContent">
                                <!-- Isi evidence akan dimuat via JS -->
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sticky Pagination -->
                <div class="position-sticky bottom-0 end-0 bg-white py-3" style="z-index: 1000;">
                    <div class="d-flex justify-content-end pe-3">
                        {{ $tiket->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('tiketimport') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Data</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih File Excel:</label>
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data Tiket -->
     @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Buka kembali modal jika ada error validasi
                var myModal = new bootstrap.Modal(document.getElementById('modalAdd'));
                myModal.show();
            });
        </script>

        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="modal fade" id="modalTambahTiket" tabindex="-1" role="dialog" aria-labelledby="modalTambahTiketLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="tiketForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahTiketLabel">Tambah Data Tiket</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div id="formMethod"></div>
                        <input type="hidden" name="nama_site" id="nama_site" class="form-control">
                        <div class="form-group col-md-6">
                            <label>Site ID</label>
                            <input type="text" name="site_id" id="site_id" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6 d-flex flex-column" style="margin-top: 4px;">
                            <label>Nama Site</label>
                            <input type="text" name="sitename" class="form-control">
                            <select id="select_site_id" class="form-control">
                                <option value="">-- Pilih Nama Site --</option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}">{{ $site->sitename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kabupaten</label>
                            <input type="text" id="kabupaten" name="kabupaten" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Durasi</label>
                            <input type="text" value="0" name="durasi" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kategori Tiket</label>
                            <select name="kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="BMN">BMN</option>
                                <option value="SL">SL</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Rekap</label>
                            <input type="date" name="tanggal_rekap" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bulan Open Tiket</label>
                            <select name="bulan_open" class="form-control" required>
                                <option value="">-- Pilih Bulan Open --</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status Tiket</label>
                            <select name="status_tiket" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="OPEN">OPEN</option>
                                <option value="CLOSE">CLOSE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kendala</label>
                            <input type="text" name="kendala" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Close Tiket</label>
                            <input type="date" name="tanggal_close" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bulan Close Tiket</label>
                            <input type="text" id="bulan_close"  value="BELUM CLOSE" name="bulan_close" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="evidence">Evidence (foto/video)</label>
                            <input type="file" name="evidence" id="evidence" class="form-control" accept="image/*,video/*">
                            
                            {{-- Tampilkan evidence lama jika ada --}}
                            @if(!empty($tiket->evidence))
                                <small class="form-text text-muted">
                                    Evidence sebelumnya: <a href="{{ asset('storage/' . $tiket->evidence) }}" target="_blank">Lihat</a>
                                </small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Detail Problem</label>
                            <textarea name="detail_problem" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Plan Actions</label>
                            <textarea name="plan_actions" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Cluster Engineer (CE)</label>
                            <input type="text" name="ce" class="form-control" required>
                        </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<style>
    .btn-magenta {
        background-color: #d200aa;
        color: white;
    }
</style>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectBulan = document.querySelector('select[name="bulan_open"]');
        const bulanSekarang = new Date().toLocaleString('default', { month: 'long' });

        for (let option of selectBulan.options) {
            if (option.value.toLowerCase() === bulanSekarang.toLowerCase()) {
                option.selected = true;
                break;
            }
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const url = $(this).data('url');
    
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
    $(document).ready(function() {
        $('#select_site_id').select2({
            dropdownParent: $('#modalTambahTiket'), // ini penting untuk modal
            placeholder: "Pilih atau cari Nama Site"
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-submit-close').forEach(button => {
            button.addEventListener('click', function (e) {
                const id = this.getAttribute('data-id');

                const now = new Date();
                const tanggal = now.toISOString().split('T')[0]; // yyyy-mm-dd
                const bulan = String(now.getMonth() + 1).padStart(2, '0'); // 01-12

                // Masukkan nilai ke input hidden
                document.getElementById('tanggal_close' + id).value = tanggal;
                document.getElementById('bulan_close' + id).value = bulan;
            });
        });
    });
     @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true
        }).then(() => {
            // Buka modal kembali setelah notifikasi
            $('#modalTambahTiket').modal('show');
        });
    @endif
    $('#select_site_id').on('change', function () {
        var id = $(this).val();

        if (id) {
            $.ajax({
                url: '{{ url("get-datasite") }}/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#site_id').val(data.site_id);
                    $('#provinsi').val(data.provinsi);
                    $('#kabupaten').val(data.kab);
                    $('#nama_site').val(data.sitename);
                    $('#tanggal_rekap').val(data.tanggal_rekap);
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengambil data site');
                    console.error(xhr.responseText);
                }
            });
        } else {
            $('#site_id').val('');
            $('#provinsi').val('');
            $('#kabupaten').val('');
            $('#nama_site').val('');
            $('#tanggal_rekap').val('');
        }
    });
     @if(session('error') && session('form') === 'tambah')
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true
        }).then(() => {
            var modal = new bootstrap.Modal(document.getElementById('modalTambahTiket'));
            modal.show();
        });
    @endif
    function openCreateModal() {
        $('#siteModal').modal('show');
        $('#modalTitle').text('Create Tiket');
        $('#tiketForm').attr('action', storeUrl);
        $('#tiketForm').trigger('reset');
    }

    function openEditModal(id) {
        $.ajax({
            url: `/api/tiket/datasites/${id}`,
            method: "GET",
            success: function (response) {
                if (response.success) {
                    $('#modalTambahTiket').modal('show');
                    var selectedSite = {
                        id: response.data.id,
                        text: response.data.nama_site
                    };
                    var newOption = new Option(selectedSite.text, selectedSite.id, true, true);
                    $('.site-name-modal').append(newOption).trigger('change');

                    $("input[name='site_id']").val(response.data.site_id);
                    $("input[name='nama_site']").val(response.data.nama_site);
                    $("input[name='provinsi']").val(response.data.provinsi);
                    $("input[name='kabupaten']").val(response.data.kabupaten);
                    $("input[name='durasi']").val(response.data.durasi);
                    $("input[name='kategori']").val(response.data.kategori);
                    $("input[name='tanggal_rekap']").val(
                        response.data.tanggal_rekap
                    );
                    $("input[name='bulan_open']").val(response.data.bulan_open);
                    $("input[name='status_tiket']").val(
                        response.data.status_tiket
                    );
                    $("input[name='kendala']").val(response.data.kendala);
                    $("input[name='tanggal_close']").val(
                        response.data.tanggal_close
                    );
                    $("input[name='bulan_close']").val(
                        response.data.bulan_close
                    );
                    $("input[name='evidence']").val(
                        response.data.evidence
                    );
                    $("textarea[name='detail_problem']").val(
                        response.data.detail_problem
                    );
                    $("textarea[name='plan_actions']").val(
                        response.data.plan_actions
                    );
                    $("textarea[name='ce']").val(
                        response.data.ce
                    );
                    
                    $('#modalTambahTiketLabel').text('Edit Tiket');
                    $('#tiketForm').attr('action', `/tiket/${id}`);
                    $('#formMethod').html('@method("PUT")');
                }
            },
            error: function () {
                alert("Gagal ambil data site.");
            },
        });
    }
</script>
@endsection
