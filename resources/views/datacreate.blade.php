@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Form Tambah Data Site</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <label>ID SITE</label>
                            <input type="text" name="idsite" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>SITE NAME</label>
                            <input type="text" name="sitename" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>TIPE</label>
                            <input type="text" name="tipe" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>BATCH</label>
                            <input type="text" name="batch" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>LATITUDE</label>
                            <input type="text" name="latitude" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>LONGITUDE</label>
                            <input type="text" name="longitude" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>PROVINSI</label>
                            <input type="text" name="provinsi" class="form-control" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>KABUPATEN</label>
                            <input type="text" name="kab" class="form-control" required>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>KECAMATAN</label>
                            <input type="text" name="kecamatan" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>KELURAHAN / DESA</label>
                            <input type="text" name="kelurahan" class="form-control">
                        </div>
                        <div class="col-md-8 mt-3">
                            <label>ALAMAT LOKASI</label>
                            <textarea name="alamat_lokasi" class="form-control"></textarea>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>NAMA PIC LOKASI</label>
                            <input type="text" name="nama_pic" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>NOMOR PIC LOKASI</label>
                            <input type="text" name="nomor_pic" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SUMBER LISTRIK UTAMA</label>
                            <input type="text" name="sumber_listrik" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>GATEWAY AREA</label>
                            <input type="text" name="gateway_area" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>BEAM</label>
                            <input type="text" name="beam" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>HUB</label>
                            <input type="text" name="hub" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>KODEFIKASI</label>
                            <input type="text" name="kodefikasi" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN ANTENA</label>
                            <input type="text" name="sn_antena" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN MODEM HT3210</label>
                            <input type="text" name="sn_modem" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN ROUTER 450GX4</label>
                            <input type="text" name="sn_router" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN AP1 VT-601</label>
                            <input type="text" name="sn_ap1" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN AP2 VT-601</label>
                            <input type="text" name="sn_ap2" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN TRANSCEIVER</label>
                            <input type="text" name="sn_tranciever" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN STABILIZER</label>
                            <input type="text" name="sn_stabilizer" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN RAK</label>
                            <input type="text" name="sn_rak" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>IP MODEM</label>
                            <input type="text" name="ip_modem" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>IP ROUTER</label>
                            <input type="text" name="ip_router" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>IP AP 1</label>
                            <input type="text" name="ip_ap1" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>IP AP 2</label>
                            <input type="text" name="ip_ap2" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>EXPECTED SQF</label>
                            <input type="text" name="expected_sqf" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('tables') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
