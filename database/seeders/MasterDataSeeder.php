<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin & Kasir if not exists
        if (!User::where('email', 'admin@luxe.com')->exists()) {
            User::create([
                'name' => 'Admin Luxe',
                'email' => 'admin@luxe.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        if (!User::where('email', 'kasir@luxe.com')->exists()) {
            User::create([
                'name' => 'Kasir Luxe',
                'email' => 'kasir@luxe.com',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ]);
        }

        // Categories
        $catBakery = Category::create(['name' => 'Artisanal Bakery']);
        $catGas = Category::create(['name' => 'Energy Solutions (LPG)']);

        // Suppliers
        $supFlour = Supplier::create([
            'name' => 'Premium Flour Co.',
            'address' => 'Grain Valley No. 12',
            'phone' => '08123456789'
        ]);
        $supPertamina = Supplier::create([
            'name' => 'Pertamina Gas Hub',
            'address' => 'Energy Square',
            'phone' => '135'
        ]);

        // Products
        Product::create([
            'category_id' => $catBakery->id,
            'name' => 'Luxe Sourdough',
            'price' => 45000,
            'stock' => 20,
            'unit' => 'loaf'
        ]);

        Product::create([
            'category_id' => $catBakery->id,
            'name' => 'Golden Croissant',
            'price' => 25000,
            'stock' => 50,
            'unit' => 'pcs'
        ]);

        Product::create([
            'category_id' => $catGas->id,
            'name' => 'LPG 3Kg Cylinder',
            'price' => 18000,
            'stock' => 100,
            'unit' => 'cylinder'
        ]);

        Product::create([
            'category_id' => $catGas->id,
            'name' => 'Bright Gas 12Kg',
            'price' => 210000,
            'stock' => 15,
            'unit' => 'cylinder'
        ]);
    }
}
