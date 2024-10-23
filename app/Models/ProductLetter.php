<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLetter extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dari konvensi
    protected $table = 'product_letter';

    // Field yang boleh diisi (fillable)
    protected $fillable = [
        'product_id',
        'letter_id',
    ];

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letter_id', 'id');
    }
}
