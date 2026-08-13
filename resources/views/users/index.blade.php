@extends('layouts.app')

@section('title', 'Users')

@include('layouts.navbar')

@section('content')
    <!-- Tambahkan pembungkus kontainer ini agar jarak kanan kirinya seimbang -->
    <div class="container mt-4">

        <h1 class="mb-4">Users</h1>

        <div class="table-filter-action">
            <form action="{{ route('admin.users') }}" method="GET" class="search-wrapper">
                <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                    placeholder="Search username or email..." autocomplete="off">
                <button class="search-btn" type="submit">Search</button>
            </form>

            <a href="{{ route('admin.users.create') }}" class="btn-create-user">
                Create
            </a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 200px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge-role {{ Str::slug($user->role->name) }}">
                                    {{ $user->role->name }}
                                </span>
                            </td>
                            <!-- Cari bagian loop tabel aksi Anda, ganti menjadi struktur super rapi ini: -->
                            <td>
                                <div class="d-flex gap-2 justify-content-end align-items-center">
                                    <!-- TOMBOL EDIT: Ditambah class py-1 px-2 lh-sm fs-7 -->
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="btn btn-action-edit py-1 px-2 lh-sm" style="font-size: 13px !important;">
                                        Edit Akun
                                    </a>
                                    <!-- TOMBOL HAPUS: Disamakan class padding-nya py-1 px-2 lh-sm -->
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        class="d-inline m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action-delete py-1 px-2 lh-sm"
                                            style="font-size: 13px !important;"
                                            onclick="return confirm('Yakin hapus user ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
