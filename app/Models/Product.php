<?php

// App\Models\Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    public function letters()
    {
        return $this->belongsToMany(Letter::class, 'product_letter');
    }

    public function getFormRouteAttribute()
    {
        switch ($this->id) {
            case 4:
                return 'pt_biasa.form'; // ID of Pendirian PT Biasa
            case 5:
                return 'cv.form'; // ID of Pendirian CV
            case 6:
                return 'yayasan.form'; // ID of Pendirian Yayasan
            case 7:
                return 'pt_perorangan.form'; // ID of Pendirian pt perorangan
            case 8:
                return 'firma.form';
            default:
                return null;
        }
    }
}
