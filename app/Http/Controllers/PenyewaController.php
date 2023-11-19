<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\Picture;
use Illuminate\Http\Request;


class PenyewaController extends Controller
{
    public function index()
    {
        $penyewas = Penyewa::all();
        return view('penyewa.index', compact('penyewas'));
    }

    public function create()
    {
        return view('penyewa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|min:8',
            'no_hp'           => 'required|numeric',
            'alamat'          => 'required',
            'tanggal_masuk'   => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);
        $penyewa = Penyewa::create([
            'nama'            => $request->nama,
            'no_hp'           => $request->no_hp,
            'alamat'          => $request->alamat,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);
        foreach ($request->file('files') as $file)
        {
            $filename=time().rand(1,200).'.'.$file->extension();
            $file->move(public_path('uploads/ktp'),$filename);
            Picture::create([
                'penyewa_id'=> $penyewa->id,
                'filename'=> $filename
            ]);
        
        }

        return redirect('/penyewa')->with('success', 'Data Has Been Uploaded');
    }

    public function edit($id)
    {
        $penyewa = Penyewa::find($id);
        return view('penyewa.edit', compact('penyewa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'            => 'required|min:8',
            'no_hp'           => 'required|numeric',
            'alamat'          => 'required',
            'tanggal_masuk'   => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        $penyewa = Penyewa::find($id);

        $penyewa->update([
            'nama'            => $request->nama,
            'no_hp'           => $request->no_hp,
            'alamat'          => $request->alamat,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);
        if ($request->hasFile('files'))
        {
            foreach ($request->file('files') as $file) {
                $filename = time() . rand(1, 200) . '.' . $file->extension();
                $file->move(public_path('uploads/ktp'), $filename);
        
                Picture::create([
                    'penyewa_id' => $penyewa->id,
                    'filename'   => $filename,
                ]);
            }
        }

        return redirect('/penyewa')->with('success', 'Data Has Been Updated');
    }

    public function destroy($id)
    {
        $penyewa = Penyewa::find($id);
        $penyewa->delete();

        return redirect('/penyewa')->with('success', 'Data Has Been Deleted');
    }
}
