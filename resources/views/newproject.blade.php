@extends('layouts.user_type.auth')

@section('content')

<style>
body {
    background: linear-gradient(to bottom right, rgb(209,215,231), rgb(134,173,229));
}
table th, table td {
    font-size: 12px;
    white-space: nowrap;
}
</style>

<div class="container-fluid">

    {{-- BUTTON TAMBAH CARD --}}
    @if(in_array($role, ['admin','superadmin']))
    <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahCard">
        <i class="fa fa-plus"></i> Tambah Card
    </button>
    @endif

    {{-- LOOP CARD --}}
    @foreach($cards as $card)
    <div class="card mb-4 shadow">

        {{-- HEADER CARD --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <strong>{{ $card->title }}</strong>

            <div>
                <button class="btn btn-light btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahData"
                    onclick="setCard({{ $card->id }})">
                    <i class="fa fa-plus"></i>
                </button>

                @if(in_array($role, ['admin','superadmin']))
                <button class="btn btn-danger btn-sm" onclick="hapusCard({{ $card->id }})">
                    <i class="fa fa-trash"></i>
                </button>
                @endif
            </div>
        </div>

        {{-- TABLE --}}
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-sm">
                <thead class="table-dark text-center">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Site ID</th>
                        <th>Site Name</th>
                        <th>Tipe</th>
                        <th>Batch</th>
                        <th>Provinsi</th>
                        <th>Kab</th>
                        <th>Kecamatan</th>
                        <th>Gateway</th>
                        <th>Beam</th>
                        <th>Hub</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($card->newprojects as $i => $p)
                    <tr class="text-center">
                        <td>{{ $i+1 }}</td>
                        <td>{{ $p->site_id }}</td>
                        <td>{{ $p->sitename }}</td>
                        <td>{{ $p->tipe }}</td>
                        <td>{{ $p->batch }}</td>
                        <td>{{ $p->provinsi }}</td>
                        <td>{{ $p->kab }}</td>
                        <td>{{ $p->kecamatan }}</td>
                        <td>{{ $p->gateway_area }}</td>
                        <td>{{ $p->beam }}</td>
                        <td>{{ $p->hub }}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm" onclick="editData({{ $p->id }})">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-info btn-sm" onclick="detail({{ $p->id }})">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="hapusData({{ $p->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
    @endforeach
</div>

{{-- ================= MODAL TAMBAH CARD ================= --}}
<div class="modal fade" id="modalTambahCard">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('cards.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5>Tambah Card</h5>
                </div>
                <div class="modal-body">
                    <input name="title" class="form-control" placeholder="Nama Card" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= MODAL TAMBAH DATA ================= --}}
<div class="modal fade" id="modalTambahData">
    <div class="modal-dialog modal-xl">
        <form method="POST" action="{{ route('newproject.store') }}">
            @csrf
            <input type="hidden" name="card_id" id="card_id">

            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5>Tambah New Project</h5>
                </div>

                <div class="modal-body row g-2">
                    @foreach([
                        'site_id','sitename','tipe','batch','latitude','longitude',
                        'provinsi','kab','kecamatan','kelurahan','alamat_lokasi',
                        'nama_pic','nomor_pic','sumber_listrik','gateway_area',
                        'beam','hub','kodefikasi','sn_antena','sn_modem','sn_router',
                        'sn_ap1','sn_ap2','sn_tranciever','sn_stabilizer','sn_rak',
                        'ip_modem','ip_router','ip_ap1','ip_ap2','expected_sqf'
                    ] as $field)
                    <div class="col-md-4">
                        <label class="fw-bold">{{ str_replace('_',' ',$field) }}</label>
                        <input name="{{ $field }}" class="form-control">
                    </div>
                    @endforeach
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= MODAL EDIT DATA ================= --}}
<div class="modal fade" id="modalEditData">
    <div class="modal-dialog modal-xl">
        <form method="POST" id="formEdit">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5>Edit New Project</h5>
                </div>

                <div class="modal-body row g-2" id="editBody"></div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= MODAL DETAIL ================= --}}
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5>Detail New Project</h5>
            </div>
            <div class="modal-body row g-2" id="detailBody"></div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function setCard(id){
    document.getElementById('card_id').value = id;
}

function hapusData(id){
    if(confirm('Hapus data ini?')){
        fetch(`/newproject/delete/${id}`,{
            method:'DELETE',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
        }).then(()=>location.reload());
    }
}

function hapusCard(id){
    if(confirm('Hapus CARD ini beserta isinya?')){
        fetch(`/cards/delete/${id}`,{
            method:'DELETE',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
        }).then(()=>location.reload());
    }
}

function detail(id){
    fetch(`/newproject/${id}`)
    .then(res=>res.json())
    .then(res=>{
        let html='';
        Object.entries(res.data).forEach(([k,v])=>{
            html+=`
            <div class="col-md-4">
                <label class="fw-bold">${k.replaceAll('_',' ')}</label>
                <input class="form-control" value="${v ?? ''}" disabled>
            </div>`;
        });
        document.getElementById('detailBody').innerHTML = html;
        new bootstrap.Modal(document.getElementById('modalDetail')).show();
    });
}

function editData(id){
    fetch(`/newproject/${id}`)
    .then(res=>res.json())
    .then(res=>{
        let html='';
        Object.entries(res.data).forEach(([k,v])=>{
            if(['id','card_id'].includes(k)) return;
            html+=`
            <div class="col-md-4">
                <label class="fw-bold">${k.replaceAll('_',' ')}</label>
                <input name="${k}" class="form-control" value="${v ?? ''}">
            </div>`;
        });
        document.getElementById('editBody').innerHTML = html;
        document.getElementById('formEdit').action = `/newproject/update/${id}`;
        new bootstrap.Modal(document.getElementById('modalEditData')).show();
    });
}
function hapusCard(id){
    if(confirm('Hapus CARD ini beserta isinya?')){
        fetch(`/cards/delete/${id}`,{
            method:'DELETE',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            }
        }).then(res=>res.json())
          .then(()=>location.reload());
    }
}
</script>
@endsection
