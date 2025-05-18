@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Iniciar Sesión</h3>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Recuérdame</label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif

                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
