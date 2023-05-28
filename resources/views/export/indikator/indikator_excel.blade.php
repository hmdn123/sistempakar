@php
    use App\Models\Indikator;
    
    header('Content-type: application/vnd-ms-excel');
    header('Content-Disposition: attachment; filename=Indikator.xls');
@endphp

<div class="page-heading">
    <h3>Indikator Sistem Pakar</h3>
</div>
<div class="card-body">
    <table class="table-bordered table" border="1">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Indikator</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Indikator::all() as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->indikator }}</td>
            @endforeach
        </tbody>
    </table>
</div>
