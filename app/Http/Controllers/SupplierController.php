<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $supplier = Supplier::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $supplier = Supplier::paginate(5);
        }
        return view('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create-supplier'); // View for creating a new supplier
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplier = Supplier::create($request->all());
        $supplier->save();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     */

    public function edit($id)
    {
        // Find the supplier by ID
        $supplier = Supplier::find($id);

        // If the supplier is found, return the edit form view
        if ($supplier) {
            return view('supplier.edit-supplier', compact('supplier'));
        }

        // If not found, redirect back with an error message
        return redirect()->route('supplier.index')->with('error', 'Supplier not found');
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update($request->all());
        return redirect()->route('supplier.index')->with('suksesupdate', 'Supplier berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletesupplier($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('supplier.index')->with('delete', 'Supplier Berhasil Dihapus');
    }
}
