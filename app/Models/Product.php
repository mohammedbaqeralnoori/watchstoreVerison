<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'price',
        'prview',
        'count',
        'image',
        'guaranty',
        'discount',
        'description',
        'is_special',
        'special_expiration',
        'status',
        'category_id',
        'brand_id',
    ];
    public static function saveImage($file)
    {
        if (!$file) return '';

        $name = time() . '.' . $file->extension();

        $driver = new GdDriver();
        $manager = new ImageManager($driver);

        // Resize small image
        $smallImage = $manager->read($file->getRealPath())
            ->resize(256, 256, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });

        // Original (big) image
        $bigImage = $manager->read($file->getRealPath());

        // Save both versions
        Storage::disk('local')->put("admin/products/small/$name", (string) $smallImage->toPng());
        Storage::disk('local')->put("admin/products/big/$name", (string) $bigImage->toPng());

        return $name;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'product_property');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
