<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Keluhan;
use App\Models\Pembayaran;
use App\Models\Calonpenyewa;
use App\Models\Penyewa;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $occupiedRoomsCount = Kamar::where('status_kamar', 'Terisi')->count();
        $emptyRoomsCount = Kamar::where('status_kamar', 'Belum Terisi')->count();
        $unresolvedComplaintsCount = Keluhan::where('status', 'Proses')->count();
        $keluhans = Keluhan::with('penyewa')->get();
        $belumBayarCount = Pembayaran::where('status_bayar', 'Belum Bayar')->count();
        $lastPayments = Pembayaran::orderBy('created_at', 'desc')->take(10)->get();
        $calonpenyewas = Calonpenyewa::take(5)->get();
        $penyewas = Penyewa::all();
        $habisMasaSewa = Penyewa::whereDate('tanggal_selesai', '<', Carbon::today())->take(5)->get();
        return view('dashboard.index', compact(
            'occupiedRoomsCount',
            'emptyRoomsCount',
            'keluhans', 
            'unresolvedComplaintsCount', 
            'belumBayarCount',
            'lastPayments',
            'calonpenyewas',
            'penyewas',
            'habisMasaSewa'  // Include the lastPayments variable
        ));
    }
}
