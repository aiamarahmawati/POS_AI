<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten  -->
@section('content')

<!-- KODE TAMBAHAN: Membuka kelas pengunci khusus halaman login -->
<div class="login-page-wrapper">

    <!-- 1. MODIFIKASI STRUKTUR: Menghapus text-center agar input rata kiri rapi, dan menaikkan max-width ke 400px agar proporsional -->
    <div class="card position-absolute top-50 start-50 translate-middle w-100" style="max-width: 400px; padding: 0 12px;">
      
      <!-- PERBAIKAN TEKS: Judul Utama dengan Kalimat Pendukung di bawahnya -->
      <div class="card-header text-center py-4">
         <h1 class="mb-1">LOGIN POS</h1>
         <small class="text-muted" style="font-size: 13px; display: block; margin-top: 5px;">Silakan masuk untuk mulai bertransaksi</small>
      </div>
      
      <div class="card-body" style="padding: 24px 20px;">
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            
            <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                <!-- DITAMBAHKAN placeholder="Masukkan alamat email..." -->
                <input type="email" name="email" class="form-control" 
                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan alamat email...">
                @error('email')
                    <!-- Mempercantik tampilan teks eror agar tipis dan rapi di bawah kotak input -->
                    <div class="text-danger-custom mt-1" style="font-size: 13px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4 text-start">
                <label for="exampleInputPassword1" class="form-label">Kata Sandi</label>
                <!-- DITAMBAHKAN placeholder="Masukkan kata sandi..." -->
                <input type="password" name="password" class="form-control" 
                id="exampleInputPassword1" placeholder="Masukkan kata sandi...">
                @error('password')
                    <div class="text-danger-custom mt-1" style="font-size: 13px;">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- 2. TOMBOL AKSI: Menggunakan class btn-submit agar otomatis berwarna Hitam Slate -->
            <button type="submit" class="btn-submit w-100 text-center justify-content-center">Masuk ke Sistem</button>
        </form>
      </div>
    </div>

</div>
<!-- KODE TAMBAHAN: Menutup kelas pengunci khusus halaman login -->

<!-- batas akhir isi konten  -->
@endsection
