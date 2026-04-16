<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'pay' => 'required|numeric',
        ]);

        return DB::transaction(function () use ($request) {
            $product = Product::findOrFail($request->product_id);
            
            if ($product->stock < $request->quantity) {
                return back()->withErrors(['quantity' => 'Insufficient stock.']);
            }

            $subtotal = $product->price * $request->quantity;
            $change = $request->pay - $subtotal;

            if ($change < 0) {
                return back()->withErrors(['pay' => 'Payment amount is less than total.']);
            }

            $sale = Sale::create([
                'user_id' => auth()->id(),
                'date' => $request->date,
                'total' => $subtotal,
                'pay' => $request->pay,
                'change' => $change,
            ]);

            $sale->details()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'subtotal' => $subtotal,
            ]);

            $product->decrement('stock', $request->quantity);

            return redirect()->route('sales.index')->with('success', 'Penjualan berhasil dicatat.');
        });
    }
}
