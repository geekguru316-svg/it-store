<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    protected $fillable = ['name', 'description', 'price', 'image', 'category', 'stock', 'sold_count'];

    public static function categories(): array
    {
        return [
            'Mobiles',
            'Tablets',
            'Laptops',
            'Desktops',
            'Security Cameras',
            'Action/Video Cameras',
            'Digital Cameras',
            'Gaming Consoles',
            'Gadgets',
        ];
    }
    public function images()
{
    return $this->hasMany(ProductImage::class);
}
}

