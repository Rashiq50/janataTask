<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock_market extends Model
{
    // protected $primaryKey = 'id';
    protected $table = 'stock_market';
    use HasFactory;

    protected $fillable = [
        'trade_code',
        'date' ,
        'high',
        'low',
        'open',
        'close',
        'volume',
    ];
}
