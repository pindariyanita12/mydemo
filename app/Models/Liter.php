<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liter extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'day',
        'time',
        'area',
        'liter'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
