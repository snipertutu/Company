<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $kasir = User::where('role', 'kasir')->first();

        if (!$admin || !$kasir) {
            return;
        }

        // 1. More Categories
        $categories = [
            'French Pastries',
            'Iced Beverages',
            'Coffee Beans',
            'Artisanal Jams',
            'Industrial Gas',
            'Household Accessories'
        ];

        $createdCategories = [];
        foreach ($categories as $catName) {
            $createdCategories[] = Category::firstOrCreate(['name' => $catName]);
        }

        // 2. More Suppliers
        $suppliers = [
            ['name' => 'Bean Roasters Co.', 'address' => 'Coffee Hill No. 5', 'phone' => '0821-222-333'],
            ['name' => 'Sugar & Spice', 'address' => 'Sweet Lane No. 10', 'phone' => '0821-444-555'],
            ['name' => 'Global Gas Logistics', 'address' => 'Port Industrial Zone', 'phone' => '0821-666-777'],
            ['name' => 'Dairy Fresh Farms', 'address' => 'Green Valley', 'phone' => '0821-888-999'],
        ];

        $createdSuppliers = [];
        foreach ($suppliers as $supData) {
            $createdSuppliers[] = Supplier::firstOrCreate(['name' => $supData['name']], $supData);
        }

        // 3. More Products
        $productsData = [
            ['name' => 'Macaron Box (12pcs)', 'cat_index' => 0, 'price' => 120000, 'unit' => 'box'],
            ['name' => 'Pain au Chocolat', 'cat_index' => 0, 'price' => 28000, 'unit' => 'pcs'],
            ['name' => 'Iced Vanilla Latte', 'cat_index' => 1, 'price' => 35000, 'unit' => 'cup'],
            ['name' => 'Matcha Frappe', 'cat_index' => 1, 'price' => 38000, 'unit' => 'cup'],
            ['name' => 'Arabica Roast (250g)', 'cat_index' => 2, 'price' => 85000, 'unit' => 'pack'],
            ['name' => 'Strawberry Preserve', 'cat_index' => 3, 'price' => 55000, 'unit' => 'jar'],
            ['name' => 'Oxygen Cylinder (Industrial)', 'cat_index' => 4, 'price' => 450000, 'unit' => 'cylinder'],
            ['name' => 'Gas Hose Reinforced', 'cat_index' => 5, 'price' => 75000, 'unit' => 'meter'],
        ];

        $allProducts = Product::all()->collect();
        foreach ($productsData as $pData) {
            $product = Product::create([
                'category_id' => $createdCategories[$pData['cat_index']]->id,
                'name' => $pData['name'],
                'price' => $pData['price'],
                'stock' => rand(10, 50),
                'unit' => $pData['unit']
            ]);
            $allProducts->push($product);
        }

        // 4. Generate Sales (Transactions) for the last 30 days
        for ($i = 0; $i < 50; $i++) {
            $date = Carbon::now()->subDays(rand(0, 30));
            $total = 0;
            
            // Random products for this sale
            $numItems = rand(1, 4);
            $saleItems = [];
            
            for ($j = 0; $j < $numItems; $j++) {
                $product = $allProducts->random();
                $qty = rand(1, 5);
                $subtotal = $product->price * $qty;
                $total += $subtotal;
                
                $saleItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal
                ];
            }

            $pay = ceil($total / 50000) * 50000; // Round up to nearest 50k
            
            $sale = Sale::create([
                'user_id' => $kasir->id,
                'date' => $date,
                'total' => $total,
                'pay' => $pay,
                'change' => $pay - $total,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            foreach ($saleItems as $item) {
                $item['sale_id'] = $sale->id;
                SaleDetail::create($item);
            }
        }

        // 5. Generate Purchases (Restock)
        for ($i = 0; $i < 15; $i++) {
            $date = Carbon::now()->subDays(rand(0, 30));
            $supplier = collect($createdSuppliers)->random();
            $total = 0;
            
            $numItems = rand(1, 3);
            $purchaseItems = [];
            
            for ($j = 0; $j < $numItems; $j++) {
                $product = $allProducts->random();
                $qty = rand(20, 100);
                $buyPrice = $product->price * 0.7; // Approx 30% margin
                $subtotal = $buyPrice * $qty;
                $total += $subtotal;
                
                $purchaseItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price_bought' => $buyPrice,
                    'subtotal' => $subtotal
                ];
            }

            $purchase = Purchase::create([
                'user_id' => $admin->id,
                'supplier_id' => $supplier->id,
                'date' => $date,
                'total' => $total,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            foreach ($purchaseItems as $item) {
                $item['purchase_id'] = $purchase->id;
                PurchaseDetail::create($item);
            }
        }
    }
}
