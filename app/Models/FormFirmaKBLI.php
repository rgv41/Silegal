<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFirmaKBLI extends Model
{
    use HasFactory;

    protected $table = 'form_firma_kbli';

    protected $fillable = [
        'firma_id',
        'kbli_id',
    ];

    public function formFirma()
    {
        return $this->belongsTo(FormFirma::class);
    }

    public function kbli()
    {
        return $this->belongsTo(KBLI::class);
    }
}
