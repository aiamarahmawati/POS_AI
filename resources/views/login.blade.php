<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten  -->
@section('content')

<!-- 1. MODIFIKASI STRUKTUR: Menghapus text-center agar input rata kiri rapi, dan menaikkan max-width ke 400px agar proporsional -->
<div class="card position-absolute top-50 start-50 translate-middle w-100" style="max-width: 400px; padding: 0 12px;">
  
  <!-- Menggunakan class header card yang sudah otomatis terkunci putih premium di CSS kita -->
  <div class="card-header">
     <h1>Login POS</h1>
  </div>
  
  <div class="card-body" style="padding: 24px 20px;">
    <form action="{{ route('auth') }}" method="POST">
        @csrf
        
        <div class="mb-3 text-start"> <!-- Ditambah text-start agar label sejajar ke kiri -->
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" 
            id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('email')
                <!-- Mempercantik tampilan teks eror agar tipis dan rapi di bawah kotak input -->
                <div class="text-danger-custom mt-1" style="font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-4 text-start"> <!-- Jarak bawah password dibuat sedikit lebih longgar -->
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" 
            id="exampleInputPassword1">
            @error('password')
                <div class="text-danger-custom mt-1" style="font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- 2. TOMBOL AKSI: Menggunakan class btn-submit agar otomatis berwarna Ocean Blue -->
        <button type="submit" class="btn-submit w-100 text-center justify-content-center">Login</button>
    </form>
  </div>
</div>

<!-- batas akhir isi konten  -->
@endsection
