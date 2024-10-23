<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPTBiasaKBLI extends Model
{
    use HasFactory;

    protected $table = 'form_pt_biasa_kbli';

    protected $fillable = [
        'form_pt_biasa_id',
        'kbli_id',
    ];

    public function formPTBiasa()
    {
        return $this->belongsTo(FormPTBiasa::class);
    }

    public function kbli()
    {
        return $this->belongsTo(KBLI::class);
    }
}
