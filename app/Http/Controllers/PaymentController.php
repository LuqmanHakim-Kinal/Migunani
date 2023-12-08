<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::all(); 
        return view('pembayaran.index', compact('pembayarans'));
    }
    public function create()
    {
        $penyewas = Penyewa::all(); // Assuming you have a Penyewa model

        return view('pembayaran.create', compact('penyewas'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'penyewa_id' => 'required',
            'tanggal_bayar' => 'required|date',
            'harga' => 'required|numeric',
  
        ]);
        $penyewa = Penyewa::findOrFail($request->penyewa_id);
        $batas_bayar = Carbon::parse($request->tanggal_bayar)->addMonth();
        $status_bayar = $request->status_bayar ?? 'Belum Bayar';


        $pembayarans = new Pembayaran([
            'penyewa_id' => $request->penyewa_id,
            'nama_pembayar' => $penyewa->nama,
            'status_bayar' => $status_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'batas_bayar' => $batas_bayar,
            'harga' => $request->harga,
        ]);
        if ($request->hasFile('files'))
        {
            foreach ($request->file('files') as $file)
            {
                $filename=time().rand(1,200).'.'.$file->extension();
                $file->move(public_path('uploads/nota'),$filename);
                Picture::create([   
                    'pembayaran_id'=> $pembayarans->id,
                    'filename'=> $filename
                ]);
            
            }
        }

        $pembayarans->save();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }
    public function destroy($id)
    {
        $payment = Pembayaran::findOrFail($id);
        $payment->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }


}
