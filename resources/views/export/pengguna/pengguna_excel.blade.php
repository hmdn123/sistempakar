@php
    use App\Models\Penyakit;
    use App\Models\DataPengguna;
    
    header('Content-type: application/vnd-ms-excel');
    header('Content-Disposition: attachment; filename=Data Pengguna.xls');
@endphp

<div class="page-heading">
    <h3>Data Pengguna Sistem Pakar</h3>
</div>
<div class="card-body">
    <table class="table-bordered table" border="1">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor</th>
                <th scope="col">Luas Lahan</th>
                <th scope="col">Indikator</th>
                <th scope="col">Penyakit</th>
            </tr>
        </thead>
        <tbody>
            @foreach (DataPengguna::all() as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->nomor }}</td>
                    <td>{{ $item->luas_lahan }}</td>
                    <td>{{ $item->kode_indikator }}</td>
                    <td>
                        @php
                            $penyakitData = Penyakit::whereIn('kode', json_decode($item->kode_penyakit, true))->get();
                        @endphp

                        @if ($penyakitData->isEmpty())
                            (Tidak Ditemukan)
                        @else
                            @foreach ($penyakitData as $penyakit)
                                {{ $penyakit->penyakit }}
                            @endforeach
                        @endif
                    </td>
            @endforeach
        </tbody>
    </table>
</div>
