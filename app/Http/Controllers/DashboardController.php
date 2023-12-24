<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Keluhan;
use App\Models\Pembayaran;
use App\Models\Calonpenyewa;
use App\Models\Penyewa;
use Illuminate\Support\Facades\DB;
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
        $monthlyIncomeData = Pembayaran::selectRaw('DATE_FORMAT(tanggal_bayar, "%Y-%m") as month')
            ->selectRaw('SUM(harga) as total_payment')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $months = $monthlyIncomeData->pluck('month');
        $totalPayments = $monthlyIncomeData->pluck('total_payment');
        $monthlyIncome = $this->getMonthlyIncome();
        return view('dashboard.index', compact(
            'occupiedRoomsCount',
            'emptyRoomsCount',
            'keluhans', 
            'unresolvedComplaintsCount', 
            'belumBayarCount',
            'lastPayments',
            'calonpenyewas',
            'penyewas',
            'habisMasaSewa', 
            'monthlyIncome' // Include the lastPayments variable
        ));
    }
    private function getMonthlyIncome()
    {
        $monthlyIncome = Pembayaran::select(
                DB::raw('DATE_FORMAT(tanggal_bayar, "%Y-%m") as month'),
                DB::raw('SUM(harga) as total_income')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return $monthlyIncome;
    }
}
