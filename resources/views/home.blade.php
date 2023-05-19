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
            <h4 class="text-center">Pilihlah Indikator Dibawah Ini</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('temukan-penyakit') }}" method="POST">
                @csrf
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
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                name="indikator[]" value="{{ $indikator->kode }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary mt-2" type="submit">Temukan Penyakitnya<i
                            class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </form>
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
