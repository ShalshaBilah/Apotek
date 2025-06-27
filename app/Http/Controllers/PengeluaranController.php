<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $pengeluaran = Pengeluaran::where('deskripsi', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $pengeluaran = Pengeluaran::paginate(5);
        }
        return view('pengeluaran.index', compact('pengeluaran'));
    }


    // In PengeluaranController.php
    public function create()
    {
        return view('pengeluaran.create-pengeluaran');
    }



    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        // Create a new Pengeluaran entry
        Pengeluaran::create([
            'deskripsi' => $request->deskripsi,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('pengeluaran.edit-pengeluaran', compact('pengeluaran'));
    }

    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->update($request->all());

        return redirect()->route('pengeluaran.index')->with('suksesupdate', 'Pengeluaran berhasil diupdate');
    }

    public function deletepengeluaran($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with('delete', 'Pengeluaran Berhasil Dihapus');

    }

    public static function grafik()
    {
        // Ambil data pengeluaran per bulan
        return Pengeluaran::selectRaw('MONTH(created_at) as bulan, SUM(nominal) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    }
}
