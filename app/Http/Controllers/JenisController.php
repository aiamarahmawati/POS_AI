<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(SearchRequest $request)
    {

        $keyword = $request->input('search');

        $jenis = Jenis::when($keyword, function ($query, $keyword) {
            $query->where('nama', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis,nama',
        ]);

        Jenis::create($request->only('nama'));

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function show(Jenis $jenis)
    {
        //
    }

    public function edit(Jenis $jenis)
    {
        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, Jenis $jenis)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis,nama,' . $jenis->id,
        ]);

        $jenis->update($request->only('nama'));

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diperbarui');
    }

    public function destroy(Jenis $jenis)
    {
        $this->authorize('delete', $jenis);

        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil dihapus');
    }
}