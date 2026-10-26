<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        $totalVarian = $products->count();
        $totalStok = $products->sum('stock');
        
        $produkKritisList = Product::whereColumn('stock', '<=', 'minimum_stock')->get();
        $stokKritis = $produkKritisList->count();
        
        // Ambil total penjualan hari ini secara aman
        $totalPenjualanHariIni = 0;

        try {
            // Jika ada tabel mutasi stok, hitung transaksi 'keluar' / 'out' hari ini
            if (\Schema::hasTable('stock_mutations')) {
                $totalPenjualanHariIni = DB::table('stock_mutations')
                    ->whereIn('type', ['keluar', 'out', 'Stock-Out'])
                    ->whereDate('created_at', Carbon::today())
                    ->sum('quantity');
            } elseif (\Schema::hasTable('stock_logs')) {
                $totalPenjualanHariIni = DB::table('stock_logs')
                    ->whereIn('type', ['keluar', 'out', 'Stock-Out'])
                    ->whereDate('created_at', Carbon::today())
                    ->sum('quantity');
            }
        } catch (\Exception $e) {
            $totalPenjualanHariIni = 0;
        }

        return view('dashboard', compact(
            'products',
            'totalVarian',
            'totalStok',
            'stokKritis',
            'produkKritisList',
            'totalPenjualanHariIni'
        ));
    }
}