<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;


class KategoriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $kategori = Kategori::where('nama_kategori', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $kategori = Kategori::paginate(5);
        }
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create-kategori');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit-kategori', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('suksesupdate', 'Kategori berhasil diperbarui');
    }

    public function data()
    {
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get();

        return datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('kategori.update', $kategori->id_kategori) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`' . route('kategori.destroy', $kategori->id_kategori) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function delete($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('delete', 'Kategori Berhasil Dihapus');

    }
}
