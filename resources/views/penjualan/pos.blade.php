@extends('layouts.app')

@section('title', 'POS')

@section('content')
<!-- 1. PEMBUNGKUS BARU: Menyelaraskan seluruh halaman di posisi tengah yang seimbang -->
<div class="pos-container">

    @if(session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif

    <!-- 2. KOTAK CARD UTAMA: Membuat wadah putih bertingkat dengan bayangan halus -->
    <div class="pos-card-main">
        
        <!-- 3. KEPALA KOTAK BARU: Menyulap judul halaman masuk ke baris atas kardus yang rapi -->
        <div class="pos-card-header">
            <h4>{{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}</h4>
        </div>

        <!-- ISI TRANSAKSI KASIR -->
        <div class="card-body">
            <div class="row">
                
                {{-- ================= PRODUK (SISI KIRI) ================= --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="Cari produk..."
                                   onkeyup="this.form.submit()">
                        </form>
                    </div>
                    
                    <!-- 4. PEMBATAS SCROLLBAR: Membaca kelas baru Anda untuk membatasi tinggi katalog produk -->
                    <div class="pos-catalog-scroll">
                        @foreach($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="col-7">
                                    <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                        <div class="d-flex align-items-center gap-2">

                                            {{-- Gambar produk --}}
                                            <img src="{{ asset('storage/'.$product->foto) }}" 
                                                alt="Gambar"
                                                class="rounded-circle"
                                                style="width:45px; height:45px; object-fit:cover;">

                                            {{-- Nama & harga --}}
                                            <div>
                                                <div class="fw-semibold">{{ $product->nama }}</div>
                                                <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div class="col-3">
                                    <input type="number" name="quantity" value="1" min="1"
                                            class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                                </div>

                                <div class="col-2">
                                    <button class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                        +</button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>

                {{-- ================= KERANJANG (SISI KANAN) ================= --}}
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sale->itemPenjualan as $item)
                                <tr>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>Rp.{{ number_format($item->produk->harga_jual) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf @method('PUT')
                                            <input type="number" name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   class="form-control form-control-sm">
                                        </form>
                                    </td>
                                    <td>Rp {{ number_format($item->subtotal) }}</td>
                                    <td>
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Keranjang kosong
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- 5. AREA FOOTER: Total pembayaran, metode bayar, dan tombol aksi -->
                    <div class="card-footer mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted fw-bold" style="font-size: 14px;">TOTAL HARGA:</span>
                            <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>
                        </div>

                        <form method="POST" 
                                action="{{ route('penjualan.update', $sale->id) }}" 
                                onsubmit="return confirm('Yakin ingin chekout')" class="mt-2">
                            @csrf
                            @method('PUT')
                            <select name="payment_method" class="form-select mb-2">
                                <option value="">Pilih Pembayaran</option>
                                <option value="CASH">Cash</option>
                                <option value="QRIS">QRIS</option>
                            </select>

                            <button class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                Checkout
                            </button>
                        </form>
                        
                        @can('delete', $sale)
                        <form action="{{ route('penjualan.destroy', $sale->id) }}" 
                              method="POST"
                              onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-outline-danger w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                Batal Transaksi
                              </button>
                        </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>

    </div> <!-- Akhir dari pos-card-main -->

</div> <!-- Akhir dari pos-container -->
@endsection
