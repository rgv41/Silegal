<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormCVKBLI extends Model
{
    use HasFactory;

    protected $table = 'form_cv_kbli';

    protected $fillable = [
        'form_cv_id',
        'kbli_id',
    ];

    // Relasi dengan form_cv
    public function formCV()
    {
        return $this->belongsTo(FormCV::class);
    }

    // Relasi dengan kbli
    public function kbli()
    {
        return $this->belongsTo(KBLI::class);
    }
}
