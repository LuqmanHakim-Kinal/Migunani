<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Penyewa;
use App\Models\Picture;
use App\Models\Pembayaran;
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
        $tanggalMulai = Carbon::parse($request->tanggal_masuk);
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai);

        // Pastikan tanggal selesai setidaknya 1 bulan setelah tanggal mulai
        if ($tanggalSelesai->diffInMonths($tanggalMulai) < 1) {
            return redirect()->route('kamars.index')->with('error', 'Tanggal selesai harus minimal 1 bulan setelah tanggal mulai.');
        }
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
        if ($request->hasFile('files'))
        {
            foreach ($request->file('files') as $file)
            {
                $filename=time().rand(1,200).'.'.$file->extension();
                $file->move(public_path('uploads/ktp'),$filename);
                Picture::create([
                    'penyewa_id'=> $penyewa->id,
                    'filename'=> $filename
                ]);
            
            }
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
    public function show($id)
    {
        $penyewa = Penyewa::with('pictures')->findOrFail($id);
        return view('penyewa.show', compact('penyewa'));
    }

    public function destroy($id)
    {
        $penyewa = Penyewa::find($id);
        $penyewa->delete();

        return redirect('/penyewa')->with('success', 'Data Has Been Deleted');
    }
    // PenyewaController.php

    public function storePembayran(Request $request, $penyewaId)
    {
        // Validate the form data
        $request->validate([
            'waktu_sewa' => 'required|numeric|min:1',
        ]);

        // Retrieve the Penyewa record
        $penyewa = Penyewa::findOrFail($penyewaId);

        // Calculate the total price based on room price and duration
        $harga_kamar = $penyewa->kamar->harga_kamar;
        $dp = 0; // You need to define the dp value
        $total_price = $harga_kamar * $request->waktu_sewa - $dp;

        // Create a new Payment record
        $pembayaran = new Pembayaran([
            'status_bayar' => 'Belum Bayar', // You can adjust this based on your logic
            'nama_pembayar' => $penyewa->nama,
            'tanggal_bayar' => now(),
            'harga' => $total_price,
        ]);

        // Save the payment and associate it with the Penyewa
        $penyewa->pembayaran()->save($pembayaran);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Pembayaran berhasil.');
    }

}
