<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>NO</th>
            <th>ID SITE</th>
            <th>SITE NAME</th>
            <th>PROVINSI</th>
            <th>KABUPATEN</th>
            <th>CE</th>
            <th>HOMEBASE</th>
            <th>PLAN PM</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($site as $index => $item)
        <tr>
            <td>{{ $site->firstItem() + $index }}</td>
            <td>{{ $item->idsite }}</td>
            <td>{{ $item->sitename }}</td>
            <td>{{ $item->provinsi }}</td>
            <td>{{ $item->kab }}</td>
            <td>{{ $item->CE }}</td>
            <td>{{ $item->homebase }}</td>
            <td>{{ $item->planpm }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $site->withQueryString()->links() }}
</div>
