@extends('layouts.app')

@section('main')
    <div class="container">
        <section class="bg-white shadow kotak-login m-5 p-5">
            <div class="container-fluid ">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                            class="img-fluid rounded" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <form method="POST" action="{{ url('login') }}">
                            @csrf
                            <div class="text-center text-lg-start pt-2">
                                <h1 class="mb-5 fw-bold">Login Sistem Pakar Penyakit Bawang</h1>
                            </div>
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p><strong>Login gagal</strong>, silahkan masukan email dan password yang benar</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example3">Email
                                </label>
                                <input type="email" id="form3Example3"
                                    class="form-control form-control @if (session()->has('error')) is-invalid @endif"
                                    placeholder="Enter a valid email address" required name="email"
                                    value="{{ old('email') }}" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form3Example4">Password</label>
                                <input type="password" id="form3Example4" class="form-control form-control"
                                    placeholder="Enter password" required name="password" />
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
