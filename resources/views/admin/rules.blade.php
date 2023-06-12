@php
    use App\Models\Penyakit;
    use App\Models\Indikator;
    use App\Models\Aturan;
@endphp
@extends('admin.layout.main', ['title' => 'Aturan'])

@section('main')
    <div class="page-heading d-flex justify-content-between">
        <h3>Masukan Aturan</h3>
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambahkan Aturan
            Penyakit</button>

        {{-- modal tambah data --}}
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ url('input-rules') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Aturan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="penyakit-select" class="form-label">Penyakit</label>
                                    <select class="form-select mb-2" aria-label="Default select example"
                                        name="kode_penyakit">
                                        @if (Aturan::all()->isNotEmpty())
                                            @foreach (Penyakit::all() as $penyakit)
                                                <option value="{{ $penyakit->kode }}">
                                                    {{ Str::title($penyakit->penyakit) }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach (Penyakit::all() as $penyakit)
                                                <option value="{{ $penyakit->kode }}">{{ Str::title($penyakit->penyakit) }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="indikator-select" class="form-label">Indikator</label>
                                    <select class="form-select" aria-label="Default select example" name="kode_indikator">
                                        @foreach (Indikator::all() as $indikator)
                                            <option value="{{ $indikator->kode }}">
                                                {{ Str::title($indikator->indikator) }}</option>
                                        @endforeach
                                    </select>
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

    </div>
    <!-- resources/views/error.blade.php -->

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data sudah tersedia,</strong> silahkan coba dengan yang lain
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Aturan::all()->isNotEmpty())
        @foreach (Aturan::distinct()->get('kode_penyakit') as $aturan)
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ Str::title($aturan->penyakit->penyakit) }}</h4>
                    <button class="btn btn-sm btn-primary ps-2 pe-2" type="button" data-bs-toggle="modal"
                        data-bs-target="#tambahaturan{{ $aturan->kode_penyakit }}">+</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach (Aturan::where('kode_penyakit', $aturan->kode_penyakit)->get() as $indikator)
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card bg-primary">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-3 d-flex justify-content-center ">
                                                <button class="btn-warning btn" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $indikator->id }}"><i
                                                        class="iconly bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <div class="col d-flex align-item-center mt-2">
                                                <h6 class="text-white text-center">
                                                    {{ Str::title($indikator->indikator->indikator) }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- modal delete data di aturan --}}
                            <div class="modal fade" id="delete{{ $indikator->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close m-2 ms-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="modal-body">
                                            <h1 class="text-center fw-bold">DELETE</h1>
                                            <h4 class="text-center mb-3">Yakin data akan dihapus?</h4>
                                            <form action="{{ url('input-rules/' . $indikator->id) }}" method="POST">
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
                            {{-- End modal tambah --}}
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- modal tambah data di aturan --}}
            <div class="modal fade" id="tambahaturan{{ $aturan->kode_penyakit }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ url('input-rules') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $aturan->penyakit->penyakit }}
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <input type="hidden" value="{{ $aturan->kode_penyakit }}" name="kode_penyakit">
                                        <select class="form-select" aria-label="Default select example"
                                            name="kode_indikator">
                                            @foreach (Indikator::all() as $indikator)
                                                @php
                                                    $existingCodes = Aturan::pluck('kode_indikator')->toArray();
                                                @endphp

                                                @if (!in_array($indikator->kode, $existingCodes))
                                                    <option value="{{ $indikator->kode }}">
                                                        {{ Str::title($indikator->indikator) }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
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
        @endforeach
    @else
        <div class="card">
            <div class="card-header text-center">
                <h4>Tidak ada konfigurasi tersedia</h4>
            </div>
        </div>
    @endif
@endsection
