@extends('layouts.app')

@section('title', 'Tambah Jenis')

@section('content')
<!-- Elemen pembungkus luar agar posisi form tepat berdiri di poros tengah layar monitor -->
<div class="position-relative w-100" style="min-height: 80vh; padding-top: 40px;">
    
    <div class="position-absolute start-50 translate-middle-x w-100" style="max-width: 600px; padding: 0 16px;">
        
        <!-- Kotak Putih Minimalis Card (Otomatis mewarisi gaya putih solid dari app.css) -->
        <div class="card bg-white">
            
            <!-- Header Card (Otomatis menggunakan latar abu-abu premium) -->
            <div class="card-header">
                <h1 style="font-size: 15px; font-weight: 600; color: #1F2937; margin: 0; letter-spacing: -0.01em;">
                    Tambah Jenis Baru
                </h1>
            </div>

            <!-- Body Card -->
            <div class="card-body" style="padding: 24px 20px;">
                <form action="{{ route('jenis.store') }}" method="POST">
                    @include('jenis._form')
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
