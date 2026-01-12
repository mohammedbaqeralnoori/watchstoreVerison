<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'code',
    ];

    /**
     * check if two minutes passed from last sms
     */
    public static function checkTwoMiuntes(string $mobile): bool
    {
        $lastSms = self::where('mobile', $mobile)
            ->orderByDesc('created_at')
            ->first();

        if (!$lastSms) {
            return true;
        }

        return Carbon::parse($lastSms->created_at)
            ->addMinutes(2)
            ->isPast();
    }

    public static function createSmsCode(string $mobile, int $code): void
    {
        self::create([
            'mobile' => $mobile,
            'code'   => $code,
        ]);
    }

    public static function checkCode(string $mobile, string $code): bool
    {
        return self::where('mobile', $mobile)
            ->where('code', $code)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5))
            ->exists();
    }
}
