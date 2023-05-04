@extends('admin.layout.main', ['title' => 'Aturan'])

@section('main')
    <div class="page-heading d-flex justify-content-between">
        <h3>Masukan Aturan</h3>
        <button class="btn btn-primary">Tambahkan Aturan Penyakit</button>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Nama Penyakit</h4>
        </div>
        <div class="card-body">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card bg-primary">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-3 d-flex justify-content-start ">
                                <button class="btn-warning btn"><i class="iconly bi bi-trash-fill"></i>
                                </button>
                            </div>
                            <div class="col d-flex alugn-item-center">
                                <h6 class="text-white">Jumlah Penyakit</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
