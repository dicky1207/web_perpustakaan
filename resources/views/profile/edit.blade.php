@extends('layouts.grim.index', ['title' => 'Edit Profile', 'section_header' => 'Edit Profile'])

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="card">
  <div class="card-header">
    <h4>Edit Profile</h4>
  </div>
  <div class="card-body">
    <form action="{{ route($updateRoute) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap..." required>
            @error('name')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email..." required>
            @error('email')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label for="address">Alamat Lengkap</label>
            <textarea class="form-control" name="address" id="address" placeholder="Masukkan alamat lengkap..." style="height: 100px;">{{ old('address', $user->address) }}</textarea>
            @error('address')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <h5>Ubah Password</h5>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="current_password">Password Lama</label>
            <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Masukkan password lama...">
            @error('current_password')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password baru...">
            @error('password')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password baru...">
            @error('password_confirmation')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="image">Foto Profil</label>
            <div class="custom-file">
              <input type="file" name="image" class="custom-file-input" id="image" accept="image/*">
              <label class="custom-file-label" for="image">Pilih file...</label>
            </div>
            @error('image')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="col-lg-6">
          <div class="text-center">
            <img src="{{ $user->image ? asset($user->image) : asset('assets/img/avatar/avatar-1.png') }}" class="img img-thumbnail shadow" alt="Current Image" id="image_preview" height="100" width="100">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <button type="submit" class="btn btn-primary">Update Profile</button>
          <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('js')
<script>
  // Image preview
  document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('image_preview').src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  // Custom file label
  document.getElementById('image').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'Pilih file..';
    document.querySelector('.custom-file-label').textContent = fileName;
  });
</script>
@endpush
