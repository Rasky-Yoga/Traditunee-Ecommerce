<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlatMusik;
use App\Models\Daerah;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatMusikController extends Controller
{
    public function index()
    {
        $alatMusiks = AlatMusik::with(['daerah', 'kategori'])->paginate(10);
        return view('admin.alat-musik.index', compact('alatMusiks'));
    }

    public function create()
    {
        $daerahs = Daerah::all();
        $kategoris = Kategori::all();
        return view('admin.alat-musik.create', compact('daerahs', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'daerah_id' => 'required|exists:daerahs,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alat-musik', 'public');
        }

        AlatMusik::create($data);

        return redirect()->route('admin.alat-musik.index')
                        ->with('success', 'Alat musik berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alatMusik = AlatMusik::findOrFail($id);
        $daerahs = Daerah::all();
        $kategoris = Kategori::all();
        return view('admin.alat-musik.edit', compact('alatMusik', 'daerahs', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'daerah_id' => 'required|exists:daerahs,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $alatMusik = AlatMusik::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($alatMusik->gambar) {
                Storage::disk('public')->delete($alatMusik->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('alat-musik', 'public');
        }

        $alatMusik->update($data);

        return redirect()->route('admin.alat-musik.index')
                        ->with('success', 'Alat musik berhasil diupdate!');
    }

    public function destroy($id)
    {
        $alatMusik = AlatMusik::findOrFail($id);
        
        if ($alatMusik->gambar) {
            Storage::disk('public')->delete($alatMusik->gambar);
        }
        
        $alatMusik->delete();

        return redirect()->route('admin.alat-musik.index')
                        ->with('success', 'Alat musik berhasil dihapus!');
    }
}