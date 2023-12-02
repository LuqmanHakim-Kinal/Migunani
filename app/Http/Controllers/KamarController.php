<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Picture;
use App\Http\Requests\KamarRequest;
use Illuminate\Support\Facades\DB;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all(); 
        return view('kamars.index', compact('kamars'));
    }

    public function create()
    {
        $penyewas = Penyewa::all();
        //$kamars = Kamar::all();
        return view('kamars.create', compact('penyewas'));
    }

    public function store(KamarRequest $request)
    {
        //dd($request->all());
        try {

            $kamar = new Kamar([
                'nomor_kamar'   => $request->nomor_kamar,
                'status_kamar'  => $request->penyewa_id == null ? 'Belum Terisi' : 'Terisi',
                'harga_kamar'   => $request->harga_kamar,
                'panjang_kamar' => $request->panjang_kamar,
                'lebar_kamar'   => $request->lebar_kamar,

            ]);

            $kamar->save();
            if ($request->has('penyewa_id')) {
                $penyewa = Penyewa::find($request->penyewa_id);
                
                // Check if penyewa is found
                if ($penyewa) {
                    $penyewa->nomor_kamar = $request->nomor_kamar;
                    $penyewa->save();
    
                    // Associate the Kamar with the Penyewa
                    $kamar->penyewa()->associate($penyewa);
                    $kamar->save();
                }
            }


            $kamar->save();

            // Handle file uploads
            if ($request->hasFile('files')) 
            {
                foreach ($request->file('files') as $file) {
                    $filename = time() . rand(1, 200) . '.' . $file->extension();
                    $file->move(public_path('uploads/kamar'), $filename, 'public');

                    Picture::create([
                        'kamar_id' => $kamar->id,
                        'filename' => $filename,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('kamars.index')->with('success', 'Room has been added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('kamars.index')->with('error', 'Error adding room. Please try again. ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $penyewas = Penyewa::all();

        return view('kamars.edit', compact('kamar', 'penyewas'));
    }

    public function update(KamarRequest $request, $id)
    {
        try {  
            $kamar = Kamar::findOrFail($id);
            //dd($request->all());
            $kamar->update([
                'nomor_kamar' => $kamar->nomor_kamar,
                'harga_kamar' => $request->harga_kamar,
                'penyewa_id' => $kamar->penyewa()->associate($request->penyewa_id),
                'status_kamar' => $kamar->penyewa ? 'Terisi' : 'Belum Terisi',
            ]);

            if ($request->has('penyewa_id')) {
                $penyewa = Penyewa::find($request->penyewa_id);
                
                // Check if penyewa is found
                if ($penyewa) {
                    $penyewa->nomor_kamar = $request->nomor_kamar;
                    $penyewa->save();
    
                    // Associate the Kamar with the Penyewa
                    $kamar->penyewa()->associate($penyewa);
                    $kamar->save();
                }
            } else {
                $kamar->penyewa()->dissociate();
            }


            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $filename = time() . rand(1, 200) . '.' . $file->extension();
                    $file->move(public_path('uploads/kamar'), $filename, 'public');

                    Picture::create([
                        'kamar_id' => $kamar->id,
                        'filename' => $filename,
                    ]);
                }
            }

            if ($request->has('delete_files')) {
                foreach ($request->input('delete_files') as $pictureId) {
                    $picture = Picture::findOrFail($pictureId);
                    // Hapus gambar dari direktori
                    unlink(public_path('uploads/kamar/' . $picture->filename));
                    $picture->delete();
                }
            }

            return redirect()->route('kamars.index')->with('success', 'Room has been updated successfully.');
        } catch (\Exception $e) {
        return redirect()->route('kamars.index')->with('error', 'Error updating room. Please try again. ' . $e->getMessage());
    }
}

        public function deletePictures(Request $request, $id)
    {
        try {
            $kamar = Kamar::findOrFail($id);

            if ($request->has('delete_files')) 
            {
                foreach ($request->input('delete_files') as $pictureId) 
                {
                    $picture = Picture::findOrFail($pictureId);
                    unlink(public_path('uploads/kamar/' . $picture->filename));
                    $picture->delete();
                }
            }

            return redirect()->back()->with('success', 'Selected pictures have been deleted.');
        } catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect()->back()->with('error', 'Error deleting pictures. Please try again. ' . $e->getMessage());
        }
    }


        
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('kamars.index')->with('success', 'Room has been deleted successfully.');
    }

    public function show($id)
    {
        $kamar = Kamar::with('penyewa', 'pictures')->findOrFail($id);
        $inventories = $kamar->inventories;
        return view('kamars.show', compact('kamar','inventories'));
    }
}
