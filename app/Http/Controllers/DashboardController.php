<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVariants = Product::count();
        $totalStock    = Product::sum('stock');
        $lowStock      = Product::whereColumn('stock', '<=', 'minimum_stock')->count();

        return view('dashboard', compact('totalVariants', 'totalStock', 'lowStock'));
    }
}