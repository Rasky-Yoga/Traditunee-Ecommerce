<?php

namespace App\Http\Controllers;

use App\Models\AlatMusik;
use App\Models\Daerah;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = AlatMusik::with(['daerah', 'kategori']);

        // Filter by search
        if ($request->has('search')) {
            $query->where('nama_alat', 'like', '%' . $request->search . '%');
        }

        // Filter by daerah
        if ($request->has('daerah_id') && $request->daerah_id != '') {
            $query->where('daerah_id', $request->daerah_id);
        }

        // Filter by kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Sort
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'name':
                    $query->orderBy('nama_alat', 'asc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $alatMusiks = $query->paginate(12);
        $daerahs = Daerah::all();
        $kategoris = Kategori::all();

        return view('catalog.index', compact('alatMusiks', 'daerahs', 'kategoris'));
    }

    public function show(AlatMusik $alatMusik)
    {
        $alatMusik->load(['daerah', 'kategori']);
        $relatedProducts = AlatMusik::where('kategori_id', $alatMusik->kategori_id)
            ->where('id', '!=', $alatMusik->id)
            ->take(4)
            ->get();

        return view('catalog.show', compact('alatMusik', 'relatedProducts'));
    }
}