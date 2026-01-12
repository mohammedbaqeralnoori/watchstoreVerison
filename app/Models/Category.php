<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'parent_id'
    ];

    public function parent () {
        return $this->belongsTo(self::class, 'parent_id', 'id')->
        withDefault((['title'=>'------']));
    }

    public function child () {
        return $this->hasMany(self::class, 'parent_id', 'id');
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
        Storage::disk('local')->put("admin/categories/small/$name", (string) $smallImage->toPng());
        Storage::disk('local')->put("admin/categories/big/$name", (string) $bigImage->toPng());

        return $name;
    }

    public static function getAllCategories()
    {
        $categories = self::query()->get();
        return CategoryResource::collection($categories);
    }

}
