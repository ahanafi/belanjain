<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'total_payment', 'status', 'shopping_date'];

    public static function generateNumber()
    {
        $maxNumber = self::query()->selectRaw('MAX(number) AS number')->first();

        if($maxNumber && $maxNumber->number !== null) {
            $numbers = explode("-", $maxNumber->number);
            $nextCode = (int) $numbers[1] + 1;
            return "TRX-" . sprintf("%04s", $nextCode);
        }

        return "TRX-00001";
    }
}
