<?php

namespace App\Http\Controllers;

use App\Models\Calonpenyewa;
use App\Models\Picture;
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
}
