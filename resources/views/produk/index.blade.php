@extends('layouts.app')

@section('title', 'Produk')

@include('layouts.navbar')

@section('content')

    <style>
        /* ==========================================================================
       STYLING SERAGAM UNTUK SEMUA JUDUL HALAMAN UTAMA (USERS, PRODUK, PENJUALAN)
       ========================================================================== */

        /* Menargetkan tag h1 yang menjadi judul utama di setiap halaman */

        .container h1,
        .pos-container h1,
        .table-filter-action~h1,
        h1 {
            font-size: 24px !important;
            /* Ukuran huruf proporsional dan tegas */
            font-weight: 700 !important;
            /* Ketebalan huruf tebal pekat */
            color: #1E293B !important;
            /* Menggunakan Slate Dark (senada dengan POS) */
            letter-spacing: -0.5px !important;
            /* Jarak antar huruf sedikit rapat agar modern */
            margin-top: 15px !important;
            /* Jarak ideal dari navbar atas */
            margin-bottom: 20px !important;
            /* Jarak ideal sebelum tombol atau filter cari */
            text-align: left !important;
            /* Mengunci posisi rata kiri yang rapi */
        }

        /* ==========================================================================
       HALAMAN MANAGEMENT DATA (USERS & MASTER DATA) - FINAL PERFECTED
       ========================================================================== */
        /* ---------- 1. Tata Letak Filter & Tombol Create ---------- */

        .table-filter-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 16px;
        }

        /* Kotak Pembungkus Search */

        .search-wrapper {
            display: flex;
            max-width: 400px;
            width: 100%;
        }

        .search-input {
            flex: 1;
            border: 1px solid #E2E8F0 !important;
            border-radius: 8px 0 0 8px !important;
            padding: 8px 14px !important;
            font-size: 14px !important;
            color: #1E293B !important;
            background-color: #FFFFFF;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: #0EA5E9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1) !important;
            outline: none;
        }

        .search-btn {
            border: 1px solid #E2E8F0 !important;
            border-left: none !important;
            background-color: #F8FAFC !important;
            color: #64748B !important;
            padding: 0 16px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 0 8px 8px 0 !important;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .search-btn:hover {
            background-color: #F1F5F9 !important;
            color: #1E293B !important;
        }

        /* ---------- 2. Tombol Create Utama (Aksen Biru Modern) ---------- */

        .btn-create-user {
            background-color: #0EA5E9 !important;
            color: #FFFFFF !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            padding: 10px 20px !important;
            border-radius: 8px !important;
            text-decoration: none !important;
            display: inline-block;
            box-shadow: 0 1px 2px 0 rgba(14, 165, 233, 0.2) !important;
            transition: background-color 0.2s ease;
        }

        .btn-create-user:hover {
            background-color: #0284C7 !important;
        }

        /* ---------- 3. Pengunci Tabel Putih Bersih & Membulat ---------- */

        table.custom-table {
            width: 100% !important;
            background-color: #FFFFFF !important;
            /* Memaksa background tabel jadi putih solid */
            border: 1px solid #E2E8F0 !important;
            border-radius: 12px !important;
            border-collapse: separate !important;
            /* Wajib separate agar lengkungan sudut luar terlihat */
            border-spacing: 0 !important;
            overflow: hidden !important;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02) !important;
            margin-top: 20px !important;
        }

        /* Merapikan sudut-sudut lengkung tabel */

        table.custom-table tr:first-child th:first-child {
            border-top-left-radius: 12px;
        }

        table.custom-table tr:first-child th:last-child {
            border-top-right-radius: 12px;
        }

        table.custom-table tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        table.custom-table tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        table.custom-table th {
            background-color: #F8FAFC !important;
            color: #64748B !important;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px !important;
            border-bottom: 2px solid #E2E8F0 !important;
            text-align: left;
        }

        table.custom-table td {
            padding: 14px 16px !important;
            color: #334155 !important;
            font-size: 14px;
            border-bottom: 1px solid #F1F5F9 !important;
            text-align: left;
            vertical-align: middle;
        }

        table.custom-table tbody tr:hover {
            background-color: #F8FAFC !important;
        }

        /* ---------- 4. Badge Status Role Kotak Lembut Premium ---------- */

        span.badge-role {
            display: inline-block !important;
            padding: 6px 12px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            text-transform: capitalize !important;
        }

        /* Warna spesifik jika class-nya 'admin' */

        span.badge-role.admin {
            background-color: #EFF6FF !important;
            color: #2563EB !important;
        }

        /* Warna spesifik jika class-nya 'kasir' */

        span.badge-role.kasir {
            background-color: #F0FDF4 !important;
            color: #16A34A !important;
        }

        /* ---------- 5. Tombol Aksi Minimalis (Sederhana & Elegan) ---------- */

        .btn-action-edit {
            background: transparent !important;
            border: 1px solid #E2E8F0 !important;
            color: #475569 !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            text-decoration: none !important;
            transition: all 0.15s ease;
        }

        .btn-action-edit:hover {
            background: #F8FAFC !important;
            border-color: #CBD5E1 !important;
            color: #1E293B !important;
        }

        .btn-action-delete {
            background: transparent !important;
            border: 1px solid #E2E8F0 !important;
            color: #EF4444 !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            transition: all 0.15s ease;
        }

        .btn-action-delete:hover {
            background: #FEF2F2 !important;
            border-color: #FCA5A5 !important;
            color: #DC2626 !important;
        }

        /* Menangkap tombol edit kuning bawaan bootstrap di tabel produk & penjualan lalu mengubahnya menjadi outline modern */

        .custom-table .btn-warning,
        table.custom-table td .btn-warning {
            background: transparent !important;
            border: 1px solid #E2E8F0 !important;
            color: #475569 !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            box-shadow: none !important;
            text-decoration: none !important;
            display: inline-block !important;
            transition: all 0.15s ease !important;
        }

        .custom-table .btn-warning:hover,
        table.custom-table td .btn-warning:hover {
            background: #F8FAFC !important;
            border-color: #CBD5E1 !important;
            color: #1E293B !important;
        }
    </style>

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
                <a href="{{ route('produk.create') }}" class="btn-create-user">+ Tambah Produk</a>
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
                        <th>Jenis</th>
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
                            <td>{{ $product->jenis->nama ??'Tidak ada jenis' }}</td>
                            <!-- 3. FORMATTING ANGKA: Menambahkan Rp dan format ribuan -->
                            <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
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
