<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing products
        Product::truncate();

        $products = [
            ['name' => 'Galaxy S23 Ultra', 'description' => 'Flagship Android smartphone.', 'price' => 1299.99, 'category' => 'Mobiles', 'image' => 'products/mobile.jpg'],
            ['name' => 'iPad Pro', 'description' => 'High performance tablet for creatives.', 'price' => 999.99, 'category' => 'Tablets', 'image' => 'products/tablet.jpg'],
            ['name' => 'MacBook Pro 14"', 'description' => 'Powerful laptop for professionals.', 'price' => 1999.99, 'category' => 'Laptops', 'image' => 'products/laptop.jpg'],
            ['name' => 'Dell Precision', 'description' => 'Workstation desktop for engineers.', 'price' => 2399.99, 'category' => 'Desktops', 'image' => 'products/monitor.jpg'],
            ['name' => 'Logitech C920 Webcam', 'description' => 'HD streaming camera.', 'price' => 79.99, 'category' => 'Security Cameras', 'image' => 'products/networking.jpg'],
            ['name' => 'GoPro HERO11', 'description' => 'Action camera for your adventures.', 'price' => 399.99, 'category' => 'Action/Video Cameras', 'image' => 'products/networking.jpg'],
            ['name' => 'Canon EOS M50', 'description' => 'Mirrorless digital camera.', 'price' => 649.99, 'category' => 'Digital Cameras', 'image' => 'products/networking.jpg'],
            ['name' => 'PlayStation 5', 'description' => 'Next-gen gaming console.', 'price' => 499.99, 'category' => 'Gaming Consoles', 'image' => 'products/monitor.jpg'],
            ['name' => 'Apple Watch Series 9', 'description' => 'Smart wearable gadget.', 'price' => 399.99, 'category' => 'Gadgets', 'image' => 'products/mobile.jpg'],
            ['name' => 'Rogue 5 Laptop', 'description' => 'Gaming laptop with RTX GPU.', 'price' => 1499.99, 'category' => 'Laptops', 'image' => 'products/laptop.jpg'],
            ['name' => 'WireGuard Router', 'description' => 'Secure router for home networks.', 'price' => 179.99, 'category' => 'Networking', 'image' => 'products/networking.jpg'],
            ['name' => 'Pro Tablet Stand', 'description' => 'Durable stand for tablets.', 'price' => 49.99, 'category' => 'Tablets', 'image' => 'products/tablet.jpg'],
            ['name' => 'Wireless Earbuds', 'description' => 'Noise-cancelling audio gadget.', 'price' => 129.99, 'category' => 'Gadgets', 'image' => 'products/mobile.jpg'],
            ['name' => 'Mechanical Keyboard', 'description' => 'Backlit mechanical keyboard.', 'price' => 89.99, 'category' => 'Peripherals', 'image' => 'products/networking.jpg'],
            ['name' => 'Gaming Mouse', 'description' => 'High-precision gaming mouse.', 'price' => 59.99, 'category' => 'Peripherals', 'image' => 'products/networking.jpg'],
            ['name' => 'HP LaserJet Pro', 'description' => 'Fast and reliable monochrome laser printer.', 'price' => 199.99, 'category' => 'Printers', 'image' => 'products/printer.jpg'],
            ['name' => 'Epson EcoTank', 'description' => 'High-capacity ink tank printer for offices.', 'price' => 249.99, 'category' => 'Printers', 'image' => 'products/printer.jpg'],
            ['name' => 'Ubiquiti UniFi AP', 'description' => 'Enterprise-grade wireless access point.', 'price' => 149.99, 'category' => 'Networking', 'image' => 'products/networking.jpg'],
            ['name' => 'TP-Link Omada Gigabit Router', 'description' => 'Advanced VPN router for business.', 'price' => 129.99, 'category' => 'Networking', 'image' => 'products/networking.jpg'],
            ['name' => 'Cisco 24-Port Switch', 'description' => 'Managed gigabit network switch.', 'price' => 349.99, 'category' => 'Networking', 'image' => 'products/networking.jpg'],
            ['name' => 'Netgear 8-Port Switch', 'description' => 'Unmanaged plug-and-play switch.', 'price' => 39.99, 'category' => 'Networking', 'image' => 'products/networking.jpg'],
            ['name' => 'Keychron K2 Keyboard', 'description' => 'Wireless mechanical keyboard for Mac/Windows.', 'price' => 99.99, 'category' => 'Peripherals', 'image' => 'products/networking.jpg'],
            ['name' => 'Dell UltraSharp 27"', 'description' => '4K USB-C monitor for professionals.', 'price' => 549.99, 'category' => 'Monitors', 'image' => 'products/monitor.jpg'],
            ['name' => 'LG UltraGear 32"', 'description' => '144Hz curved gaming monitor.', 'price' => 349.99, 'category' => 'Monitors', 'image' => 'products/monitor.jpg'],
            ['name' => 'Logitech MX Master 3S', 'description' => 'Advanced wireless mouse for productivity.', 'price' => 99.99, 'category' => 'Peripherals', 'image' => 'products/networking.jpg'],
            ['name' => 'Elgato Stream Deck', 'description' => 'Live content creation controller.', 'price' => 149.99, 'category' => 'Peripherals', 'image' => 'products/networking.jpg'],
        ];

        foreach ($products as $data) {
            $data['stock'] = $data['stock'] ?? rand(3, 30);
            $data['sold_count'] = $data['sold_count'] ?? rand(20, 120);
            Product::create($data);
        }
    }
}
