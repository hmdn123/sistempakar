@php
    use App\Models\Penyakit;
    use App\Models\Indikator;
    use App\Models\Aturan;
@endphp

@include('admin.layout.header', ['title' => 'Home'])
@include('layouts.navbar')
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="text-center">Lengkapi Informasi Dibawah Ini</h4>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide">
            <form action="{{ url('temukan-penyakit') }}" method="POST">
                @csrf
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat">
                            </div>
                            <div class="mb-3">
                                <label for="nomor" class="form-label">Nomor Telephon</label>
                                <input type="number" class="form-control" id="nomor" name="nomor">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Luas Lahan</label>
                                <input type="text" class="form-control" name="luas_lahan" placeholder="500m persegi">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <button class="btn btn-primary" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-body">
                        <p class="text-center">Pilihlah indikator dibawah ini</p>
                        <div class="container d-flex justify-content-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Penyakit</th>
                                        <th scope="col">Cheks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Indikator::all() as $indikator)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ Str::title($indikator->indikator) }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked" name="indikator[]"
                                                        value="{{ $indikator->kode }}">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-danger m-2" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                Sebelumnya
                            </button>
                            <button class="btn btn-primary m-2" type="submit">Temukan Penyakitnya<i
                                    class="bi bi-arrow-right ms-2"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<footer>
    <div class="footer clearfix mb-0 text-muted text-center">
        <p>Crafted with <span class="text-danger"></span> by <a href="https://polibangcreativestudio.my.id">Polibang
                Creative Studio</a></p>
    </div>
</footer>
@include('admin.layout.footer')
