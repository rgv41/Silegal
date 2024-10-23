<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBLICategory extends Model
{
    use HasFactory;

    protected $table = 'kbli_categories';

    protected $fillable = [
        'category_name',
    ];

    // Relasi ke KBLI
    public function kblis()
    {
        return $this->hasMany(KBLI::class, 'kbli_category_id');
    }
}
