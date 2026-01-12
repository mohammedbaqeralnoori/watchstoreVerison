<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;
use Laravel\Sanctum\HasApiTokens;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'photo',
        'phone',
        'status',
        'is_admin',
        'user_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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
        Storage::disk('local')->put("admin/users/small/$name", (string)$smallImage->toPng());
        Storage::disk('local')->put("admin/users/big/$name", (string)$bigImage->toPng());

        return $name;
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'users_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function updateUserInfo($request, $user)
    {
        $image = self::saveImage($request->file);

        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'photo' => $image,
        ]);

        $user->addresses()->create([
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
            'lat' => $request->input('lat'),
            'lang' => $request->input('lang'),
        ]);

        return true;
    }


}
