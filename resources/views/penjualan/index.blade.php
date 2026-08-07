@extends('layouts.app')

@section('title', 'Penjualan')

@include('layouts.navbar')

@section('content')
<div class="container mt-4">

    @if(session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif

    <h1 class="mb-4">Penjualan</h1>

    <!-- 1. PEMBUNGKUS BARU: Menyelaraskan search dan tombol create agar sejajar kanan-kiri -->
    <div class="table-filter-action">
        <form action="{{ route('penjualan.index') }}" method="GET" class="search-wrapper">
            <input type="text" 
                   name="search" 
                   value="{{ request()->search }}" 
                   class="search-input"
                   placeholder="Search penjualan...">
            <button class="search-btn" type="submit">
                Search
            </button>
        </form>

        <a href="{{ route('penjualan.create') }}" class="btn-create-user">Create</a>
    </div>

    <!-- 2. STRUKTUR TABEL BARU: Menggunakan class custom-table agar otomatis putih bersih -->
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>Tanggal Transaksi</th>
                    <th>Kasir</th>
                    <th>Total Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th style="width: 250px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td>{{$sales->firstItem() + $loop->index}}</td>
                    <td>{{$sale->created_at->translatedFormat('d-m-Y H:i:s')}}</td>
                    <td>{{$sale->user->name}}</td>
                    <td class="fw-semibold">Rp {{number_format($sale->total_pembayaran)}}</td>
                    <td>{{$sale->metode_pembayaran}}</td>
                    <td>
                        <!-- 3. BADGE STATUS (10% AKSI): Memberikan warna dinamis pada status transaksi -->
                        @if($sale->status == 'COMPLETED')
                            <span class="badge-role kasir">COMPLETED</span>
                        @else
                            <span class="badge-role" style="background-color: #FEF3C7 !important; color: #D97706 !important;">{{ $sale->status }}</span>
                        @endif
                    </td>
                    <td>
                        <!-- 4. TOMBOL AKSI: Menggunakan kelas minimalis outline yang elegan tanpa simbol || -->
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <a href="" class="btn btn-action-edit py-1 px-2 lh-sm" style="font-size: 13px !important;">Detail</a>
                            
                            @can('view', $sale)
                                <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            
                            @can('delete', $sale)
                                <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-action-delete py-1 px-2 lh-sm" style="font-size: 13px !important;"
                                        onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                        Hapus
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <h4>Data Tidak Ditemukan</h4>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $sales->links() }}
    </div>
</div>
@endsection
