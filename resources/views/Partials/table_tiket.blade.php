@foreach ($tiket as $index => $item)
<tr>
    <td class="text-center">{{ $tiket->firstItem() + $index }}</td>
    <td>{{ $item->site_id }}</td>
    <td>{{ $item->nama_site }}</td>
    <td>{{ $item->provinsi }}</td>
    <td>{{ $item->kabupaten }}</td>
    <td class="text-center">{{ $item->durasi_akhir ?? 0 }} Hari</td>
    <td class="text-center">{{ $item->kategori }}</td>
    <td class="text-center">{{ $item->tanggal_rekap }}</td>
    <td class="text-center">{{ $item->bulan_open }}</td>
    <td class="text-center">{{ $item->status_tiket }}</td>
    <td>{{ $item->kendala }}</td>
    <td class="text-center">{{ $item->tanggal_close }}</td>
    <td class="text-center">{{ $item->bulan_close }}</td>
    <td>{{ $item->detail_problem }}</td>
    <td>{{ $item->plan_actions }}</td>
    <td>{{ $item->ce }}</td>
    <td class="d-flex gap-2">
        <a href="#" class="btn btn-primary action-btn" data-toggle="modal" onclick="openEditModal({{ $item->id }})">
                                        <i class="fa fa-edit"></i>
                                    </a>
        <a href="#" class="btn btn-info mr-3 mb-3 btn-delete" data-id="{{ $item->id }}" data-url="{{ route('tiket.delete', ['id' => $item->id]) }}">
            <i class="fa fa-trash"></i> Delete
        </a>
        <a href="#" class="btn btn-primary mr-3 mb-3" data-toggle="modal" onclick="openEditModal({{ $item->id }})">
            <i class="fa fa-info-circle"></i> Detail
        </a>
    </td>
</tr>
@endforeach