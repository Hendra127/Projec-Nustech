@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
  }
 </style>
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
                <!-- Tombol Tambah, Export, Import -->
                <div class="d-flex flex-wrap mb-3">
                    <div style="margin-right: 20px">
                        <a href="#" class="btn btn-primary mr-3 mb-3" data-toggle="modal" data-target="#modalTambahTiket">Tambah Data</a>
                        <a href="{{ route('tiketexport') }}" class="btn btn-success mr-3 mb-3">Export</a>
                        <a href="#" class="btn btn-info mb-3" data-toggle="modal" data-target="#exampleModalLong">Import</a>
                    </div>
                </div>

                <!-- Form Search -->
                <form action="{{ route('tiket') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="query" class="form-control" placeholder="Search by Site Name or Province" value="{{ request()->query('query') }}">
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <!-- Tabel dengan scroll horizontal -->
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table table-bordered table-striped" style="min-width: 1000px;">
                        <thead class="thead-dark">
                            <tr>
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
                                <th>No</th>
                                <th>SITE ID</th>
                                <th>NAMA SITE</th>
                                <th>PROVINSI</th>
                                <th>KABUPATEN</th>
                                <th>
                                    @php
                                        $currentSort = request()->query('sort', 'desc');
                                        $nextSort = $currentSort === 'asc' ? 'desc' : 'asc';
                                    @endphp
                                    <a href="{{ url('tiket') }}?sort={{ $nextSort }}">DURASI</a>
                                </th>
                                <th>KATEGORI</th>
                                <th>TANGGAL REKAP</th>
                                <th>BULAN OPEN</th>
                                <th>STATUS TIKET</th>
                                <th>KENDALA</th>
                                <th>TANGGAL CLOSE</th>
                                <th>BULAN CLOSE</th>
                                <th>DETAIL PROBLEM</th>
                                <th>PLAN ACTIONS</th>
                                <th>CE</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiket as $index => $item)
                            <tr>
                                <td>{{ $tiket->firstItem() + $index }}</td>
                                <td>{{ $item->site_id }}</td>
                                <td>{{ $item->nama_site }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kabupaten }}</td>
                                <td class="durasi">{{ $item->durasi_terbaru }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td class="tanggal-rekap">{{ $item->tanggal_rekap }}</td>
                                <td>{{ $item->bulan_open }}</td>
                                <td>{{ $item->status_tiket }}</td>
                                <td>{{ $item->kendala }}</td>
                                <td>
                                    {{ $item->tanggal_close 
                                        ? $bulan[\Carbon\Carbon::parse($item->tanggal_close)->format('m')] 
                                        : 'BELUM CLOSE' }}
                                </td>
                                <td>
                                    {{ $item->bulan_close && isset($bulan[$item->bulan_close]) ? $bulan[$item->bulan_close] : ($item->bulan_close ?? 'BELUM CLOSE') }}
                                </td>
                                <td>{{ $item->detail_problem }}</td>
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
                                                Close
                                            </button>
                                        </form>
                                    @endif
                                    <a href="#" class="btn btn-info mr-3 mb-3 btn-delete" data-id="{{ $item->id }}" data-url="{{ route('tiket.delete', ['id' => $item->id]) }}">
                                        Delete
                                    </a>
                                    <a href="#" class="btn btn-primary mr-3 mb-3" data-toggle="modal" onclick="openEditModal({{ $item->id }})">Update</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
     
    <div class="modal fade" id="modalTambahTiket" tabindex="-1" role="dialog" aria-labelledby="modalTambahTiketLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="tiketForm" method="POST">
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
                            <input type="text" value="0" name="durasi" class="form-control" readonly>
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
                                <option value="JANUARI">JANUARI</option>
                                <option value="FEBRUARI">FEBRUARI</option>
                                <option value="MARET">MARET</option>
                                <option value="APRIL">APRIL</option>
                                <option value="MEI">MEI</option>
                                <option value="JUNI">JUNI</option>
                                <option value="JULI">JULI</option>
                                <option value="AGUSTUS">AGUSTUS</option>
                                <option value="SEPTEMBER">SEPTEMBER</option>
                                <option value="OKTOBER">OKTOBER</option>
                                <option value="NOVEMBER">NOVEMBER</option>
                                <option value="DESEMBER">DESEMBER</option>
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
                            <input type="date" name="tanggal_close" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bulan Close Tiket</label>
                            <input type="text" id="bulan_close"  value="BELUM CLOSE" name="bulan_close" class="form-control" readonly>
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
                            <input type="text" name="ce" class="form-control">
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
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
        }
    });
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
                    $("textarea[name='detail_problem']").val(
                        response.data.detail_problem
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
