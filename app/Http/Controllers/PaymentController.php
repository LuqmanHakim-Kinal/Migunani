<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewa;
use App\Models\Kamar;
use App\Models\Picture;
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
        $penyewas = Penyewa::all(); 
        $kamars = Kamar::all();
        return view('pembayaran.create', compact('penyewas','kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyewa_id' => 'required',
            'tanggal_bayar' => 'required|date',
            'jumlah_bulan' => 'required|integer|min:1', // Tambahkan validasi jumlah bulan
        ]);
    
        $penyewa = Penyewa::findOrFail($request->penyewa_id);
        $kamar = Kamar::where('penyewa_id', $request->penyewa_id)->firstOrFail();
    
        $batas_bayar = Carbon::parse($request->tanggal_bayar)->addMonth();
        $status_bayar = $request->status_bayar ?? 'Belum Bayar';
    
        $pembayaran = Pembayaran::create ([
            'penyewa_id' => $request->penyewa_id,
            'nama_pembayar' => $penyewa->nama,
            'status_bayar' => $status_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'batas_bayar' => $batas_bayar,
            'harga' => $kamar->harga_kamar * $request->jumlah_bulan, // Kalikan harga dengan jumlah bulan
        ]);
        //dd($pembayaran);
        //$pembayaran->save();
       
        $pembayaran->status_bayar = 'Terbayar';
    
        if ($request->hasFile('files')) 
        {
            $penyewa->tambahBulanHabisSewa($request->jumlah_bulan);
            foreach ($request->file('files') as $file) 
            {
                $filename = time() . rand(1, 200) . '.' . $file->extension();
                $file->move(public_path('uploads/nota'), $filename);
                Picture::create([
                    'pembayaran_id' => $pembayaran->id,
                    'filename' => $filename,
                ]);
            }
    
            $pembayaran->status_bayar = 'Terbayar';
            $pembayaran->save();
        }
    
        if ($pembayaran->tanggal_bayar > $pembayaran->batas_bayar && $pembayaran->status_bayar === 'Belum Bayar') {
            $pembayaran->status_bayar = 'Telat Bayar';
            $pembayaran->save();
        }
    
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }
    public function edit($id)
{
    $pembayaran = Pembayaran::findOrFail($id);
    $penyewas = Penyewa::all();
    $kamars = Kamar::where('penyewa_id', $pembayaran->penyewa_id)->get();

    return view('pembayaran.edit', compact('pembayaran', 'penyewas', 'kamars'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'penyewa_id' => 'required',
        'tanggal_bayar' => 'required|date',
        'harga' => 'required|numeric',
    ]);

    $pembayaran = Pembayaran::findOrFail($id);
    $pembayaran->fill([
        'penyewa_id' => $request->penyewa_id,
        'tanggal_bayar' => $request->tanggal_bayar,
        'harga' => $request->harga,
    ]);
    $pembayaran->status_bayar = 'Terbayar';
    
    if ($request->hasFile('files')) {
        $penyewa->tambahBulanHabisSewa($request->jumlah_bulan);
        foreach ($request->file('files') as $file) {
            $filename = time() . rand(1, 200) . '.' . $file->extension();
            $file->move(public_path('uploads/nota'), $filename);

            Picture::create([
                'pembayaran_id' => $pembayaran->id,
                'filename' => $filename,
            ]);
        }

        $pembayaran->status_bayar = 'Terbayar';
        $pembayaran->save();
    }

    if ($pembayaran->tanggal_bayar > $pembayaran->batas_bayar && $pembayaran->status_bayar === 'Belum Bayar') {
        $pembayaran->status_bayar = 'Telat Bayar';
        $pembayaran->save();
    }


    $pembayaran->save();

    return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diupdate.');
}

    
    public function destroy($id)
    {
        $payment = Pembayaran::findOrFail($id);
        $payment->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }


}
