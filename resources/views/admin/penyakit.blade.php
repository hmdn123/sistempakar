@extends('admin.layout.main', ['title' => 'Penyakit'])

@section('main')
    <div class="page-heading">
        <h3>Penyakit dan Solusi</h3>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Tambahkan Penyakit Dan Solusi</h5>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                Penyakit</button>
        </div>

        {{-- modal tambah data --}}
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ url('penyakit') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah penyakit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="penyakit-form" class="form-label">penyakit</label>
                                    <input class="form-control" name="penyakit" placeholder="Masukan penyakit"
                                        id="penyakit-form">
                                </div>
                                <div id="emailHelp" class="form-text mb-3">Kode akan secara otomatis tergenerate</div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Solusi Pengobatan</label>
                                    <textarea class="form-control" name="solusi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End modal tambah --}}

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Penyakit</th>
                        <th scope="col">Solusi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($penyakits->isNotEmpty())
                        @foreach ($penyakits as $penyakit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penyakit->kode }}</td>
                                <td>{{ Str::title($penyakit->penyakit) }}</td>
                                <td>{{ str::limit($penyakit->solusi, 50, '...') }}</td>
                                <td class="d-flex gap-2">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $penyakit->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $penyakit->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            {{-- modal edit penyakit --}}
                            <div class="modal fade" id="edit{{ $penyakit->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ url('penyakit/' . $penyakit->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Penyakit</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <div class="mb-3">
                                                        <label for="penyakit-form" class="form-label">Penyakit</label>
                                                        <input class="form-control" name="penyakit"
                                                            value="{{ Str::title($penyakit->penyakit) }}"
                                                            placeholder="Masukan penyakit" id="penyakit-form">
                                                    </div>
                                                    <div id="emailHelp" class="form-text mb-3">Kode akan secara otomatis
                                                        tergenerate
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Solusi
                                                            Pengobatan</label>
                                                        <textarea class="form-control" name="solusi" id="exampleFormControlTextarea1" rows="3">{{ $penyakit->solusi }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- end modal edit penyakit --}}

                            <!-- Modal delete -->
                            <div class="modal fade" id="delete{{ $penyakit->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close m-2 ms-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="modal-body">
                                            <h1 class="text-center fw-bold">DELETE</h1>
                                            <h4 class="text-center mb-3">Yakin data akan dihapus?</h4>
                                            <form action="{{ url('penyakit/' . $penyakit->id) }}" method="POST">
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
                        <td colspan="5" class="text-center">Tidak ada data tersedia</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
