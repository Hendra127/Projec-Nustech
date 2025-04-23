@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Form Tambah Data Site</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('update', ['id' => $site->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>ID SITE</label>
                            <input type="text" name="idsite" id="idsite" class="form-control" required value="{{ $site->id }}">
                        </div>
                        <div class="col-md-4">
                            <label>SITE NAME</label>
                            <select class="site-name form-control" name="sitename" required>
                            </select>
                            {{-- <input type="text" name="sitename" class="form-control" required> --}}
                        </div>
                        <div class="col-md-4">
                            <label>TIPE</label>
                            <input type="text" name="tipe" id="tipe" class="form-control" value="{{ $site->tipe }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>BATCH</label>
                            <input type="text" name="batch" id="batch" class="form-control" value="{{ $site->batch }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>LATITUDE</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" value="{{ $site->latitude }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>LONGITUDE</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" value="{{ $site->longitude }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>PROVINSI</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control" required value="{{ $site->provinsi }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>KABUPATEN</label>
                            <input type="text" name="kab" id="kab" class="form-control" required value="{{ $site->kab }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>KECAMATAN</label>
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control" value="{{ $site->kecamatan }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>KELURAHAN / DESA</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control" value="{{ $site->kelurahan }}">
                        </div>
                        <div class="col-md-8 mt-3">
                            <label>ALAMAT LOKASI</label>
                            <textarea name="alamat_lokasi" id="alamat_lokasi" class="form-control">{{ $site->alamat_lokasi }}</textarea>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>NAMA PIC LOKASI</label>
                            <input type="text" name="nama_pic" id="nama_pic" class="form-control" value="{{ $site->nama_pic }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>NOMOR PIC LOKASI</label>
                            <input type="text" name="nomor_pic" id="nomor_pic" class="form-control" value="{{ $site->nomor_pic }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SUMBER LISTRIK UTAMA</label>
                            <input type="text" name="sumber_listrik" id="sumber_listrik" class="form-control" value="{{ $site->sumber_listrik }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>GATEWAY AREA</label>
                            <input type="text" name="gateway_area" id="gateway_area" class="form-control" value="{{ $site->gateway_area }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>BEAM</label>
                            <input type="text" name="beam" id="beam" class="form-control" value="{{ $site->beam }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>HUB</label>
                            <input type="text" name="hub" id="hub" class="form-control" value="{{ $site->hub }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>KODEFIKASI</label>
                            <input type="text" name="kodefikasi" id="kodefikasi" class="form-control" value="{{ $site->kodefikasi }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN ANTENA</label>
                            <input type="text" name="sn_antena" id="sn_antena" class="form-control" value="{{ $site->sn_antena }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN MODEM HT3210</label>
                            <input type="text" name="sn_modem" id="sn_modem" class="form-control" value="{{ $site->sn_modem }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN ROUTER 450GX4</label>
                            <input type="text" name="sn_router" id="sn_router" class="form-control" value="{{ $site->sn_router }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN AP1 VT-601</label>
                            <input type="text" name="sn_ap1" id="sn_ap1" class="form-control" value="{{ $site->sn_ap1 }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN AP2 VT-601</label>
                            <input type="text" name="sn_ap2" id="sn_ap2" class="form-control" value="{{ $site->sn_ap2 }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN TRANSCEIVER</label>
                            <input type="text" name="sn_tranciever" id="sn_tranciever" class="form-control" value="{{ $site->sn_tranciever }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN STABILIZER</label>
                            <input type="text" name="sn_stabilizer" id="sn_stabilizer" class="form-control" value="{{ $site->sn_stabilizer }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>SN RAK</label>
                            <input type="text" name="sn_rak" id="sn_rak" class="form-control" value="{{ $site->sn_rak }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>IP MODEM</label>
                            <input type="text" name="ip_modem" id="ip_modem" class="form-control" value="{{ $site->ip_modem }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>IP ROUTER</label>
                            <input type="text" name="ip_router" id="ip_router" class="form-control" value="{{ $site->ip_router }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>IP AP 1</label>
                            <input type="text" name="ip_ap1" id="ip_ap1" class="form-control" value="{{ $site->ip_ap1 }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>IP AP 2</label>
                            <input type="text" name="ip_ap2" id="ip_ap2" class="form-control" value="{{ $site->ip_ap2 }}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>EXPECTED SQF</label>
                            <input type="text" name="expected_sqf" id="expected_sqf" class="form-control" value="{{ $site->expected_sqf }}">
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

@section('scripts')
<script>
$(document).ready(function() {
    // Preselect the option if $site is set
    @if(isset($site))
        var selectedSite = {
            id: '{{ $site->sitename }}',
            text: '{{ $site->sitename }}'
        };
        var newOption = new Option(selectedSite.text, selectedSite.id, true, true);
        $('.site-name').append(newOption).trigger('change');
    @endif
});
</script>

@endsection
