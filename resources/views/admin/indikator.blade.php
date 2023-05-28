@extends('admin.layout.main', ['title' => 'Indikator'])

@section('main')
    <div class="page-heading">
        <h3>Indikator</h3>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Tambahkan Indikator</h5>
            <div class="dropdown">
                <div>
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Export
                    </button>
                    <ul class="dropdown-menu border">
                        <li><a class="dropdown-item" href="export-indikator-pdf">Export PDF</a></li>
                        <li><a class="dropdown-item" href="export-indikator-excel">Export Excel</a></li>
                    </ul>
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#tambah">+</button>
                </div>
            </div>
        </div>

        {{-- modal tambah data --}}
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ url('indikator') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Indikator</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="indikator-form" class="form-label">Indikator</label>
                                    <input class="form-control" name="indikator" placeholder="Masukan Indikator"
                                        id="indikator-form">
                                </div>
                                <div id="emailHelp" class="form-text">Kode akan secara otomatis tergenerate</div>
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
            <div class="mb-3">
                <input type="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Pencarian...">
            </div>
            <div class="table-responsive">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Indikator</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($indikators->isNotEmpty())
                            @foreach ($indikators as $indikator)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $indikator->kode }}</td>
                                    <td>{{ Str::title($indikator->indikator) }}</td>
                                    <td class="d-flex gap-2">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $indikator->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $indikator->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                {{-- modal edit indikator --}}
                                <div class="modal fade" id="edit{{ $indikator->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ url('indikator/' . $indikator->id) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Indikator
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <div class="mb-3">
                                                            <label for="indikator-form" class="form-label">Indikator</label>
                                                            <input class="form-control" name="indikator"
                                                                value="{{ Str::title($indikator->indikator) }}"
                                                                placeholder="Masukan Indikator" id="indikator-form">
                                                        </div>
                                                        <div id="emailHelp" class="form-text">Kode akan secara otomatis
                                                            tergenerate
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
                                {{-- end modal edit indikator --}}

                                <!-- Modal delete -->
                                <div class="modal fade" id="delete{{ $indikator->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <button type="button" class="btn-close m-2 ms-auto" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="modal-body">
                                                <h1 class="text-center fw-bold">DELETE</h1>
                                                <h4 class="text-center mb-3">Yakin data akan dihapus?</h4>
                                                <form action="{{ url('indikator/' . $indikator->id) }}" method="POST">
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
                            <td colspan="4" class="text-center">Tidak ada data tersedia</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");

                for (var j = 0; j < td.length; j++) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
