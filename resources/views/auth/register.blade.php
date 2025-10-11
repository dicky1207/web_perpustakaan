@extends('layouts.auth.index')

@section('content')

<body>
  <div id="app">
      <section class="section d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); position: relative; overflow: hidden;">
      <div class="background-animation" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%), radial-gradient(circle at 40% 40%, rgba(120, 219, 226, 0.3) 0%, transparent 50%); animation: float 20s ease-in-out infinite;"></div>
      <div class="container" style="position: relative; z-index: 1;">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-7 col-12">
            <div class="text-center mb-4" style="margin-top: 50px;">
              <div class="logo-container mb-3" style="display: inline-block; padding: 15px; background: rgba(255,255,255,0.1); border-radius: 50%; backdrop-filter: blur(10px);">
                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                  <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <h6 class="text-white font-weight-bold mb-2" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Aplikasi Peminjaman Buku Perpustakaan</h6>
            </div>
            <div class="card shadow-lg border-0" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); border-radius: 25px;">
              <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group mb-2">
                    <label for="name" class="text-dark font-weight-bold mb-2" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Nama</label>
                    <div class="input-container" style="position: relative;">
                      <i class="fas fa-user input-icon" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 1;"></i>
                    <input id="name" type="text" class="form-control border-0 rounded-pill shadow-sm pl-5 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan nama Anda" style="background: #f8f9fa; padding-left: 45px; transition: all 0.3s ease;">
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group mb-2">
                    <label for="email" class="text-dark font-weight-bold mb-2" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Email</label>
                    <div class="input-container" style="position: relative;">
                      <i class="fas fa-envelope input-icon" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 1;"></i>
                    <input id="email" type="email" class="form-control border-0 rounded-pill shadow-sm pl-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan email Anda" style="background: #f8f9fa; padding-left: 45px; transition: all 0.3s ease;">
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group mb-2">
                    <label for="password" class="text-dark font-weight-bold mb-2" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Password</label>
                    <div class="input-container" style="position: relative;">
                      <i class="fas fa-lock input-icon" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 1;"></i>
                      <i class="fas fa-eye toggle-icon" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; cursor: pointer; z-index: 1;" onclick="togglePassword('password')"></i>
                    <input id="password" type="password" class="form-control border-0 rounded-pill shadow-sm pl-5 pr-5 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan password Anda" style="background: #f8f9fa; padding-left: 45px; padding-right: 45px; transition: all 0.3s ease;">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group mb-2">
                    <label for="password-confirm" class="text-dark font-weight-bold mb-2" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Konfirmasi Password</label>
                    <div class="input-container" style="position: relative;">
                      <i class="fas fa-lock input-icon" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 1;"></i>
                      <i class="fas fa-eye toggle-icon" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; cursor: pointer; z-index: 1;" onclick="togglePassword('password-confirm')"></i>
                      <input id="password-confirm" type="password" class="form-control border-0 rounded-pill shadow-sm pl-5 pr-5" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password Anda" style="background: #f8f9fa; padding-left: 45px; padding-right: 45px; transition: all 0.3s ease;">
                    </div>
                  </div>

                  <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold shadow-lg" style="margin-top: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border:none; padding: 12px; font-size: 16px; transition: all 0.3s ease; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                      {{ __('Daftar') }}
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4">
                  <p class="text-muted mb-0" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-weight-bold">Masuk di sini</a></p>
                </div>
              </div>
            </div>
            <div class="text-center mt-4">
              <small class="text-white-50" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">&copy; {{ date('Y') }} All Rights Reserved</small>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      33% { transform: translateY(-10px) rotate(1deg); }
      66% { transform: translateY(10px) rotate(-1deg); }
    }

    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
      background: rgba(255,255,255,1) !important;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
  </style>

  <script>
    function togglePassword(id) {
      var input = document.getElementById(id);
      var icon = input.parentElement.querySelector('.toggle-icon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>
  @endsection
