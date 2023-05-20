@php
    use App\Models\Penyakit;
@endphp

@extends('admin.layout.main', ['title' => 'Indikator'])

@section('main')
    <div class="page-heading">
        <h3>Data Pengguna</h3>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Data Pengguna</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomor</th>
                            <th>Luas Lahan</th>
                            <th>Indikator</th>
                            <th>Penyakit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data_users->isNotEmpty())
                            @foreach ($data_users as $data)
                                <tr>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->nomor }}</td>
                                    <td>{{ $data->luas_lahan }}</td>
                                    <td>{{ $data->kode_indikator }}</td>
                                    <td>
                                        @php
                                            $penyakitData = Penyakit::whereIn('kode', json_decode($data->kode_penyakit, true))->get();
                                        @endphp

                                        @if ($penyakitData->isEmpty())
                                            (Tidak Ditemukan)
                                        @else
                                            @foreach ($penyakitData as $penyakit)
                                                {{ $penyakit->penyakit }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td><button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $data->id }}">Hapus</button>
                                    </td>
                                </tr>

                                <!-- Modal delete -->
                                <div class="modal fade" id="delete{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <button type="button" class="btn-close m-2 ms-auto" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="modal-body">
                                                <h1 class="text-center fw-bold">DELETE</h1>
                                                <h4 class="text-center mb-3">Yakin data akan dihapus?</h4>
                                                <form action="{{ url('data-pengguna/' . $data->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <div class="d-grid gap-2 col-4 mx-auto d-flex">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fa-solid fa-trash text-white me-1"></i>Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end delete model --}}
                            @endforeach
                        @else
                            <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
