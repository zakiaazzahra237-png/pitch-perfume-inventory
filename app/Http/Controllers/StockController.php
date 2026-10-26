<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $movements = StockMovement::with('product')->latest()->get();

        return view('stock.index', compact('products', 'movements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:IN,OUT',
            'quantity'   => 'required|integer|min:1',
            'notes'      => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type === 'OUT' && $product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi untuk transaksi keluar!');
        }

        if ($request->type === 'IN') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        StockMovement::create($validated);

        return redirect()->route('stock.index')->with('success', 'Catatan stok berhasil diperbarui!');
    }
}