<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormYayasanKBLI extends Model
{
    use HasFactory;

    protected $table = 'form_yayasan_kbli';

    protected $fillable = [
        'form_yayasan_id',
        'kbli_id',
    ];

    public function yayasan()
    {
        return $this->belongsTo(FormYayasan::class);
    }

    public function kbli()
    {
        return $this->belongsTo(KBLI::class);
    }
}
