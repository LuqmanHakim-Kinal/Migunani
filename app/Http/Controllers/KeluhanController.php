<?php

// app/Http/Controllers/KeluhanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluhan;
use App\Models\Penyewa;

class KeluhanController extends Controller
{
    public function index()
    {
        $keluhans = Keluhan::with('penyewa')->get();
        return view('keluhans.index', compact('keluhans'));
    }

    public function show($id)
    {
        $keluhan = Keluhan::with('penyewa')->findOrFail($id);
        //dd($keluhan);
        return view('keluhans.show', compact('keluhan'));
    }

    public function create()
    {
        $penyewas = Penyewa::all();
        return view('keluhans.create',compact('penyewas'));
    }
    public function store(Request $request)
    {   
        dd($request->all());
        $request->validate([
            'judul' => 'required',
            'penyewa_id' => 'required|exists:penyewas,id',
            'tanggal_pelaporan' => 'required|date',
            'keterangan' => 'nullable',
        ]);
    
        Keluhan::create([
            'judul' => $request->judul,
            'penyewa_id' => $request->penyewa_id,
            'tanggal_pelaporan' => $request->tanggal_pelaporan,
            'status' => 'Proses',
            'keterangan' => $request->keterangan,
        ]);
    
        return redirect()->route('keluhans.index')->with('success', 'Keluhan berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'status' => 'required|in:Proses,Selesai',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $keluhan = Keluhan::findOrFail($id);

        $keluhan->update([
            'status' => $request->status,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('keluhans.index')->with('success', 'Status keluhan berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $keluhan = Keluhan::find($id);
        $keluhan->delete();

        return redirect('keluhans.index')->with('success', 'Data Has Been Deleted');
    }
}
