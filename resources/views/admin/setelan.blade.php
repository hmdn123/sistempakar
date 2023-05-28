@extends('admin.layout.main', ['title' => 'Setelan Pengguna'])

@section('main')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 text-sm text-muted">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-3">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <x-button class="ms-4">
                        {{ __('Confirm') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
