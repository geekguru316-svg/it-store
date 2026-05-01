<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add Admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Add Customer
        User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user'),
            'role' => 'user',
        ]);

        // Seed Products
        $products = [
            ['name' => 'iPhone 13 Pro', 'price' => 54990, 'category' => 'Mobiles'],
            ['name' => 'Samsung Galaxy S22', 'price' => 42990, 'category' => 'Mobiles'],
            ['name' => 'MacBook Air M1', 'price' => 58990, 'category' => 'Laptops'],
            ['name' => 'Dell XPS 13', 'price' => 67990, 'category' => 'Laptops'],
            ['name' => 'Gaming Mechanical Keyboard', 'price' => 2499, 'category' => 'Gadgets'],
            ['name' => 'Wireless Mouse Logitech', 'price' => 1299, 'category' => 'Gadgets'],
            ['name' => 'Noise Cancelling Headphones', 'price' => 3999, 'category' => 'Gadgets'],
            ['name' => 'iPad Air 5', 'price' => 38990, 'category' => 'Tablets'],
        ];

        foreach ($products as $item) {
            Product::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'stock' => rand(5, 50),
                'category' => $item['category'],
                'description' => 'High quality ' . $item['name'] . ' perfect for daily use.',
                'image' => null,
                'sold_count' => rand(10, 200),
            ]);
        }
    }
}
