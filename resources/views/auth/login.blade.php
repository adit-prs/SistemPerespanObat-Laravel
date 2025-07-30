@extends('layout.app')

@section('content')
    <div class="login-container">
        <div class="login-card">
            <!-- Header Section -->
            <div class="login-header">
                <div class="app-logo">
                    <i class="fas fa-prescription-bottle-alt"></i>
                </div>
                <h1 class="mb-2">MedScript</h1>
                <p class="mb-0">Sistem Peresepan Obat</p>
            </div>

            <!-- Login Form Body -->
            <div class="login-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $msg)
                                <li>{{ $msg }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login.post') }}">
                    <!-- Login Credentials Section -->
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email Address
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                                <label class="form-check-label" for="rememberMe">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="" class="forgot-password">Forgot Password?</a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>

                <!-- Security Notice -->
                <div class="text-center mt-4">
                    <p class="text-muted">
                        <i class="fas fa-shield-alt me-2"></i>
                        Platform layanan peresepan obat
                    </p>
                </div>

                <!-- Additional Links -->
                <div class="text-center mt-3">
                    <small class="text-muted">
                        Butuh bantuan? Hubungi <a href="mailto:test@test.com" class="forgot-password">Dukungan
                            Teknis</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
