@php
    use App\Models\Aturan;
@endphp

@include('admin.layout.header', ['title' => 'Hasil Analisa'])
@include('layouts.navbar')

<div class="container">
    <div class="card">
        @if ($pesan != '')
            <div class="card-body">
                <p class="text-center">{{ $pesan }}</p>
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/') }}" class="text-center"><Button class="btn btn-primary"><i
                                class="bi bi-arrow-left me-2"></i>Kembali</Button></a>
                </div>
            </div>
        @else
            <div class="card-header">
                <h5 class="text-center">Berikut ini adalah kemungkinan penyakit yang menjangkit</h5>
            </div>
            <div class="card-body">
                @foreach ($results as $result)
                    <div class="accordion accordion-flush" id="accordionFlush">
                        <div class="accordion-item mt-3 border">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne{{ $result->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    {{ $result->penyakit }}
                                </button>
                            </h2>
                            <div id="flush-collapseOne{{ $result->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlush">
                                <div class="accordion-body">
                                    <h6>{{ $result->solusi }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<footer>
    <div class="footer clearfix mb-0 text-muted text-center">
        <p>Crafted with <span class="text-danger"></span> by <a href="https://polibangcreativestudio.my.id">Polibang
                Creative Studio</a></p>
    </div>
</footer>
@include('admin.layout.footer')
