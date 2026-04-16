<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'user'])->latest()->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price_bought' => 'required|numeric',
        ]);

        return DB::transaction(function () use ($request) {
            $product = Product::findOrFail($request->product_id);
            $subtotal = $request->price_bought * $request->quantity;

            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'user_id' => auth()->id(),
                'date' => $request->date,
                'total' => $subtotal,
            ]);

            $purchase->details()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price_bought' => $request->price_bought,
                'subtotal' => $subtotal,
            ]);

            $product->increment('stock', $request->quantity);

            return redirect()->route('purchases.index')->with('success', 'Pembelian berhasil dicatat.');
        });
    }
}
