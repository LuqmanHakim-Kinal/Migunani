<?php

namespace App\Http\Controllers;

use App\Models\Calonpenyewa;
use App\Models\Picture;
use App\Models\Penyewa;
use App\Models\Kamar;
use Illuminate\Http\Request;



class CalonPenyewaController extends Controller
{
    public function index()
    {
        $calonpenyewas = Calonpenyewa::all();
        $penyewas      = Penyewa::all();
        $kamars        = Kamar::all();
        $calonpenyewas = CalonPenyewa::paginate(10);
        return view('calonpenyewa.index', compact('calonpenyewas','penyewas','kamars'));
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
            'dp'              => 'numeric|min:8',
        ]);
        $calonpenyewa = Calonpenyewa::create([
            'nama'            => $request->nama,
            'no_hp'           => $request->no_hp,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'dp'              => $request->dp,
        ]);
        if ($request->hasFile('files'))
        {
            foreach ($request->file('files') as $file)
            {
                $filename=time().rand(1,200).'.'.$file->extension();
                $file->move(public_path('uploads/calonpenyewa'),$filename);
                Picture::create([
                    'calonpenyewa_id'=> $calonpenyewa->id,
                    'filename'=> $filename
                ]);
            
            }
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
    public function transferCalonPenyewaToPenyewa(Request $request)
    {
        $kamarId   = $request->input('kamar_id');
        //dd($kamarId);
        $penyewaId = $request->input('penyewa_id');
        // Ambil semua data calon penyewa
        $calonPenyewas = CalonPenyewa::all();
        $kamar = Kamar::find($kamarId);
        // $kamar->penyewa_id = $penyewaId;
        // Simpan data ke penyewas
        foreach ($calonPenyewas as $calonPenyewa) {
            $newPenyewa = Penyewa::create([
                'nama'            => $calonPenyewa->nama,
                'no_hp'           => $calonPenyewa->no_hp,
                'alamat'          => 'Alamat Default',
                'tanggal_masuk'   => $calonPenyewa->tanggal_masuk,
                'tanggal_selesai' => now(), 
                'dp'              => $calonPenyewa->dp,
                'nomor_kamar'     => $kamar->nomor_kamar,
            ]);
            // dd($newPenyewa->id);
            // Hapus data dari calonpenyewas setelah disimpan
            $kamar->update([
                'penyewa_id' => $kamar->penyewa()->associate($newPenyewa->id),
            ]);
            $calonPenyewa->delete();
        }

        // Berikan respons atau redirect sesuai kebutuhan
        return redirect('/penyewa')->with('success', 'Data Has Been Deleted'); 
    }
}
