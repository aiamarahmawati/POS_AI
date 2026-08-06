@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<!-- Elemen pembungkus luar yang menduduki sisa area halaman secara penuh -->
<div class="position-relative w-100" style="min-height: 80vh; padding-top: 40px;">
    
    <!-- Trik CSS utama untuk memaksa kotak berdiri tepat di poros tengah layar -->
    <div class="position-absolute start-50 translate-middle-x w-100" style="max-width: 600px;">
        
        <!-- Kotak Putih Minimalis Card -->
        <div class="card bg-white" style="border: 1px solid #E5E7EB; border-radius: 8px; box-shadow: none;">
            
            <!-- Header Card -->
            <div class="card-header" style="background: #FAFAFB; border-bottom: 1px solid #E5E7EB; padding: 16px 20px;">
                <h1 style="font-size: 15px; font-weight: 600; color: #1F2937; margin: 0; letter-spacing: -0.01em;">
                    Tambah User Baru
                </h1>
            </div>

            <!-- Body Card -->
            <div class="card-body" style="padding: 24px 20px;">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @include('users._form')
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
