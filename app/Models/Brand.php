<?php

namespace App\Models;

use App\Http\Resources\BrandResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class Brand extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'image',
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
        Storage::disk('local')->put("admin/brands/small/$name", (string) $smallImage->toPng());
        Storage::disk('local')->put("admin/brands/big/$name", (string) $bigImage->toPng());

        return $name;
    }
    public static function createBrand($request) {
         $image = self::saveImage($request->file);
          Brand::query()->create([
            'title' => $request->input('title'),
            'image' => $image,
        ]);
    }

    public static function getAllBrands()
    {
    $brands = self::query()->get();
    return BrandResource::collection($brands);
    }
}
