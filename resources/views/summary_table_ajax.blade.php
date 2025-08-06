<div class="table-responsive">
    <table class="table table-bordered table-sm align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>SITE ID</th>
                <th>NAMA SITE</th>
                <th>PROVINSI</th>
                <th>KABUPATEN</th>
                <th>MONTH</th>
                <th>DATE</th>
                <th>Status</th>
                <th>KATEGORI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filteredData as $i => $item)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration + ($filteredData->firstItem() - 1) }}
                    </td>
                    <td>{{ $item->site_id }}</td>
                    <td class="text-start">{{ $item->nama_lokasi }}</td>
                    <td class="text-start">{{ $item->provinsi }}</td>
                    <td class="text-start">{{ $item->kabupaten_kota }}</td>
                    <td>{{ $item->month }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->kategori }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer bg-white py-2">
        <div class="d-flex justify-content-center">
            {!! $filteredData->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
