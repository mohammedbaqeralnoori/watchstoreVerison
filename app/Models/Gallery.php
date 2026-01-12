<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'product_id',
    ];

    public function product () {
        return $this->belongsTo(Product::class);
    }
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
}
