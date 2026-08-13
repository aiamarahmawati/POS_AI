@extends('layouts.app')

@section('title', 'Produk')

@include('layouts.navbar')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4">Produk</h1>

        <!-- 1. PEMBUNGKUS BARU: Menyelaraskan search dan tombol create agar sejajar kanan-kiri -->
        <div class="table-filter-action">
            <form action="{{ route('produk.index') }}" method="GET" class="search-wrapper">
                <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                    placeholder="Search nama produk..." autocomplete="off">
                <button class="search-btn" type="submit">
                    Search
                </button>
            </form>

            @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn-create-user">Create</a>
            @endcan
        </div>

        <!-- 2. STRUKTUR TABEL BARU: Menggunakan class custom-table agar putih bersih -->
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>User</th>
                        <th style="width: 80px;">Foto</th>
                        <th>Nama</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th style="width: 90px;">Stok</th>
                        <th style="width: 200px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $products->firstItem() + $loop->index }}</td>
                            <td>{{ $product->user->name }}</td>
                            <td>
                                <!-- Mempercantik border thumbnail foto agar halus -->
                                <img src="{{ asset('storage/' . $product->foto) }}"
                                    style="height: 44px; width: 44px; object-fit: cover; border-radius: 6px; border: 1px solid #E2E8F0;">
                            </td>
                            <td class="fw-semibold">{{ $product->nama }}</td>
                            <!-- 3. FORMATTING ANGKA: Menambahkan Rp dan format ribuan -->
                            <td>Rp {{ number_format($product->harga_beli) }}</td>
                            <td>Rp {{ number_format($product->harga_jual) }}</td>
                            <td>
                                <!-- 4. MENERAPKAN AKSI WARNA (10%): Otomatis berwarna merah jika stok kritis/habis -->
                                @if ($product->stok <= 5)
                                    <span class="text-danger-custom" style="font-weight: 700;">{{ $product->stok }}</span>
                                @else
                                    <span>{{ $product->stok }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- 5. TOMBOL AKSI: Menggunakan kelas minimalis outline yang elegan -->
                                <div class="d-flex gap-2 justify-content-end align-items-center">
                                    <!-- KEMBALIKAN KE KODE ASLI ANDA YANG AMAN -->
                                    @can('update', $product)
                                        <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning">Edit</a>
                                    @endcan
                                    @can('delete', $product)
                                        <form action="{{ route('produk.destroy', $product) }}" method="POST"
                                            class="d-inline m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-action-delete py-1 px-2 lh-sm"
                                                style="font-size: 13px !important;"
                                                onclick="return confirm('Apakah yakin akan menghapus produk ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <h4>Data produk tidak tersedia.</h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection
