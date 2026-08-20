@extends('layouts.app')

@section('title', 'Edit Jenis')

@section('content')
    <!-- Elemen pembungkus luar agar posisi form tepat berdiri di poros tengah layar monitor -->
    <div class="position-relative w-100" style="min-height: 80vh; padding-top: 40px;">

        <div class="position-absolute start-50 translate-middle-x w-100" style="max-width: 600px; padding: 0 16px;">

            <!-- Kotak Putih Minimalis Card -->
            <div class="card bg-white"
                style="background-color: #FFFFFF !important; border: 1px solid #E2E8F0 !important; border-radius: 12px !important; box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02) !important; overflow: hidden;">

                <!-- Header Card -->
                <div class="card-header"
                    style="background-color: #F8FAFC !important; border-bottom: 1px solid #E2E8F0 !important; padding: 16px 20px !important;">
                    <h1
                        style="font-size: 14px !important; font-weight: 700 !important; color: #1E293B !important; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 !important;">
                        Edit Jenis</h1>
                </div>

                <!-- Body Card -->
                <div class="card-body" style="padding: 24px 20px;">
                    <!-- SOLUSI AMAN: Memaksa Laravel membaca parameter 'jeni' secara manual menggunakan array data id -->
                    <form action="{{ route('jenis.update', $jenis) }}" method="POST">
                        @method('PUT')
                        @include('jenis._form')
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
