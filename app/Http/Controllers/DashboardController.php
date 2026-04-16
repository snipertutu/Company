<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_sales' => Sale::sum('total'),
            'total_purchases' => Purchase::sum('total'),
            'total_suppliers' => Supplier::count(),
            'recent_sales' => Sale::with('user')->latest()->take(5)->get(),
        ];

        return view('dashboard', compact('stats'));
    }
}
