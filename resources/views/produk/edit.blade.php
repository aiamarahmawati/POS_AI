@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<!-- Elemen pembungkus luar agar posisi form tepat berdiri di poros tengah layar -->
<div class="position-relative w-100" style="min-height: 80vh; padding-top: 40px;">
    
    <div class="position-absolute start-50 translate-middle-x w-100" style="max-width: 600px; padding: 0 16px;">
        
        <!-- Kotak Putih Minimalis Card -->
        <div class="card bg-white">
            
            <!-- Header Card -->
            <div class="card-header">
                <h1>Edit Produk</h1>
            </div>

            <!-- Body Card -->
            <div class="card-body" style="padding: 24px 20px;">
                <form action="{{ route('produk.update', $produk) }}" 
                      method="POST"
                      enctype="multipart/form-data">
                     @method('PUT')
                    @include('produk._form')
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
