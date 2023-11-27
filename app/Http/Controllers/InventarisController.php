<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Picture;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InventarisController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventaris.index', compact('inventories'));
    }

    public function create()
    {
        $kamars = Kamar::all();
        return view('inventaris.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_beli' => 'required|date',
            'kondisi' => 'required|in:Baik,Rusak',
        ]);

        try {
            DB::beginTransaction();

            $inventory = Inventory::create([
                'nama' => $request->nama,
                'tanggal_pembelian' => $request->tanggal_beli, // Sesuaikan dengan nama kolom yang benar
                'kondisi' => $request->kondisi,
            ]);

            if ($request->has('tempat')) {
                $inventory->nomor_kamar = $request->tempat;
            }

            $inventory->save();

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $filename = time() . rand(1, 200) . '.' . $file->extension();
                    $file->move(public_path('uploads/inventory'), $filename, 'public');

                    Picture::create([
                        'inventory_id' => $inventory->id,
                        'filename' => $filename,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('inventaris.index')->with('success', 'Inventory has been added successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('inventaris.create')->withInput()->with('error', 'Error adding inventory. Please try again. ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return view('inventaris.edit', compact('inventory'));
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'kondisi' => 'required|in:Baik,Rusak',
        ]);

        $inventory = Inventory::findOrFail($id);

        $inventory->update([
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('inventaris.index')->with('success', 'Status inventaris berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $inventaris = Inventory::findOrFail($id);
        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Room has been deleted successfully.');
    }
}
