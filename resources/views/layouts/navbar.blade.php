<style>
  /* ---------- NAVBAR ---------- */

.pos-navbar {
    /* 1. Mengubah background menjadi gelap (Slate Dark) */
    background: #1E293B !important;
    padding: 12px 0;
    /* Menghapus border bawah lama karena sudah kontras dengan background utama */
    border-bottom: none;
    /* Memberikan bayangan halus di bawah navbar */
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
}

.pos-navbar .navbar-brand {
    font-weight: 700;
    font-size: 20px;
    /* 2. Mengubah warna logo menjadi putih bersih */
    color: #FFFFFF !important;
    letter-spacing: 0.5px;
}

.pos-navbar .nav-link {
    /* 3. Mengubah teks menu pasif menjadi abu-abu kebiruan yang lembut */
    color: #94A3B8 !important;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 16px !important;
    position: relative;
    display: inline-block;
    /* Efek transisi halus saat pointer menyentuh menu */
    transition: color 0.2s ease;
}


/* Efek saat menu diarahkan kursor (hover) */

.pos-navbar .nav-link:hover {
    color: #F8FAFC !important;
}


/* 4. Mengubah menu yang aktif menjadi putih menyala */

.pos-navbar .nav-link.active {
    color: #FFFFFF !important;
    font-weight: 600;
}


/* 5. Garis indikator aktif di bawah menu menggunakan warna aksen (Ocean Blue) */

.pos-navbar .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -4px;
    /* Posisi diturunkan sedikit agar lebih pas di navbar gelap */
    left: 16px;
    /* Menyesuaikan dengan padding kiri yang baru */
    right: 16px;
    /* Menyesuaikan dengan padding kanan yang baru */
    height: 3px;
    /* Tebal garis dinaikkan sedikit agar lebih tegas */
    background-color: #0EA5E9;
    /* Warna aksen utama */
    border-radius: 2px;
}


/* 6. Desain ulang tombol Logout menjadi lebih modern & solid */

.pos-navbar .btn-danger {
    background: #EF4444;
    /* Warna merah modern, bukan merah pekat */
    border: none;
    color: #FFFFFF !important;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 16px;
    border-radius: 6px;
    /* Sudut sedikit membulat modern */
    transition: background-color 0.2s ease;
}

.pos-navbar .btn-danger:hover {
    background: #DC2626;
    /* Merah sedikit lebih dalam saat di-hover */
}

</style>
<nav class="navbar navbar-expand pos-navbar">
  <div class="container">
    <a class="navbar-brand" href="#">POS</a>

    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
      </li>
      {{-- Menu users hanya untuk admin (role_id = 1) --}}
      @if(auth()->user()->role_id === 1)
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
        </li>
      @endif
      <li class="nav-item">
        <a class="nav-link {{ Request::is('jenis') ? 'active' : '' }}" href="{{ route('jenis.index') }}">Jenis</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
      </li>
      
    </ul>

    <form action="{{ route('logout') }}" method="POST" class="d-flex">
      @csrf
      <button type="submit" class="btn btn-danger">Logout</button>
    </form>
  </div>
</nav>
