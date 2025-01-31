<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relasi dengan ProductLetter
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_letter');
    }
}
