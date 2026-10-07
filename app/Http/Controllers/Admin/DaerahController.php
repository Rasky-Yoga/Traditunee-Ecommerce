<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Daerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    public function index()
    {
        $daerahs = Daerah::paginate(10);
        return view('admin.daerah.index', compact('daerahs'));
    }

    public function create()
    {
        return view('admin.daerah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        Daerah::create($request->all());

        return redirect()->route('admin.daerah.index')
                        ->with('success', 'Daerah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $daerah = Daerah::findOrFail($id);
        return view('admin.daerah.edit', compact('daerah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $daerah = Daerah::findOrFail($id);
        $daerah->update($request->all());

        return redirect()->route('admin.daerah.index')
                        ->with('success', 'Daerah berhasil diupdate!');
    }

    public function destroy($id)
    {
        $daerah = Daerah::findOrFail($id);
        $daerah->delete();

        return redirect()->route('admin.daerah.index')
                        ->with('success', 'Daerah berhasil dihapus!');
    }
}