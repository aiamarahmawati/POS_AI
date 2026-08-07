@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Login')

@include('layouts.navbar')
<!-- batas awal isi konten  -->
@section('content')

    <div class="container py-4 text-center">
        <div class="container py-4">
            <div class="text-center mb-4">
                <h1>
                    Ringkasan Hari Ini
                    <small class="text-muted">
                        ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
                    </small>
                </h1>
            </div>
            <!-- ... sisanya biarkan di dalam row ... -->
            <div class="row">
                @can('viewAny', App\Models\User::class)
                    <div class="col-md-12">
                        <h2>Today's Sales</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header">
                                Total Nilai Penjualan Hari ini
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan']) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header">
                                Jumlah Transaksi Hari ini
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $ringkasan['total_transaksi'] }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Cash & Payment Status</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Total Pembayaran Tunai
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Rp {{ number_format($ringkasan['total_cash']) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Total Pembayaran Non-Tunai
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            <div class="row">
                <div class="col-md-12">
                    <h2>Critical Inventory Status</h2>
                </div>
                <div class="col-md-6">
                    <h3>Daftar produk stok rendah</h3>
                    <table class="table table-hover align-middle mt-2">
                        <thead>
                            <tr>
                                <!-- Tambahkan text-start pada judul kolom -->
                                <th scope="col" class="text-start">#</th>
                                <th scope="col" class="text-start">Nama</th>
                                <th scope="col" class="text-start">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokRendah as $index => $produk)
                                <tr>
                                    <!-- Pastikan td atau th di sini juga text-start -->
                                    <th class="text-start">{{ $produkStokRendah->firstItem() + $index }}</th>
                                    <td class="text-start">{{ $produk->nama }}</td>
                                    <td class="text-start">
                                        <span class="text-warning-custom">{{ $produk->stok }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Seluruh produk berada dalam kondisi stok aman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $produkStokRendah->links() }}
                </div>
                <div class="col-md-6">
                    <h3>Produk habis stok</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokHabis as $index => $produk)
                                <tr>
                                    <th>{{ $produkStokHabis->firstItem() + $index }}</th>
                                    <td>{{ $produk->nama }}</td>
                                    <!-- Cari bagian ini di baris stok habis, tambahkan class text-danger-custom -->
                                    <td><span class="text-danger-custom">{{ $produk->stok }}</span></td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Seluruh produk berada dalam kondisi stok aman.
                                    </td>
                                </tr>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                    {{ $produkStokRendah->links() }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Best Seller Products</h2>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Unit Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerlaris as $index => $produk)
                                <tr>
                                    <th>{{ $produk->nama }}</th>
                                    <td>{{ $produk->stok }}</td>
                                    <td>{{ $produk->total_terjual }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Seluruh produk berada dalam kondisi stok aman.
                                    </td>
                                </tr>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                    {{ $produkStokRendah->links() }}
                </div>
            </div>
        </div>

        <!-- batas akhir isi konten  -->
    @endsection
