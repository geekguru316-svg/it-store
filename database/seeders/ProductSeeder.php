<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Product::categories();

        $products = [
            ['name' => 'Galaxy S23 Ultra', 'description' => 'Flagship Android smartphone.', 'price' => 1299.99, 'category' => 'Mobiles'],
            ['name' => 'iPad Pro', 'description' => 'High performance tablet for creatives.', 'price' => 999.99, 'category' => 'Tablets'],
            ['name' => 'MacBook Pro 14"', 'description' => 'Powerful laptop for professionals.', 'price' => 1999.99, 'category' => 'Laptops'],
            ['name' => 'Dell Precision', 'description' => 'Workstation desktop for engineers.', 'price' => 2399.99, 'category' => 'Desktops'],
            ['name' => 'Logitech C920 Webcam', 'description' => 'HD streaming camera.', 'price' => 79.99, 'category' => 'Security Cameras'],
            ['name' => 'GoPro HERO11', 'description' => 'Action camera for your adventures.', 'price' => 399.99, 'category' => 'Action/Video Cameras'],
            ['name' => 'Canon EOS M50', 'description' => 'Mirrorless digital camera.', 'price' => 649.99, 'category' => 'Digital Cameras'],
            ['name' => 'PlayStation 5', 'description' => 'Next-gen gaming console.', 'price' => 499.99, 'category' => 'Gaming Consoles'],
            ['name' => 'Apple Watch Series 9', 'description' => 'Smart wearable gadget.', 'price' => 399.99, 'category' => 'Gadgets'],
            ['name' => 'Rogue 5 Laptop', 'description' => 'Gaming laptop with RTX GPU.', 'price' => 1499.99, 'category' => 'Laptops'],
            ['name' => 'WireGuard Router', 'description' => 'Secure router for home networks.', 'price' => 179.99, 'category' => 'Desktops'],
            ['name' => 'Pro Tablet Stand', 'description' => 'Durable stand for tablets.', 'price' => 49.99, 'category' => 'Tablets'],
            ['name' => 'Wireless Earbuds', 'description' => 'Noise-cancelling audio gadget.', 'price' => 129.99, 'category' => 'Gadgets'],
            ['name' => 'Mechanical Keyboard', 'description' => 'Backlit mechanical keyboard.', 'price' => 89.99, 'category' => 'Gadgets'],
            ['name' => 'Gaming Mouse', 'description' => 'High-precision gaming mouse.', 'price' => 59.99, 'category' => 'Gadgets'],
        ];

        foreach ($products as $data) {
            $data['stock'] = $data['stock'] ?? rand(3, 30);
            $data['sold_count'] = $data['sold_count'] ?? rand(20, 120);
            Product::create($data);
        }
    }
}
