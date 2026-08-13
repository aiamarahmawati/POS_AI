@extends('layouts.app')

@section('title', 'Detail Transaksi #' . $sale->id)

@include('layouts.navbar')

@section('content')
<div class="container mt-4 detail-invoice-container">
    
    <!-- Bagian Tombol Aksi Atas -->
        <!-- Bagian Tombol Aksi Atas (Hanya teks Kembali tanpa ikon panah) -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Tombol Kembali Bersih Tanpa Ikon -->
        <a href="{{ route('penjualan.index') }}" class="btn px-3 py-2 rounded-3 d-flex align-items-center btn-invoice-back">
            Kembali
        </a>

        <!-- Tombol Cetak Struk (Tetap sama menggunakan ikon) -->
        <button class="btn btn-primary btn-sm px-3 py-2 rounded-3 d-flex align-items-center gap-2 shadow-sm btn-invoice-print" onclick="window.print()">
            <svg xmlns="http://w3.org" width="14" height="14" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
            </svg>
            Cetak Struk
        </button>
    </div>


    <!-- Kotak Nota Transaksi -->
    <div class="card shadow-sm">
        <div class="card-body invoice-receipt-body">
            <h4 class="text-center mb-1"><strong>DETAIL PENJUALAN</strong></h4>
            <p class="text-center text-muted small">ID Transaksi: #{{ $sale->id }}</p>
            <div class="invoice-dashed-line"></div>

            <div class="row small mb-2">
                <div class="col-6">Tanggal: {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</div>
                <div class="col-6 text-end">Kasir: {{ $sale->user->name }}</div>
            </div>
            <div class="row small mb-3">
                <div class="col-6">Metode: <strong>{{ $sale->metode_pembayaran }}</strong></div>
                <div class="col-6 text-end">Status: <span class="badge bg-success">{{ $sale->status }}</span></div>
            </div>

            <div class="invoice-dashed-line"></div>
            <h6><strong>Daftar Item:</strong></h6>
            
            <table class="table table-sm table-borderless table-invoice-items">
                <thead>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->itemPenjualan as $item)
                    <tr>
                        <td>{{ $item->produk?->nama_produk ?? $item->produk?->nama ?? $item->produk?->nama_barang ?? 'Produk' }}</td>
                        <td class="text-center">{{ $item->kuantitas ?? $item->qty }}</td>
                        <td class="text-end">Rp {{ number_format($item->subtotal) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="invoice-dashed-line"></div>
            <div class="d-flex justify-content-between mt-2">
                <h5><strong>TOTAL BAYAR:</strong></h5>
                <h5 class="text-primary"><strong>Rp {{ number_format($sale->total_pembayaran) }}</strong></h5>
            </div>
        </div>
    </div>
</div>
@endsection