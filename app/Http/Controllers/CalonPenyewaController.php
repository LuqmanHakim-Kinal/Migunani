<?php

namespace App\Http\Controllers;

use App\Models\Calonpenyewa;
use App\Models\Picture;
use App\Models\Penyewa;
use Illuminate\Http\Request;



class CalonPenyewaController extends Controller
{
    public function index()
    {
        $calonpenyewas = Calonpenyewa::all();
        return view('calonpenyewa.index', compact('calonpenyewas'));
    }

    public function create()
    {
        return view('calonpenyewa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|min:8',
            'no_hp'           => 'required|numeric',
            'tanggal_masuk'   => 'required|date',
            'dp'              => 'numeric',
        ]);
        $calonpenyewa = Calonpenyewa::create([
            'nama'            => $request->nama,
            'no_hp'           => $request->no_hp,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'dp'              => $request->dp,
        ]);
        foreach ($request->file('files') as $file)
        {
            $filename=time().rand(1,200).'.'.$file->extension();
            $file->move(public_path('uploads/calonpenyewa'),$filename);
            Picture::create([
                'calonpenyewa_id'=> $calonpenyewa->id,
                'filename'=> $filename
            ]);
        
        }

        return redirect('/calonpenyewa')->with('success', 'Data Has Been Uploaded');
    }

    public function edit($id)
    {
        $calonpenyewa = Calonpenyewa::find($id);
        return view('calonpenyewa.edit', compact('calonpenyewa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'            => 'required|min:8',
            'no_hp'           => 'required|numeric',
            'tanggal_masuk'   => 'required|date',
            'dp'              => 'numeric',
        ]);

        $calonpenyewa = Calonpenyewa::find($id);

        $calonpenyewa->update([
            'nama'            => $request->nama,
            'no_hp'           => $request->no_hp,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'dp'              => $request->dp,
        ]);
        if ($request->hasFile('files'))
        {
            foreach ($request->file('files') as $file) {
                $filename = time() . rand(1, 200) . '.' . $file->extension();
                $file->move(public_path('uploads/calonpenyewa'), $filename);
        
                Picture::create([
                    'calonpenyewa_id' => $calonpenyewa->id,
                    'filename'   => $filename,
                ]);
            }
        }

        return redirect('/calonpenyewa')->with('success', 'Data Has Been Updated');
    }

    public function destroy($id)
    {
        $calonpenyewa = Calonpenyewa::find($id);
        $calonpenyewa->delete();

        return redirect('/calonpenyewa')->with('success', 'Data Has Been Deleted');
    }
    public function transferCalonPenyewaToPenyewa()
    {
        // Ambil semua data calon penyewa
        $calonPenyewas = CalonPenyewa::all();

        // Simpan data ke penyewas
        foreach ($calonPenyewas as $calonPenyewa) {
            Penyewa::create([
                'nama' => $calonPenyewa->nama,
                'no_hp' => $calonPenyewa->no_hp,
                'alamat' => 'Alamat Default', // Sesuaikan dengan alamat default yang diinginkan
                'tanggal_masuk' => $calonPenyewa->tanggal_masuk,
                'tanggal_selesai' => now(), // Sesuaikan dengan tanggal selesai default yang diinginkan
            ]);

            // Hapus data dari calonpenyewas setelah disimpan
            $calonPenyewa->delete();
        }

        // Berikan respons atau redirect sesuai kebutuhan
        return redirect('/penyewa')->with('success', 'Data Has Been Deleted'); 
    }
}
