<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('stock.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            // Validasi jika stok keluar melebihi sisa stok
            if ($request->type === 'out' && $product->stock < $request->quantity) {
                return back()->withErrors(['quantity' => 'Stok tidak mencukupi! Sisa stok saat ini: ' . $product->stock . ' botol.'])->withInput();
            }

            // Update jumlah stok
            if ($request->type === 'in') {
                $product->increment('stock', $request->quantity);
            } else {
                $product->decrement('stock', $request->quantity);
            }
        });

        return redirect()->route('stock.index')->with('success', 'Mutasi stok berhasil dicatat!');
    }
}