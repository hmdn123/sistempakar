@php
    use App\Models\Penyakit;
    
    header('Content-type: application/vnd-ms-excel');
    header('Content-Disposition: attachment; filename=Penyakit.xls');
@endphp

<div class="page-heading">
    <h3>Penyakit Sistem Pakar</h3>
</div>
<div class="card-body">
    <table class="table-bordered table" border="1">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Penyakit</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Penyakit::all() as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->penyakit }}</td>
            @endforeach
        </tbody>
    </table>
</div>
